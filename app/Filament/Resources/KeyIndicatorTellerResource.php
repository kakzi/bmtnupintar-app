<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\KeyIndicatorTeller;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KeyIndicatorTellerResource\Pages;
use App\Filament\Resources\KeyIndicatorTellerResource\RelationManagers;

class KeyIndicatorTellerResource extends Resource
{
    protected static ?string $model = KeyIndicatorTeller::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Nama Teller')
                    ->options(User::with('career')->where('office_id', auth()->user()->office_id)
                        ->where('career_id', 8)
                        ->pluck('name', 'id'))
                    ->searchable(),

                TextInput::make('indicator_one')
                    ->label('Bobot % KPI 1')
                    ->numeric()
                    ->default(15)
                    ->readOnly(),

                Section::make('KPI 1')
                    ->description('Pencapaian Target Jasa Cabang (Aplikasi, Notifikasi dll)')
                    ->schema([
                        Select::make('kpi_one')
                                ->label('Key Performance Indicator')
                                ->columnSpanFull()
                                ->options([
                                    '1' => 'Pencapaian Target Jasa   (Aplikasi,Notifikasi, dll) Cabang Kurang dari 50%',
                                    '2' => 'Pencapaian Target Jasa   (Aplikasi, Notifikasi, dll) Cabang > 50%-70%',
                                    '3' => 'Pencapaian Target Jasa  (Aplikasi, Notifikasi, dll) Cabang > 70%-80%',
                                    '4' => 'Pencapaian Target Jasa    (Aplikasi, Notifikasi, dll) Cabang > 80%-100%',
                                    '5' => 'Pencapaian Target Jasa (Aplikasi, Notifikasi, dll)  Cabang  > 100 %',
                                ]),
                        TextInput::make('target_notif')
                                ->label('Target Notifikasi')
                                ->integer()
                                ->required()
                                ->live(),
                        TextInput::make('tercapai_notif')
                                ->label('Tercapai')
                                ->integer()
                                ->required()
                                ->live(),
                        TextInput::make('target_aplikasi')
                                ->label('Target Aplikasi')
                                ->integer()
                                ->required()
                                ->live(),
                        TextInput::make('tercapai_aplikasi')
                                ->label('Tercapai')
                                ->integer()
                                ->required()
                                ->live(),
                        
                    ])
                    ->columns(2),
                Section::make('KPI 2')
                    ->description('Kedisiplinan Santri')
                    ->schema([
                        Select::make('kpi_two')
                            ->options([
                                '1' => 'ijin lebih dari 3 kali (sakit atau kepentingan yang lain) dalam 1 bulan dan atau pulang awal lebih dari 3 kali atau telat lebih dari 3 kali dalam 1 bulan',
                                '2' => 'ijin 3 kali (sakit atau kepentingan yang lain) dalam 1 bulan dan atau pulang awal 3 kali atau telat 3 kali dalam 1 bulan',
                                '3' => 'ijin 2 kali (sakit atau kepentingan yang lain) dalam 1 bulan pulang awal 2 kali atau telat 2 kali dalam 1 bulan',
                                '4' => 'ijin 1 kali (sakit atau kepentingan yang lain) dalam 1 bulan dan atau pulang awal 1 kali atau telat 1 kali dalam 1 bulan',
                                '5' => 'jika tidak pernah ijin tidak masuk (sakit atau kepentingan yang lain) dalam 1 bulan dan atau tidak pernah pulang awal dan tidak pernah telat  dalam 1 bulan',
                            ])->columnSpanFull(),
                        RichEditor::make('notes_two')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])
                    ->columns(2),
                Section::make('KPI 3')
                    ->description('Standart Pelayanan Teller')
                    ->schema([
                        Select::make('kpi_three')
                            ->options([
                               '1' => 'ada komplain lebih dari 3 kali dalam satu bulan, hasil dari penyebaran pelayanan, dari hasil sampel penyebaran angket kepuasan kurang dari 50 % anggota yang puas',
                                '2' => 'ada komplain 3 kali dalam satu bulan, hasil dari penyebaran pelayanan, dari hasil sampel penyebaran angket kepuasan 50% anggota yang puas',
                                '3' => 'ada komplain 2 kali dalam satu bulan, hasil dari penyebaran hasil dari sampel penyebaran angket kepuasan 50-75 % anggota yang puas',
                                '4' => 'ada komplain 1 kali dalam satu bulan, hasil dari penyebaran angket kepuasan 50-75 % anggota yang puas',
                                '5' => 'tidak ada komplain dalam satu bulan, hasil dari penyebaran angket kepuasan 100% anggota puas',
                            ])->columnSpanFull(),
                        RichEditor::make('notes_three')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])
                    ->columns(2),
                Section::make('KPI 4')
                    ->description('Kelengkapan Administrasi Cabang')
                    ->schema([
                        Select::make('kpi_four')
                            ->options([
                                '1' => 'Jika memiliki ijin yang kurang lengkap, hanya memiliki 8 buku administrasi dan 8 buku pencatatan tetapi tidak pernah di isi sama sekali',
                                '2' => 'Jika memiliki ijin yang kurang lengkap, memiliki 8 buku administrasi tetapi tidak lengkap semua, memiliki buku 8 pencatatan kegiatan operasional sehari-hari tetapi tidak terisi lengkap semua',
                                '3' => 'Jika memiliki ijin yang lengkap, memiliki 8 buku administrasi tetapi tidak terisi lengkap semua, memiliki buku 8 pencatatan kegiatan operasional sehari-hari tetapi tidak terisi lengkap semua',
                                '4' => 'Jika memiliki ijin yang lengkap, memiliki 8 buku administrasi dan terisi lengkap semua, memiliki buku 8 pencatatan kegiatan operasional sehari-hari dan terisi lengkap semua',
                                '5' => 'Jika memiliki ijin yang lengkap, memiliki 8 buku administrasi dan terisi lengkap semua, memiliki buku 8 pencatatan kegiatan operasional sehari-hari dan terisi lengkap semua, dan ada rekom pelaporan serta evaluasi dari tiap catatan yang ada',
                            ])->columnSpanFull(),
                        RichEditor::make('notes_four')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])
                    ->columns(2),
                Section::make('KPI 5')
                    ->description('(Problem Solving) Penyelesaian Selisih Brankas Di Cabang (Jika Ada)')
                    ->schema([
                        Select::make('kpi_five')
                            ->options([
                                '1' => 'Ketika penyelesaian selisih brankas di cabang < 50%',
                                '2' => 'Ketika penyelesaian selisih brankas di cabang  > 50%-70%',
                                '3' => 'Ketika penyelesaian selisih brankas di cabang > 70%-80%',
                                '4' => 'Ketika penyelesaian selisih brankas di cabang > 80%-100%',
                                '5' => 'Ketika penyelesaian selisih brankas di cabang  > 100 %',
                            ])->columnSpanFull(),
                        RichEditor::make('notes_five')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])
                    ->columns(2),
                Section::make('KPI 6')
                    ->description('Pemahaman Produk - Produk Simpanan dan Pinjaman')
                    ->schema([
                        Select::make('kpi_six')
                            ->options([
                                '1' => 'Ketika pemahaman semua produk kurang (simpanan atau pinjaman)dan tidak pernah klosing semua',
                                '2' => 'Ketika pemahaman produk sebanyak kurang dari 5  produk (simpanan dan pinjaman) dan pernah klosing semua',
                                '3' => 'Ketika pemahaman produk sebanyak 5-8  produk (simpanan dan pinjaman) dan pernah klosing semua',
                                '4' => 'Ketika pemahaman produk sebanyak 8-10  produk (simpanan dan pinjaman) dan pernah klosing semua',
                                '5' => 'Ketika pemahaman produk lebih dari 10 produk (simpanan dan pinjaman) dan pernah klosing semua',
                            ])->columnSpanFull(),
                        RichEditor::make('notes_six')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])->columns(2),
                Section::make('Catatan Santri')
                    ->description('Catatan khusus santri (jika ada)')
                    ->schema([
                        RichEditor::make('description')
                                ->label('Catatan')
                                ->columnSpanFull()
                        
                    ])
                    ->columns(2),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('total'),
                TextColumn::make('rata-rata'),
                TextColumn::make('description')->label('Catatan')->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListKeyIndicatorTellers::route('/'),
            'create' => Pages\CreateKeyIndicatorTeller::route('/create'),
            'edit' => Pages\EditKeyIndicatorTeller::route('/{record}/edit'),
        ];
    }

}
