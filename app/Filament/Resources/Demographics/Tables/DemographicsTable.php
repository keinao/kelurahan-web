<?php

namespace App\Filament\Resources\Demographics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemographicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
                TextColumn::make('total_population')
                    ->label('Penduduk')
                    ->placeholder('Belum diisi'),
                TextColumn::make('male_population')
                    ->label('Laki-laki')
                    ->placeholder('Belum diisi'),
                TextColumn::make('female_population')
                    ->label('Perempuan')
                    ->placeholder('Belum diisi'),
                TextColumn::make('total_families')
                    ->label('KK')
                    ->placeholder('Belum diisi'),
                TextColumn::make('total_lingkungan')
                    ->label('Lingkungan')
                    ->placeholder('Belum diisi'),
            ])
            ->defaultSort('year', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}