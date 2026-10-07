<?php

namespace App\Filament\Pages;

use App\Models\VillageProfile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

/**
 * Halaman admin untuk mengedit profil kelurahan (hanya satu record).
 *
 * @property-read Schema $form
 */
class ManageVillageProfile extends Page
{
    protected string $view = 'filament.pages.manage-village-profile';

    protected static ?string $title = 'Profil Kelurahan';

    protected static ?string $navigationLabel = 'Profil Kelurahan';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'profil-kelurahan';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Identitas')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nama Kelurahan')
                                ->required()
                                ->maxLength(150),
                            Textarea::make('short_description')
                                ->label('Deskripsi Singkat')
                                ->helperText('Tampil di bagian atas Beranda.')
                                ->rows(2)
                                ->maxLength(500),
                        ]),

                    Section::make('Tentang Kelurahan')
                        ->schema([
                            Textarea::make('description')
                                ->label('Tentang Kelurahan')
                                ->rows(5),
                            Textarea::make('welcome_message')
                                ->label('Sambutan Lurah')
                                ->helperText('Tampil di Beranda bersama nama dan jabatan Lurah.')
                                ->rows(5),
                            Textarea::make('history')
                                ->label('Sejarah')
                                ->rows(5),
                            Textarea::make('vision')
                                ->label('Visi')
                                ->rows(3),
                            Textarea::make('mission')
                                ->label('Misi')
                                ->helperText('Tulis satu poin misi per baris.')
                                ->rows(5),
                        ]),

                    Section::make('Wilayah')
                        ->columns(2)
                        ->schema([
                            Textarea::make('geography')
                                ->label('Kondisi Geografis')
                                ->rows(4)
                                ->columnSpanFull(),
                            TextInput::make('area_km2')
                                ->label('Luas Wilayah')
                                ->numeric()
                                ->minValue(0)
                                ->suffix('km²')
                                ->columnSpanFull(),
                            TextInput::make('boundary_north')
                                ->label('Batas Utara')
                                ->maxLength(255),
                            TextInput::make('boundary_south')
                                ->label('Batas Selatan')
                                ->maxLength(255),
                            TextInput::make('boundary_east')
                                ->label('Batas Timur')
                                ->maxLength(255),
                            TextInput::make('boundary_west')
                                ->label('Batas Barat')
                                ->maxLength(255),
                        ]),

                    Section::make('Alamat dan Wilayah Administrasi')
                        ->columns(2)
                        ->schema([
                            Textarea::make('address')
                                ->label('Alamat Kantor')
                                ->rows(3)
                                ->columnSpanFull(),
                            TextInput::make('district')
                                ->label('Kecamatan')
                                ->maxLength(100),
                            TextInput::make('regency')
                                ->label('Kabupaten/Kota')
                                ->maxLength(100),
                            TextInput::make('province')
                                ->label('Provinsi')
                                ->maxLength(100),
                            TextInput::make('postal_code')
                                ->label('Kode Pos')
                                ->maxLength(10),
                        ]),

                    Section::make('Kontak')
                        ->columns(2)
                        ->schema([
                            TextInput::make('phone')
                                ->label('Telepon Kantor')
                                ->tel()
                                ->maxLength(30),
                            TextInput::make('whatsapp')
                                ->label('WhatsApp')
                                ->helperText('Gunakan format internasional tanpa tanda +, diawali 62.')
                                ->tel()
                                ->maxLength(30),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->maxLength(150)
                                ->columnSpanFull(),
                            Textarea::make('office_hours')
                                ->label('Jam Pelayanan')
                                ->helperText('Boleh lebih dari satu baris, misalnya per hari.')
                                ->rows(3)
                                ->columnSpanFull(),
                        ]),

                    Section::make('Peta Lokasi')
                        ->schema([
                            TextInput::make('map_embed_url')
                                ->label('URL Embed Google Maps')
                                ->helperText('Isi hanya alamat (URL) dari atribut src pada kode embed Google Maps, bukan seluruh kode iframe.')
                                ->url()
                                ->maxLength(2000),
                            TextInput::make('map_url')
                                ->label('Link Google Maps')
                                ->helperText('Link biasa untuk tombol "Buka di Google Maps".')
                                ->url()
                                ->maxLength(500),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Simpan')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Hanya ada satu profil. Kalau barisnya belum ada, dibuat saat pertama disimpan.
        $record = $this->getRecord() ?? new VillageProfile();
        $record->fill($data);
        $record->save();

        Notification::make()
            ->success()
            ->title('Profil kelurahan berhasil disimpan')
            ->send();
    }

    public function getRecord(): ?VillageProfile
    {
        return VillageProfile::query()->first();
    }
}