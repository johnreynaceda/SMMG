<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use DB;
use Filament\Forms\Components\Select;

class AdminPatient extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return User::query()->where('account_type', 'patient');

    }

    protected function getTableColumns(): array
    {

        return [

            Tables\Columns\TextColumn::make('name')->label('NAME')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('EMAIL')->searchable(),
            Tables\Columns\TextColumn::make('phone_number')->label('PHONE NUMBER')->searchable(),
            Tables\Columns\BadgeColumn::make('created_at')->date()->label('CREATED AT')

        ];

    }
    public function render()
    {
        return view('livewire.admin.admin-patient');
    }
}