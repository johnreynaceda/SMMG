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
    public $graphData = [];

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
        $oneWeekAgo = $today->copy()->subWeek();

        $this->graphData = Specialization::whereHas('doctors', function ($query) use ($today, $oneWeekAgo) {
            $query->whereHas('patient_appointments', function ($query) use ($today, $oneWeekAgo) {
                $query->whereBetween('created_at', [$oneWeekAgo, $today]);
            });
        })
            ->get();

        foreach ($this->graphData as $specialization) {
            $appointmentCount = 0;
            foreach ($specialization->doctors as $doctor) {
                $appointmentCount += $doctor->patient_appointments()
                    ->where('status', 'accepted')
                    ->whereBetween('created_at', [$oneWeekAgo, $today])
                    ->count();
            }
            $specialization->appointment_count = $appointmentCount;
        }


        return view('livewire.admin.admin-dashboard', [
            'visits' => User::whereDate('created_at', now())->count(),
            'new' => PatientAppointment::whereDate('created_at', '<=', now())->whereDate('created_at', '>=', now()->subDays(5))->count(),
            'old' => PatientAppointment::whereDate('created_at', '<=', now()->subDays(5))->count(),
            'specialists' => Specialization::get(),
        ]);
    }
}