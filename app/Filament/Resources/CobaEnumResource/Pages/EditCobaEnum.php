<?php

namespace App\Filament\Resources\CobaEnumResource\Pages;

use App\Filament\Resources\CobaEnumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCobaEnum extends EditRecord
{
    protected static string $resource = CobaEnumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
