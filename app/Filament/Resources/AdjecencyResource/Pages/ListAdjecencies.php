<?php

namespace App\Filament\Resources\AdjecencyResource\Pages;

use App\Filament\Resources\AdjecencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdjecencies extends ListRecords
{
    protected static string $resource = AdjecencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
