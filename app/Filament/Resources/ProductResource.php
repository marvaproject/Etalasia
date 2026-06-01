<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Produk')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('display_price')
                            ->label('Teks harga')
                            ->placeholder('Rp79.000')
                            ->maxLength(255),
                        TextInput::make('price')
                            ->label('Harga numerik')
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ]),
                ])
                ->columnSpanFull(),
            Section::make('Gambar')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('image_path')
                            ->label('Upload gambar')
                            ->image()
                            ->directory('products')
                            ->visibility('public'),
                        TextInput::make('image_url')
                            ->label('URL gambar')
                            ->url()
                            ->maxLength(255),
                    ]),
                ])
                ->columnSpanFull(),
            Section::make('Affiliate')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('shopee_url')
                            ->label('Link Shopee')
                            ->url(),
                        TextInput::make('tiktok_url')
                            ->label('Link TikTok')
                            ->url(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                        Toggle::make('is_featured')
                            ->label('Unggulan')
                            ->default(false)
                            ->required(),
                    ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Kategori')->sortable(),
                TextColumn::make('display_price')->label('Harga')->searchable(),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                IconColumn::make('is_featured')->label('Unggulan')->boolean(),
                TextColumn::make('shopee_clicks')->label('Klik Shopee')->numeric()->sortable(),
                TextColumn::make('tiktok_clicks')->label('Klik TikTok')->numeric()->sortable(),
                TextColumn::make('sort_order')->label('Urutan')->sortable()->toggleable(),
                TextColumn::make('updated_at')->label('Update')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')->label('Kategori')->relationship('category', 'name'),
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
