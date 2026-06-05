<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->modalHeading('Import Produk dari CSV / JSON')
                ->modalDescription('Unduh template di bawah, isi datanya, lalu unggah kembali untuk menambahkan produk secara massal.')
                ->modalSubmitActionLabel('Mulai Import')
                ->modalSubmitAction(fn ($action) => $action->color('primary'))
                ->form([
                    Placeholder::make('download_templates')
                        ->label('1. Unduh Template')
                        ->columnSpanFull()
                        ->content(new HtmlString(Blade::render('
                            <div class="p-3 bg-gray-50 dark:bg-gray-950 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-wrap gap-3 my-1">
                                <x-filament::button
                                    tag="a"
                                    href="' . asset('template/template.csv') . '"
                                    download
                                    color="gray"
                                    icon="heroicon-o-arrow-down-tray"
                                >
                                    Template CSV
                                </x-filament::button>
                                <x-filament::button
                                    tag="a"
                                    href="' . asset('template/template.json') . '"
                                    download
                                    color="gray"
                                    icon="heroicon-o-arrow-down-tray"
                                >
                                    Template JSON
                                </x-filament::button>
                            </div>
                        '))),
                    FileUpload::make('file')
                        ->label('2. Unggah File (.csv, .json)')
                        ->acceptedFileTypes(['text/csv', 'application/json', 'text/plain'])
                        ->disk('public')
                        ->directory('temp-imports')
                        ->rules(['required', 'file', 'mimes:csv,json,txt'])
                        ->required(),
                ])
                ->action(function (array $data) {
                    $disk = 'public';
                    $fileRelativePath = $data['file'];
                    
                    if (is_array($fileRelativePath)) {
                        $fileRelativePath = reset($fileRelativePath);
                    }

                    if (empty($fileRelativePath) || !Storage::disk($disk)->exists($fileRelativePath)) {
                        Notification::make()
                            ->title('Gagal mengimpor')
                            ->body('File tidak ditemukan di storage.')
                            ->danger()
                            ->send();
                        return;
                    }

                    $path = Storage::disk($disk)->path($fileRelativePath);
                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $content = Storage::disk($disk)->get($fileRelativePath);

                    $items = [];
                    $isJson = false;

                    if ($extension === 'json' || (str_starts_with(trim($content), '[') && str_ends_with(trim($content), ']'))) {
                        $isJson = true;
                    }

                    if ($isJson) {
                        $decoded = json_decode($content, true);
                        if (is_array($decoded)) {
                            $items = $decoded;
                        } else {
                            Notification::make()
                                ->title('Gagal mengimpor')
                                ->body('Format file JSON tidak valid.')
                                ->danger()
                                ->send();
                            Storage::disk($disk)->delete($fileRelativePath);
                            return;
                        }
                    } else {
                        // Parse CSV
                        $lines = array_filter(explode("\n", $content));
                        if (empty($lines)) {
                            Notification::make()
                                ->title('Gagal mengimpor')
                                ->body('File CSV kosong.')
                                ->danger()
                                ->send();
                            Storage::disk($disk)->delete($fileRelativePath);
                            return;
                        }

                        $firstLine = $lines[0];
                        $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';

                        if (($handle = fopen($path, 'r')) !== false) {
                            $header = fgetcsv($handle, 0, $separator);
                            if ($header) {
                                $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
                                $header = array_map(fn($col) => trim(strtolower($col)), $header);

                                while (($row = fgetcsv($handle, 0, $separator)) !== false) {
                                    if (count($header) === count($row)) {
                                        $items[] = array_combine($header, $row);
                                    }
                                }
                            }
                            fclose($handle);
                        }
                    }

                    if (empty($items)) {
                        Notification::make()
                            ->title('Gagal mengimpor')
                            ->body('Tidak ada data produk yang valid untuk diimpor.')
                            ->warning()
                            ->send();
                        Storage::disk($disk)->delete($fileRelativePath);
                        return;
                    }

                    $successCount = 0;
                    $failCount = 0;

                    DB::transaction(function () use ($items, &$successCount, &$failCount) {
                        foreach ($items as $item) {
                            $normalizedItem = [];
                            foreach ($item as $key => $val) {
                                $normalizedItem[trim(strtolower($key))] = $val;
                            }

                            $namaProduk = trim($normalizedItem['nama_produk'] ?? '');
                            $shopeeUrl = trim($normalizedItem['shopee_url'] ?? '');
                            $tiktokUrl = trim($normalizedItem['tiktok_url'] ?? '');

                            // Skip if name is empty OR both shopee_url and tiktok_url are empty
                            if ($namaProduk === '' || ($shopeeUrl === '' && $tiktokUrl === '')) {
                                $failCount++;
                                continue;
                            }

                            $kategoriName = trim($normalizedItem['kategori'] ?? '');
                            if ($kategoriName === '') {
                                $kategoriName = 'Lainnya';
                            }

                            $category = Category::where('name', $kategoriName)->first();
                            if (!$category) {
                                $n = strtolower($kategoriName);
                                $icon = match(true) {
                                    str_contains($n,'fashion')||str_contains($n,'baju')||str_contains($n,'pakaian')||str_contains($n,'kaos')||str_contains($n,'celana')||str_contains($n,'jaket')||str_contains($n,'dress')||str_contains($n,'sepatu')||str_contains($n,'tas')||str_contains($n,'clothing')||str_contains($n,'clothes')||str_contains($n,'shirt')||str_contains($n,'blouse')||str_contains($n,'skirt')||str_contains($n,'rok')||str_contains($n,'kemeja')||str_contains($n,'sweater')||str_contains($n,'hoodie')||str_contains($n,'apparel') => 'tabler-shirt',
                                    str_contains($n,'elektronik')||str_contains($n,'gadget')||str_contains($n,' hp')||str_contains($n,'laptop')||str_contains($n,'komputer')||str_contains($n,'phone')||str_contains($n,'tech')||str_contains($n,'audio')||str_contains($n,'kamera') => 'tabler-device-mobile',
                                    str_contains($n,'kecantikan')||str_contains($n,'beauty')||str_contains($n,'skincare')||str_contains($n,'kosmetik')||str_contains($n,'perawatan')||str_contains($n,'makeup')||str_contains($n,'parfum') => 'tabler-sparkles',
                                    str_contains($n,'rumah')||str_contains($n,'home')||str_contains($n,'furniture')||str_contains($n,'dapur')||str_contains($n,'interior')||str_contains($n,'dekorasi')||str_contains($n,'household')||str_contains($n,'perabot') => 'tabler-home',
                                    str_contains($n,'makanan')||str_contains($n,'kuliner')||str_contains($n,'minuman')||str_contains($n,'food')||str_contains($n,'snack')||str_contains($n,'kopi')||str_contains($n,'beverage')||str_contains($n,'jajanan') => 'tabler-utensils',
                                    str_contains($n,'olahraga')||str_contains($n,'sport')||str_contains($n,'fitness')||str_contains($n,'gym')||str_contains($n,'outdoor')||str_contains($n,'hiking') => 'tabler-barbell',
                                    str_contains($n,'aksesoris')||str_contains($n,'perhiasan')||str_contains($n,'jewelry')||str_contains($n,'jam')||str_contains($n,'watch')||str_contains($n,'cincin')||str_contains($n,'gelang') => 'tabler-gem',
                                    str_contains($n,'anak')||str_contains($n,'bayi')||str_contains($n,'kids')||str_contains($n,'mainan')||str_contains($n,'baby')||str_contains($n,'toys') => 'tabler-pacifier',
                                    str_contains($n,'buku')||str_contains($n,'alat tulis')||str_contains($n,'stationery')||str_contains($n,'pendidikan')||str_contains($n,'education')||str_contains($n,'kantor') => 'tabler-book',
                                    str_contains($n,'otomotif')||str_contains($n,'motor')||str_contains($n,'mobil')||str_contains($n,'automotive')||str_contains($n,'spare')||str_contains($n,'kendaraan') => 'tabler-car',
                                    default => 'tabler-tag'
                                };

                                $category = Category::create([
                                    'name' => $kategoriName,
                                    'icon' => $icon,
                                    'is_active' => true,
                                ]);
                            }

                            $hargaRaw = trim($normalizedItem['harga'] ?? '');
                            $displayPrice = $hargaRaw !== '' ? $hargaRaw : null;
                            $price = null;

                            if ($hargaRaw !== '') {
                                $parts = preg_split('/[\-\–]/', $hargaRaw);
                                $firstPart = trim($parts[0]);

                                if (preg_match('/^\D*\d{1,3}(\.\d{3})+(\D*)$/', $firstPart)) {
                                    $firstPart = str_replace('.', '', $firstPart);
                                }
                                if (preg_match('/^\D*\d{1,3}(,\d{3})+(\D*)$/', $firstPart)) {
                                    $firstPart = str_replace(',', '', $firstPart);
                                }

                                $numericString = preg_replace('/[^0-9.]/', '', $firstPart);
                                if (is_numeric($numericString)) {
                                    $price = (float) $numericString;
                                }
                            }

                            $imageUrl = trim($normalizedItem['url_gambar'] ?? '');

                            Product::create([
                                'category_id' => $category->id,
                                'name' => $namaProduk,
                                'image_url' => $imageUrl !== '' ? $imageUrl : null,
                                'display_price' => $displayPrice,
                                'price' => $price,
                                'is_active' => true,
                                'is_featured' => false,
                                'shopee_url' => $shopeeUrl !== '' ? $shopeeUrl : null,
                                'tiktok_url' => $tiktokUrl !== '' ? $tiktokUrl : null,
                            ]);

                            $successCount++;
                        }
                    });

                    Storage::disk($disk)->delete($fileRelativePath);

                    if ($successCount > 0) {
                        Notification::make()
                            ->title('Import Berhasil')
                            ->body("Berhasil mengimpor {$successCount} produk." . ($failCount > 0 ? " {$failCount} produk gagal (nama produk kosong)." : ""))
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Import Gagal')
                            ->body("Tidak ada produk yang berhasil diimpor." . ($failCount > 0 ? " {$failCount} produk gagal karena nama produk kosong." : ""))
                            ->danger()
                            ->send();
                    }
                }),
            CreateAction::make(),
        ];
    }
}
