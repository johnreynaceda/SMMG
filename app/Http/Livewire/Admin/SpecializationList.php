<?php

namespace App\Http\Livewire\Admin;

use App\Models\Specialization;
use Filament\Tables\Actions\Action;
use Livewire\Component;
use App\Models\Doctor as doctorModel;
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
use DB;

class SpecializationList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use WithFileUploads;

    protected function getTableQuery(): Builder
    {

        return Specialization::query();

    }

    protected function getTableHeaderActions()
    {

        return [

            Action::make('new_specialization')->label('Add New Specialization')->button()->icon('heroicon-o-plus-circle')->action(function ($record, $data) {
                Specialization::create([
                    'name' => $data['name'],
                ]);
            })->form([
                        TextInput::make('name')->label('Name')->required(),
                    ])->modalWidth('xl')

        ];

    }

    protected function getTableColumns(): array
    {

        return [
            Tables\Columns\TextColumn::make('name')->label('NAME')->searchable(),

        ];
    }

    protected function getTableActions(): array
    {

        return [

            Action::make('edit')->label('Edit')->icon('heroicon-o-pencil-alt')->color('success')->action(
                function ($record, $data) {
                    $record->update($data);
                }
            )->form(
                    function ($record) {
                        return [
                            TextInput::make('name')->label('Name')->required()->default($record->name)
                        ];
                    }
                )->modalHeading('Update Specialization')->modalWidth('xl'),
            Tables\Actions\DeleteAction::make(),

        ];

    }



    public function render()
    {
        return view('livewire.admin.specialization-list');
    }
}