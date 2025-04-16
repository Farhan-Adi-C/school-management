<?php

namespace App\Filament\Resources\CobaEnumResource\Pages;

use App\Filament\Resources\CobaEnumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCobaEnums extends ListRecords
{
    protected static string $resource = CobaEnumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
