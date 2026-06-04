<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\IconPicker\Forms\Components\IconPicker;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kategori')
                ->schema([
                    Grid::make(2)->schema([

                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(1),

                    ]),
                ])
                ->columnSpanFull(),

            // ── Icon Picker — grid inline ─────────────────────────────
            Section::make('Ikon Kategori')
                ->description('Klik untuk memilih ikon kategori. Opsional — otomatis dari nama jika tidak dipilih.')
                ->schema([
                    IconPicker::make('icon')
                        ->hiddenLabel()
                        ->sets(['tabler'])
                        ->dropdown(false)
                        ->searchable(),
                ])
                ->columnSpanFull(),

            // ── Gambar (opsional) ─────────────────────────────────────
            Section::make('Gambar Kategori')
                ->description('Opsional. Upload gambar atau masukkan URL gambar untuk tampilan kategori.')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('image_path')
                            ->label('Upload gambar')
                            ->image()
                            ->directory('categories')
                            ->visibility('public'),
                        TextInput::make('image_url')
                            ->label('URL gambar')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://...'),
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
                TextColumn::make('icon')->label('Ikon')->toggleable(),
                TextColumn::make('products_count')->counts('products')->label('Produk')->sortable(),
                TextColumn::make('sort_order')->label('Urutan')->sortable()->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
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
            'index'  => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit'   => EditCategory::route('/{record}/edit'),
        ];
    }
}
