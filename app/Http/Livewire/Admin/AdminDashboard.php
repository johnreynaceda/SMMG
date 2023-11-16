<?php

namespace App\Http\Livewire\Admin;

use App\Models\Doctor;
use App\Models\PatientAppointment;
use App\Models\Specialization;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class AdminDashboard extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $chartData;

    protected function getTableQuery(): Builder
    {

        return User::query()->where('account_type', 'patient');

    }
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('FULLNAME'),
            Tables\Columns\TextColumn::make('email')->label('EMAIL'),
            Tables\Columns\BadgeColumn::make('created_at')->date()->label('CREATED AT')
        ];

    }
    public function render()
    {

        $today = Carbon::now();
        $oneWeekAgo = Carbon::now()->subWeek();

        $specializations = Specialization::withCount([
            'patient_appointments' => function ($query) use ($today, $oneWeekAgo) {
                $query->whereBetween('created_at', [$oneWeekAgo, $today])->where('status', 'accepted');
            }
        ])->get();

        $this->chartData = [
            'labels' => $specializations->pluck('name'),
            'data' => $specializations->pluck('patient_appointments_count'),
        ];

        return view('livewire.admin.admin-dashboard', [
            'visits' => User::whereDate('created_at', now())->count(),
            'new' => PatientAppointment::whereDate('created_at', '<=', now())->whereDate('created_at', '>=', now()->subDays(5))->count(),
            'old' => PatientAppointment::where('status', 'done')->count(),
            'specialists' => Specialization::get(),
        ]);
    }
}
