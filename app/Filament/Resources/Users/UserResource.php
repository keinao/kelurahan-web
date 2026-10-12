<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Akun Admin';

    protected static ?int $navigationSort = 99;

    protected static ?string $modelLabel = 'Akun Admin';

    protected static ?string $pluralModelLabel = 'Akun Admin';

    protected static ?string $slug = 'akun-admin';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Alamat email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            TextInput::make('password')
                ->label('Kata sandi')
                ->password()
                ->revealable()
                ->autocomplete('new-password')
                ->required(fn (string $operation): bool => $operation === 'create')
                ->minLength(12)
                ->dehydrated(fn (?string $state): bool => filled($state)),

            TextInput::make('password_confirmation')
                ->label('Konfirmasi kata sandi')
                ->password()
                ->revealable()
                ->autocomplete('new-password')
                ->required(fn (string $operation): bool => $operation === 'create')
                ->same('password')
                ->dehydrated(false)
                ->visible(fn (string $operation, Get $get): bool => $operation === 'create' || filled($get('password'))),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Alamat email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
