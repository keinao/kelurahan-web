<?php

namespace App\Filament\Resources\Facilities\Schemas;

use App\Models\Facility;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Fasilitas')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->maxLength(150),
                        Select::make('category')
                            ->label('Kategori')
                            ->options(Facility::CATEGORIES)
                            ->default('lainnya')
                            ->required(),
                        TextInput::make('address')
                            ->label('Alamat')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('map_url')
                            ->label('Link Google Maps')
                            ->helperText('Opsional. Link biasa ke lokasi fasilitas di Google Maps.')
                            ->url()
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Tampilkan di website')
                            ->default(true),
                    ]),
            ]);
    }
}