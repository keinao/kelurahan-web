<?php

namespace App\Filament\Resources\Potentials;

use App\Filament\Resources\Potentials\Pages\CreatePotential;
use App\Filament\Resources\Potentials\Pages\EditPotential;
use App\Filament\Resources\Potentials\Pages\ListPotentials;
use App\Filament\Resources\Potentials\Schemas\PotentialForm;
use App\Filament\Resources\Potentials\Tables\PotentialsTable;
use App\Models\Potential;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PotentialResource extends Resource
{
    protected static ?string $model = Potential::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Potensi';

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Potensi';

    protected static ?string $pluralModelLabel = 'Potensi';

    protected static ?string $slug = 'potensi';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PotentialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PotentialsTable::configure($table);
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
            'index' => ListPotentials::route('/'),
            'create' => CreatePotential::route('/create'),
            'edit' => EditPotential::route('/{record}/edit'),
        ];
    }
}