<?php

namespace App\Filament\Resources\ActivityScheduleEmployeeResource\Pages;

use App\Filament\Resources\ActivityScheduleEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivityScheduleEmployee extends EditRecord
{
    protected static string $resource = ActivityScheduleEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
