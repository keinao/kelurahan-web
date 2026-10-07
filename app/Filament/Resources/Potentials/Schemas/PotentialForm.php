<?php

namespace App\Filament\Resources\Potentials\Schemas;

use App\Models\Potential;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PotentialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Potensi')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Potensi')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, Set $set, ?string $state): void {
                                // Slug hanya dibuat otomatis saat membuat baru,
                                // agar tautan lama tidak berubah saat nama diedit.
                                if ($operation !== 'create') {
                                    return;
                                }

                                $set('slug', Str::slug((string) $state));
                            })
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug (alamat halaman)')
                            ->helperText('Dibuat otomatis dari nama. Jangan diubah setelah dipakai agar tautan lama tetap berfungsi.')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(),
                        Select::make('category')
                            ->label('Kategori')
                            ->options(Potential::CATEGORIES)
                            ->default('lainnya')
                            ->required(),
                        TextInput::make('location')
                            ->label('Lokasi')
                            ->helperText('Opsional. Contoh: Lingkungan II.')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Potensi Unggulan')
                            ->helperText('Potensi unggulan yang aktif tampil di Beranda.')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('Tampilkan di website')
                            ->default(true),
                    ]),
            ]);
    }
}