<?php

namespace App\Filament\Resources;

use App\Enums\CobaEnums;
use Filament\Forms;
use Filament\Tables;
use App\Models\CobaEnum;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CobaEnumResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CobaEnumResource\RelationManagers;
use Filament\Tables\Columns\SelectColumn;

class CobaEnumResource extends Resource
{
    protected static ?string $model = CobaEnum::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('name')
                ->options(CobaEnums::class)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SelectColumn::make('name')->options(CobaEnums::class)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCobaEnums::route('/'),
            'create' => Pages\CreateCobaEnum::route('/create'),
            'edit' => Pages\EditCobaEnum::route('/{record}/edit'),
        ];
    }
}
