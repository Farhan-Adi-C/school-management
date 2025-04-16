<?php

namespace App\Filament\Resources\NilaiResource\Pages;

use Closure;
use App\Models\Nilai;
use Filament\Actions;
use App\Models\Periode;
use App\Models\Student;
use App\Models\Subject;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Classroom;
use App\Models\CategoryNilai;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\NilaiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNilai extends CreateRecord
{
    protected static string $resource = NilaiResource::class;

    protected static string $view = 'filament.resources.nilai-resource.pages.form-nilai';

    public function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    Card::make()
                        ->schema([
                            Select::make('classrooms')
                                ->options(Classroom::all()->pluck('name', 'id'))
                                ->label('Class')
                                ->live()
                                ->afterStateUpdated(function (Set $set) {
                                    $set('student', null);
                                    $set('periode', null);
                                }),
                            Select::make('periode')
                                ->label('Periode')
                                ->searchable()
                                ->live()
                                ->preload()
                                ->afterStateUpdated(fn(Set $set) => $set('student', null))
                                ->options(Periode::all()->pluck('name', 'id')),
                            Select::make('subject_id')
                                ->label('subject')
                                ->searchable()
                                ->options(Subject::all()->pluck('name', 'id')),
                            Select::make('category_nilai')
                                ->label('Category Nilai')
                                ->searchable()
                                ->options(CategoryNilai::all()->pluck('name', 'id'))
                                ->columnSpan(3)
                        ])->columns(3),
                    Repeater::make('nilaistudents')
                        ->label('grade')
                        ->schema(fn(Get $get): array => [
                            Select::make('student')
                                ->options(function () use ($get) {
                                    $data = Student::whereIn('id', function ($query) use ($get) {
                                        $query->select('students_id')
                                            ->from('student_has_classes')
                                            ->where('classrooms_id', $get('classrooms'))
                                            ->where('periode_id', $get('periode'))
                                            ->where('is_open', true)->pluck('students_id');
                                    })
                                        ->pluck('name', 'id');

                                    return $data;
                                })
                                ->label('Student'),
                                TextInput::make('nilai')->rules([
                                    fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                        if ($get('nilai') > 100) {
                                            $fail("The Grade to big");
                                        }
                                    },
                                ])
                        ])->columns(2)
                ])
        ]);
    }

    public function save()
    {
        $get = $this->form->getState();

        $insert = [];

        foreach ($get['nilaistudents'] as $row) {
            array_push($insert, [
                'class_id' => $get['classrooms'],
                'student_id' => $row['student'],
                'periode_id' => $get['periode'],
                'teacher_id' => Auth::user()->id,
                'subject_id' => $get['subject_id'],
                'category_nilai_id' => $get['category_nilai'],
                'nilai' => $row['nilai']
            ]);
        }

        Nilai::insert($insert);

        return redirect()->to('admin/nilais');
    }
}
