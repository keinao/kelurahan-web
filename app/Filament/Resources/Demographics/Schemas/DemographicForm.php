<?php

namespace App\Filament\Resources\Demographics\Schemas;

use Closure;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class DemographicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Periode')
                    ->schema([
                        TextInput::make('year')
                            ->label('Tahun')
                            ->helperText('Satu data per tahun. Website menampilkan tahun terbaru.')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->default(now()->year)
                            ->unique()
                            ->validationMessages([
                                'unique' => 'Data untuk tahun ini sudah ada. Ubah data yang sudah ada, atau pilih tahun lain.',
                            ]),
                    ]),

                Section::make('Data Penduduk')
                    ->description('Kosongkan kolom yang datanya belum tersedia. Jangan isi 0 sebagai pengganti.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('total_population')
                            ->label('Jumlah Penduduk')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100000000)
                            ->rules([
                                fn (Get $get): Closure => function (string $attribute, mixed $value, Closure $fail) use ($get): void {
                                    $laki = $get('male_population');
                                    $perempuan = $get('female_population');

                                    // Hanya dicek kalau ketiga angka terisi.
                                    if (blank($value) || blank($laki) || blank($perempuan)) {
                                        return;
                                    }

                                    if ((int) $value !== (int) $laki + (int) $perempuan) {
                                        $fail('Jumlah Penduduk harus sama dengan Laki-laki ditambah Perempuan.');
                                    }
                                },
                            ]),
                        TextInput::make('total_families')
                            ->label('Jumlah KK')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100000000),
                        TextInput::make('male_population')
                            ->label('Laki-laki')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100000000),
                        TextInput::make('female_population')
                            ->label('Perempuan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(100000000),
                        TextInput::make('total_lingkungan')
                            ->label('Jumlah Lingkungan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(65535),
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->helperText('Misalnya sumber data atau tanggal pencatatan.')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}