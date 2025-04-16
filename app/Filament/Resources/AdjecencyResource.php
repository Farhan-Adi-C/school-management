<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Adjecency;
use Illuminate\View\View;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AdjecencyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdjecencyResource\RelationManagers;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;

class AdjecencyResource extends Resource
{
    protected static ?string $model = Adjecency::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name Menu'),
                AdjacencyList::make('subjects')
                    ->form([
                        Forms\Components\TextInput::make('label')
                            ->required()
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('detail')
                ->modalContent(fn (Adjecency $record): View => view(
                    'filament.pages.actions.adjecency',
                    ['record' => $record],
                )),
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
            'index' => Pages\ListAdjecencies::route('/'),
            'create' => Pages\CreateAdjecency::route('/create'),
            'edit' => Pages\EditAdjecency::route('/{record}/edit'),
        ];
    }
}
