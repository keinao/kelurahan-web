<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Isi Informasi')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, Set $set, ?string $state): void {
                                // Slug hanya dibuat otomatis saat membuat baru,
                                // agar tautan lama tidak berubah saat judul diedit.
                                if ($operation !== 'create') {
                                    return;
                                }

                                $set('slug', Str::slug((string) $state));
                            })
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug (alamat halaman)')
                            ->helperText('Dibuat otomatis dari judul. Jangan diubah setelah terbit agar tautan lama tetap berfungsi.')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(),
                        Select::make('category')
                            ->label('Kategori')
                            ->options(News::CATEGORIES)
                            ->default('berita')
                            ->required(),
                        RichEditor::make('content')
                            ->label('Isi')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Publikasi')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Terbitkan')
                            ->helperText('Nyalakan agar tampil di website. Informasi baru berstatus draft secara bawaan.')
                            ->default(false)
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal Terbit')
                            ->helperText('Wajib diisi kalau Terbitkan menyala. Tanggal di masa depan berarti dijadwalkan.')
                            ->default(now())
                            ->required(fn (Get $get): bool => (bool) $get('is_published')),
                    ]),
            ]);
    }
}