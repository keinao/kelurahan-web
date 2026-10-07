<?php

namespace App\Filament\Resources\Officials\Schemas;

use App\Models\Official;
use Closure;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class OfficialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Perangkat')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(150),
                        TextInput::make('position')
                            ->label('Jabatan')
                            ->helperText('Contoh: Lurah, Sekretaris, Kepala Lingkungan I.')
                            ->required()
                            ->maxLength(150),
                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->columns(3)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->helperText('Angka kecil tampil lebih dulu.')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(65535)
                            ->default(0)
                            ->required(),
                        Toggle::make('is_head')
                            ->label('Lurah')
                            ->helperText('Hanya boleh ada satu Lurah.')
                            ->default(false)
                            ->rules([
                                fn (?Model $record): Closure => function (string $attribute, mixed $value, Closure $fail) use ($record): void {
                                    if (! $value) {
                                        return;
                                    }

                                    $sudahAdaLurah = Official::query()
                                        ->where('is_head', true)
                                        ->when($record, fn ($query) => $query->whereKeyNot($record->getKey()))
                                        ->exists();

                                    if ($sudahAdaLurah) {
                                        $fail('Sudah ada perangkat yang ditandai sebagai Lurah. Matikan status Lurah pada perangkat tersebut terlebih dahulu.');
                                    }
                                },
                            ]),
                        Toggle::make('is_active')
                            ->label('Tampilkan di website')
                            ->default(true),
                    ]),
            ]);
    }
}