<?php

namespace App\Http\Livewire\Admin;

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
            Tables\Columns\TextColumn::make('author.name'),
            Tables\Columns\BadgeColumn::make('status')
        ];

    }
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}