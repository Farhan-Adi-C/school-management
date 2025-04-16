<?php

namespace App\Filament\Resources\AdjecencyResource\Pages;

use App\Filament\Resources\AdjecencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdjecency extends EditRecord
{
    protected static string $resource = AdjecencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
