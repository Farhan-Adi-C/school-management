<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Periode;
use App\Models\Student;
use App\Models\HomeRoom;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use App\Models\StudentHasClass;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentHasClassResource\Pages;
use App\Filament\Resources\StudentHasClassResource\RelationManagers;

class StudentHasClassResource extends Resource
{
    protected static ?string $model = StudentHasClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Academic';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('students_id')
                    ->searchable()
                    ->options(Student::all()->pluck('name', 'id'))
                    ->label('Student'), 
                    Select::make('classrooms_id')
                    ->searchable()
                    ->required()
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->label('Class'),
                    Select::make('periode_id')
                    ->label("Periode")
                    ->searchable()
                    ->options(Periode::all()->pluck('name', 'id'))
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('students.name'),
                TextColumn::make('classroom.name'),

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
            'index' => Pages\ListStudentHasClasses::route('/'),
            'create' => Pages\FormStudentClass::route('/create'),
            'edit' => Pages\EditStudentHasClass::route('/{record}/edit'),
        ];
    }
}
