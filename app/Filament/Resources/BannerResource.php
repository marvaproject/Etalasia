<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages\CreateBanner;
use App\Filament\Resources\BannerResource\Pages\EditBanner;
use App\Filament\Resources\BannerResource\Pages\ListBanners;
use App\Models\Banner;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Tables\Columns\ToggleColumn;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Promo')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('target_url')
                            ->label('Link tujuan')
                            ->url()
                            ->required(),
                        FileUpload::make('image_path')
                            ->label('Upload gambar')
                            ->image()
                            ->disk('public')
                            ->directory('banners')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('360')
                            ->live()
                            ->disabled(fn ($get) => filled($get('image_url')))
                            ->required(fn ($get) => empty($get('image_url'))),
                        TextInput::make('image_url')
                            ->label('URL gambar')
                            ->url()
                            ->live()
                            ->disabled(fn ($get) => filled($get('image_path')))
                            ->required(fn ($get) => empty($get('image_path')))
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->hidden()
                            ->dehydrated(false),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                    ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image_src')
                    ->label('Preview')
                    ->height(48)
                    ->width(160)
                    ->extraAttributes([
                        'style' => 'width: 184px; padding: 8px 12px; display: flex; align-items: center; justify-content: center;',
                    ])
                    ->extraImgAttributes([
                        'style' => 'aspect-ratio: 10/3 !important; object-fit: cover !important; width: 160px !important; height: 48px !important; border-radius: 6px;',
                    ]),
                TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                TextColumn::make('target_url')->label('Link')->limit(40)->toggleable(),
                TextColumn::make('clicks')->label('Klik')->numeric()->sortable(),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                ToggleColumn::make('is_active')->label('Aktif'),
                TextColumn::make('updated_at')->label('Update')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
