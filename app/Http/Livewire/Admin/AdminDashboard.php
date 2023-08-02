<?php

namespace App\Http\Livewire\Admin;

use App\Models\PatientAppointment;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class AdminDashboard extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

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
        return view('livewire.admin.admin-dashboard', [
            'visits' => User::whereDate('created_at', now())->count(),
            'new' => PatientAppointment::whereDate('created_at', '<=', now())->whereDate('created_at', '>=', now()->subDays(5))->count(),
            'old' => PatientAppointment::whereDate('created_at', '<=', now()->subDays(5))->count(),
        ]);
    }
}