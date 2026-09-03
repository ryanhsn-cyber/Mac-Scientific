<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChieldCategory;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Log;

class CsvProductController extends Controller
{
    public function index()
    {
        $categories = Category::whereStatus(1)->with(['subcategory.childcategory'])->orderBy('name')->get();
        $brands = Brand::whereStatus(1)->orderBy('name')->get();

        return view('back.item.bulk-upload', [
            'categories' => $categories,
            'brands'     => $brands
        ]);
    }

    /**
     * Download the standard CSV Template for bulk product uploading (Meta / Facebook & Google Catalog Format).
     */
    public function template()
    {
        $templatePath = base_path('../assets/bulk_product_template.csv');

        if (file_exists($templatePath)) {
            return response()->download($templatePath, 'meta_catalog_bulk_products_template.csv', [
                'Content-Type' => 'text/csv'
            ]);
        }

        // Fallback generator
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=meta_catalog_bulk_products_template.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $columns = [
            'id', 'title', 'description', 'availability', 'condition', 'link', 'image_link', 'brand',
            'price', 'google_product_category', 'fb_product_category', 'quantity_to_sell_on_facebook',
            'sale_price', 'sale_price_effective_date', 'item_group_id', 'gender', 'color', 'size',
            'age_group', 'material', 'pattern', 'shipping', 'shipping_weight', 'offer_disclaimer',
            'offer_disclaimer_url', 'video[0].url', 'video[0].tag[0]', 'gtin', 'product_tags[0]',
            'product_tags[1]', 'style[0]'
        ];

        $sampleRow = [
            '0', 'Blue Facebook T-Shirt (Unisex)', 'A vibrant blue crewneck T-shirt for all shapes and sizes. Made from 100% cotton.',
            'in stock', 'new', 'https://www.facebook.com/facebook_t_shirt', 'https://www.facebook.com/t_shirt_image_001.jpg',
            'Facebook', '10.00 USD', 'Apparel & Accessories > Clothing', 'Clothing & Accessories > Clothing', '75',
            '10.00 USD', '2020-04-30T09:30-08:00/2020-05-30T23:59-08:00', '', 'unisex', 'royal blue', 'M',
            'adult', 'cotton', 'stripes', 'US:CA:Ground:9.99 USD;US:NY:Air:15.99 USD', '10 kg',
            'Valid while supplies last. Terms and conditions apply.', 'https://example.com/terms-and-conditions',
            'http://www.facebook.com/a0.mp4', 'Gym', '8806088573892', 'some_string', 'other', 'Bodycon'
        ];

        $callback = function () use ($columns, $sampleRow) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, $sampleRow);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export all products to CSV in the Meta Catalog template format.
     */
    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=products_meta_catalog_export_' . date('Y_m_d_His') . '.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $items = Item::with(['category', 'subcategory', 'childcategory', 'brand'])->where('item_type', '!=', 'affiliate')->get();

        $callback = function () use ($items) {
            $fh = fopen('php://output', 'w');

            // Header row in Meta catalog format
            fputcsv($fh, [
                'id', 'title', 'description', 'availability', 'condition', 'link', 'image_link', 'brand',
                'price', 'google_product_category', 'fb_product_category', 'quantity_to_sell_on_facebook',
                'sale_price', 'sale_price_effective_date', 'item_group_id', 'gender', 'color', 'size',
                'age_group', 'material', 'pattern', 'shipping', 'shipping_weight', 'offer_disclaimer',
                'offer_disclaimer_url', 'video[0].url', 'video[0].tag[0]', 'gtin', 'product_tags[0]',
                'product_tags[1]', 'style[0]'
            ]);

            foreach ($items as $item) {
                $categoryHierarchy = $item->category ? $item->category->name : '';
                if ($item->subcategory) {
                    $categoryHierarchy .= ' > ' . $item->subcategory->name;
                }
                if ($item->childcategory) {
                    $categoryHierarchy .= ' > ' . $item->childcategory->name;
                }

                $imageUrl = $item->photo ? (Str::startsWith($item->photo, 'http') ? $item->photo : asset('assets/images/' . $item->photo)) : '';
                $productUrl = route('front.product', $item->slug);

                $regularPrice = $item->previous_price > 0 ? number_format($item->previous_price, 2, '.', '') . ' BDT' : number_format($item->discount_price, 2, '.', '') . ' BDT';
                $salePrice = number_format($item->discount_price, 2, '.', '') . ' BDT';

                fputcsv($fh, [
                    $item->sku ?: $item->id,
                    $item->name,
                    $item->details ?: $item->sort_details,
                    $item->stock > 0 ? 'in stock' : 'out of stock',
                    'new',
                    $productUrl,
                    $imageUrl,
                    $item->brand ? $item->brand->name : 'Mac Scientific',
                    $regularPrice,
                    $categoryHierarchy,
                    $categoryHierarchy,
                    $item->stock,
                    $salePrice,
                    '', // sale_price_effective_date
                    '', // item_group_id
                    'unisex',
                    '', // color
                    '', // size
                    'adult',
                    '', // material
                    '', // pattern
                    '', // shipping
                    '', // shipping_weight
                    '', // offer_disclaimer
                    '', // offer_disclaimer_url
                    $item->video ?: '',
                    '',
                    '',
                    $item->tags ?: '',
                    '',
                    ''
                ]);
            }

            fclose($fh);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function transactionExport()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=transactions_export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $lists = Transaction::all()->toArray();
        if (empty($lists)) {
            $lists = [['id' => '', 'txn_id' => '', 'user_email' => '', 'amount' => '', 'currency' => '']];
        }
        array_unshift($lists, array_keys($lists[0]));

        $callback = function () use ($lists) {
            $fh = fopen('php://output', 'w');
            foreach ($lists as $row) {
                fputcsv($fh, $row);
            }
            fclose($fh);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function orderExport()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders_export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $lists = Order::all()->toArray();
        if (empty($lists)) {
            $lists = [['id' => '', 'order_number' => '', 'total_amount' => '', 'order_status' => '']];
        }
        array_unshift($lists, array_keys($lists[0]));

        $callback = function () use ($lists) {
            $fh = fopen('php://output', 'w');
            foreach ($lists as $row) {
                fputcsv($fh, $row);
            }
            fclose($fh);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Intelligent Bulk Product CSV Importer supporting Meta Catalog & Standard Store formats
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|max:20480'
        ]);

        $file = $request->file('csv');
        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, ['csv', 'txt'])) {
            return back()->withError(__('Invalid file format. Please upload a .csv file.'));
        }

        $updateExisting = $request->input('update_existing', 1) == 1;
        $curr = Currency::where('is_default', 1)->first() ?: (object)['value' => 1];

        // Ensure temp and images directory exists
        $tempDir = public_path('assets/temp_files');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $imagesDir = base_path('../assets/images');
        if (!file_exists($imagesDir)) {
            mkdir($imagesDir, 0777, true);
        }

        $tempFileName = 'import_' . time() . '_' . Str::random(6) . '.csv';
        $file->move($tempDir, $tempFileName);
        $fullTempPath = $tempDir . '/' . $tempFileName;

        if (!file_exists($fullTempPath)) {
            return back()->withError(__('Could not save uploaded CSV file to temporary storage.'));
        }

        $handle = fopen($fullTempPath, 'r');
        if (!$handle) {
            return back()->withError(__('Failed to open CSV file for reading.'));
        }

        // Strip UTF-8 BOM if present
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        // Read and locate header row, skipping comment lines (lines starting with '#')
        $rawHeaders = null;
        while (($line = fgetcsv($handle)) !== false) {
            if (empty($line) || empty(array_filter($line))) {
                continue;
            }
            $firstCell = trim($line[0] ?? '');
            if (Str::startsWith($firstCell, '#')) {
                continue;
            }
            $rawHeaders = $line;
            break;
        }

        if (!$rawHeaders) {
            fclose($handle);
            @unlink($fullTempPath);
            return back()->withError(__('The uploaded CSV file appears to be empty or contains only comments.'));
        }

        $headerMap = [];
        foreach ($rawHeaders as $index => $header) {
            $cleaned = preg_replace('/[^a-z0-9]/', '', strtolower(trim($header)));
            $headerMap[$index] = $this->canonicalizeHeader($cleaned);
        }

        $successCount = 0;
        $updatedCount = 0;
        $failedCount = 0;
        $rowErrors = [];
        $rowNum = 1;

        // Cache categories and brands
        $categoriesByName = Category::all()->keyBy(function ($c) {
            return strtolower(trim($c->name));
        });
        $subcategoriesByName = Subcategory::all()->keyBy(function ($s) {
            return strtolower(trim($s->name));
        });
        $childcategoriesByName = ChieldCategory::all()->keyBy(function ($c) {
            return strtolower(trim($c->name));
        });
        $brandsByName = Brand::all()->keyBy(function ($b) {
            return strtolower(trim($b->name));
        });

        // Default fallback category if none matches
        $defaultCategory = Category::first();

        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;

            // Skip completely empty lines or lines starting with #
            if (count(array_filter($row)) === 0 || Str::startsWith(trim($row[0] ?? ''), '#')) {
                continue;
            }

            // Map row data by canonical header
            $data = [];
            foreach ($row as $colIdx => $val) {
                if (isset($headerMap[$colIdx])) {
                    $key = $headerMap[$colIdx];
                    $data[$key] = trim($val);
                }
            }

            // Title / Product Name
            $name = $data['name'] ?? ($data['title'] ?? '');
            if (empty($name)) {
                $rowErrors[] = "Row {$rowNum}: Skipped because Title/Product Name is missing.";
                $failedCount++;
                continue;
            }

            try {
                // 1. Resolve Category & Subcategories (Supports Meta hierarchy: "Apparel & Accessories > Clothing")
                $rawCategory = $data['google_product_category'] ?? ($data['fb_product_category'] ?? ($data['category'] ?? ''));
                $catName = '';
                $subName = '';
                $childName = '';

                if (strpos($rawCategory, '>') !== false) {
                    $parts = array_map('trim', explode('>', $rawCategory));
                    $catName = $parts[0] ?? '';
                    $subName = $parts[1] ?? '';
                    $childName = $parts[2] ?? '';
                } else {
                    $catName = !empty($rawCategory) ? $rawCategory : ($data['category'] ?? '');
                    $subName = $data['subcategory'] ?? '';
                    $childName = $data['childcategory'] ?? '';
                }

                $categoryId = 0;
                $catKey = strtolower(trim($catName));
                if (!empty($catKey)) {
                    if (isset($categoriesByName[$catKey])) {
                        $categoryId = $categoriesByName[$catKey]->id;
                    } elseif (is_numeric($catName) && Category::where('id', $catName)->exists()) {
                        $categoryId = intval($catName);
                    } else {
                        $newCat = Category::create([
                            'name'   => $catName,
                            'slug'   => Str::slug($catName),
                            'status' => 1
                        ]);
                        $categoriesByName[$catKey] = $newCat;
                        $categoryId = $newCat->id;
                    }
                }
                if (!$categoryId) {
                    $categoryId = $defaultCategory ? $defaultCategory->id : 0;
                }

                // Subcategory
                $subcategoryId = 0;
                $subKey = strtolower(trim($subName));
                if (!empty($subKey)) {
                    if (isset($subcategoriesByName[$subKey])) {
                        $subcategoryId = $subcategoriesByName[$subKey]->id;
                    } elseif (is_numeric($subName) && Subcategory::where('id', $subName)->exists()) {
                        $subcategoryId = intval($subName);
                    } elseif ($categoryId) {
                        $newSub = Subcategory::create([
                            'category_id' => $categoryId,
                            'name'        => $subName,
                            'slug'        => Str::slug($subName),
                            'status'      => 1
                        ]);
                        $subcategoriesByName[$subKey] = $newSub;
                        $subcategoryId = $newSub->id;
                    }
                }

                // Child Category
                $childcategoryId = 0;
                $childKey = strtolower(trim($childName));
                if (!empty($childKey)) {
                    if (isset($childcategoriesByName[$childKey])) {
                        $childcategoryId = $childcategoriesByName[$childKey]->id;
                    } elseif (is_numeric($childName) && ChieldCategory::where('id', $childName)->exists()) {
                        $childcategoryId = intval($childName);
                    } elseif ($subcategoryId && $categoryId) {
                        $newChild = ChieldCategory::create([
                            'category_id'    => $categoryId,
                            'subcategory_id' => $subcategoryId,
                            'name'           => $childName,
                            'slug'           => Str::slug($childName),
                            'status'         => 1
                        ]);
                        $childcategoriesByName[$childKey] = $newChild;
                        $childcategoryId = $newChild->id;
                    }
                }

                // 2. Resolve Brand
                $rawBrand = $data['brand'] ?? '';
                $brandKey = strtolower(trim($rawBrand));
                $brandId = 0;
                if (!empty($brandKey)) {
                    if (isset($brandsByName[$brandKey])) {
                        $brandId = $brandsByName[$brandKey]->id;
                    } elseif (is_numeric($rawBrand) && Brand::where('id', $rawBrand)->exists()) {
                        $brandId = intval($rawBrand);
                    } else {
                        $newBrand = Brand::create([
                            'name'   => $rawBrand,
                            'slug'   => Str::slug($rawBrand),
                            'status' => 1
                        ]);
                        $brandsByName[$brandKey] = $newBrand;
                        $brandId = $newBrand->id;
                    }
                }

                // 3. SKU & Content ID
                $sku = !empty($data['id']) ? trim($data['id']) : (!empty($data['sku']) ? trim($data['sku']) : ('MS-' . strtoupper(Str::random(8))));
                $slug = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($name);

                // 4. Prices (Handles "10.00 USD", "850.00 BDT", "$10", etc.)
                $rawSalePrice = isset($data['sale_price']) ? floatval(preg_replace('/[^0-9.]/', '', $data['sale_price'])) : 0;
                $rawPrice = isset($data['price']) ? floatval(preg_replace('/[^0-9.]/', '', $data['price'])) : 0;
                $rawCurrentPrice = isset($data['current_price']) ? floatval(preg_replace('/[^0-9.]/', '', $data['current_price'])) : 0;
                $rawPreviousPrice = isset($data['previous_price']) ? floatval(preg_replace('/[^0-9.]/', '', $data['previous_price'])) : 0;

                if ($rawSalePrice > 0) {
                    $currentPriceVal = $rawSalePrice;
                    $previousPriceVal = $rawPrice > $rawSalePrice ? $rawPrice : ($rawPreviousPrice ?: 0);
                } elseif ($rawCurrentPrice > 0) {
                    $currentPriceVal = $rawCurrentPrice;
                    $previousPriceVal = $rawPreviousPrice ?: $rawPrice;
                } elseif ($rawPrice > 0) {
                    $currentPriceVal = $rawPrice;
                    $previousPriceVal = 0;
                } else {
                    $currentPriceVal = 0;
                    $previousPriceVal = 0;
                }

                $currVal = $curr->value > 0 ? $curr->value : 1;
                $discountPrice = $currentPriceVal / $currVal;
                $previousPrice = $previousPriceVal > 0 ? ($previousPriceVal / $currVal) : 0;

                // 5. Stock & Availability
                $stock = 10;
                if (isset($data['quantity_to_sell_on_facebook']) && $data['quantity_to_sell_on_facebook'] !== '') {
                    $stock = intval(preg_replace('/[^0-9]/', '', $data['quantity_to_sell_on_facebook']));
                } elseif (isset($data['stock']) && $data['stock'] !== '') {
                    $stock = intval(preg_replace('/[^0-9]/', '', $data['stock']));
                }
                $availability = strtolower(trim($data['availability'] ?? ''));
                if ($availability === 'out of stock' || $availability === 'outofstock') {
                    $stock = 0;
                }

                // 6. Descriptions, Specifications, Tags, Features
                $details = $data['description'] ?? ($data['details'] ?? ($data['short_description'] ?? $name));
                $sortDetails = $data['short_description'] ?? Str::limit(strip_tags($details), 180);
                $howToUse = $data['how_to_use'] ?? null;

                // Build specifications from Meta attributes
                $specsList = [];
                if (!empty($data['specifications'])) $specsList[] = $data['specifications'];
                if (!empty($data['material'])) $specsList[] = 'Material: ' . $data['material'];
                if (!empty($data['color'])) $specsList[] = 'Color: ' . $data['color'];
                if (!empty($data['size'])) $specsList[] = 'Size: ' . $data['size'];
                if (!empty($data['condition'])) $specsList[] = 'Condition: ' . $data['condition'];
                if (!empty($data['gender'])) $specsList[] = 'Gender: ' . $data['gender'];
                if (!empty($data['age_group'])) $specsList[] = 'Age Group: ' . $data['age_group'];
                if (!empty($data['shipping'])) $specsList[] = 'Shipping: ' . $data['shipping'];
                if (!empty($data['shipping_weight'])) $specsList[] = 'Weight: ' . $data['shipping_weight'];
                $specifications = !empty($specsList) ? implode("; ", $specsList) : null;

                // Build tags
                $tagsList = [];
                if (!empty($data['tags'])) $tagsList[] = $data['tags'];
                if (!empty($data['producttags0'])) $tagsList[] = $data['producttags0'];
                if (!empty($data['producttags1'])) $tagsList[] = $data['producttags1'];
                if (!empty($data['style0'])) $tagsList[] = $data['style0'];
                $tags = !empty($tagsList) ? implode(', ', array_unique($tagsList)) : null;

                $features = $data['features'] ?? null;
                $video = $data['video0url'] ?? ($data['video'] ?? null);
                $metaKeywords = $data['meta_keywords'] ?? ($tags ?: $name);
                $metaDescription = $data['meta_description'] ?? Str::limit(strip_tags($sortDetails), 160);
                $status = isset($data['status']) && $data['status'] !== '' ? intval($data['status']) : 1;
                $itemType = !empty($data['item_type']) ? $data['item_type'] : 'normal';

                // Check for existing product by SKU or Slug
                $existingItem = null;
                if ($updateExisting) {
                    $existingItem = Item::where('sku', $sku)->first();
                    if (!$existingItem && !empty($slug)) {
                        $existingItem = Item::where('slug', $slug)->first();
                    }
                }

                $item = $existingItem ?: new Item();

                // Unique slug check if inserting new
                if (!$existingItem) {
                    if (Item::where('slug', $slug)->exists()) {
                        $slug = $slug . '-' . rand(100, 9999);
                    }
                }

                // 7. Image Download / Association
                $photoUrl = $data['image_link'] ?? ($data['photo_url'] ?? ($data['photo'] ?? ''));
                $photoFileName = null;
                $thumbFileName = null;

                if (!empty($photoUrl)) {
                    if (Str::startsWith($photoUrl, ['http://', 'https://'])) {
                        $imageResult = $this->downloadAndProcessImage($photoUrl, $imagesDir);
                        if ($imageResult) {
                            $photoFileName = $imageResult['photo'];
                            $thumbFileName = $imageResult['thumbnail'];
                        }
                    } elseif (file_exists($imagesDir . '/' . basename($photoUrl))) {
                        $photoFileName = basename($photoUrl);
                    }
                }

                // Populate attributes
                $item->category_id               = $categoryId;
                $item->subcategory_id            = $subcategoryId;
                $item->childcategory_id          = $childcategoryId;
                $item->brand_id                  = $brandId;
                $item->name                      = $name;
                $item->slug                      = $slug;
                $item->sku                       = $sku;
                $item->discount_price            = $discountPrice;
                $item->previous_price            = $previousPrice;
                $item->stock                     = $stock;
                $item->details                   = $details;
                $item->sort_details              = $sortDetails;
                $item->how_to_use                = $howToUse;
                $item->specification_name        = $specifications;
                $item->is_specification          = !empty($specifications) ? 1 : 0;
                $item->features                  = $features;
                $item->tags                      = $tags;
                $item->video                     = $video;
                $item->meta_keywords             = $metaKeywords;
                $item->meta_description          = $metaDescription;
                $item->status                    = $status;
                $item->is_type                   = 'undefine';
                $item->item_type                 = $itemType;

                if ($photoFileName) {
                    $item->photo = $photoFileName;
                }
                if ($thumbFileName) {
                    $item->thumbnail = $thumbFileName;
                }

                $item->save();

                if ($existingItem) {
                    $updatedCount++;
                } else {
                    $successCount++;
                }

            } catch (\Exception $ex) {
                Log::error("Bulk Product Import Row {$rowNum} Error: " . $ex->getMessage());
                $rowErrors[] = "Row {$rowNum} ('{$name}'): " . $ex->getMessage();
                $failedCount++;
            }
        }

        fclose($handle);
        @unlink($fullTempPath);

        $reportMessage = __('Bulk Product Upload Complete.') . ' ' .
            __('Imported: :succ, Updated: :upd, Failed: :fail', [
                'succ' => $successCount,
                'upd'  => $updatedCount,
                'fail' => $failedCount
            ]);

        session()->flash('import_stats', [
            'success' => $successCount,
            'updated' => $updatedCount,
            'failed'  => $failedCount,
            'errors'  => array_slice($rowErrors, 0, 10)
        ]);

        if ($failedCount > 0 && $successCount === 0 && $updatedCount === 0) {
            return back()->withError($reportMessage);
        }

        return back()->withSuccess($reportMessage);
    }

    /**
     * Safely download an external image and convert to WebP + Thumbnail
     */
    private function downloadAndProcessImage($url, $saveDir)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $imageData = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200 || empty($imageData)) {
                return null;
            }

            $photoName = time() . Str::random(6) . '.webp';
            $thumbName = Str::random(8) . '.webp';

            // Generate main WebP image
            $img = Image::make($imageData)->encode('webp', 90);
            $img->save($saveDir . '/' . $photoName);

            // Generate 230x230 WebP thumbnail
            $thumb = Image::make($imageData)->resize(230, 230, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 85);
            $thumb->save($saveDir . '/' . $thumbName);

            return [
                'photo'     => $photoName,
                'thumbnail' => $thumbName
            ];
        } catch (\Exception $e) {
            Log::warning("Bulk Import: Could not process image URL '{$url}': " . $e->getMessage());
            return null;
        }
    }

    /**
     * Map arbitrary header labels to internal canonical column names
     */
    private function canonicalizeHeader($cleaned)
    {
        $aliases = [
            // Meta / Facebook catalog names
            'id'                          => 'id',
            'title'                       => 'title',
            'availability'                => 'availability',
            'condition'                   => 'condition',
            'link'                        => 'link',
            'imagelink'                   => 'image_link',
            'googleproductcategory'       => 'google_product_category',
            'fbproductcategory'           => 'fb_product_category',
            'quantitytosellonfacebook'    => 'quantity_to_sell_on_facebook',
            'saleprice'                   => 'sale_price',
            'salepriceeffectivedate'      => 'sale_price_effective_date',
            'itemgroupid'                 => 'item_group_id',
            'gender'                      => 'gender',
            'color'                       => 'color',
            'size'                        => 'size',
            'agegroup'                    => 'age_group',
            'material'                    => 'material',
            'pattern'                     => 'pattern',
            'shipping'                    => 'shipping',
            'shippingweight'              => 'shipping_weight',
            'offerdisclaimer'             => 'offer_disclaimer',
            'offerdisclaimerurl'          => 'offer_disclaimer_url',
            'video0url'                   => 'video0url',
            'video0tag0'                  => 'video0tag0',
            'gtin'                        => 'gtin',
            'producttags0'                => 'producttags0',
            'producttags1'                => 'producttags1',
            'style0'                      => 'style0',

            // Standard Mac-Scientific store names
            'name'                        => 'name',
            'productname'                 => 'name',
            'category'                    => 'category',
            'categoryname'                => 'category',
            'categoryid'                  => 'category',
            'subcategory'                 => 'subcategory',
            'subcategoryname'             => 'subcategory',
            'childcategory'               => 'childcategory',
            'childcategoryname'           => 'childcategory',
            'brand'                       => 'brand',
            'brandname'                   => 'brand',
            'sku'                         => 'sku',
            'currentprice'                => 'current_price',
            'price'                       => 'price',
            'discountprice'               => 'current_price',
            'previousprice'               => 'previous_price',
            'regularprice'                => 'previous_price',
            'originalprice'               => 'previous_price',
            'mrp'                         => 'previous_price',
            'stock'                       => 'stock',
            'quantity'                    => 'stock',
            'qty'                         => 'stock',
            'shortdescription'            => 'short_description',
            'sortdetails'                 => 'short_description',
            'shortdesc'                   => 'short_description',
            'description'                 => 'description',
            'details'                     => 'description',
            'desc'                        => 'description',
            'howtouse'                    => 'how_to_use',
            'usage'                       => 'how_to_use',
            'specifications'              => 'specifications',
            'specification'               => 'specifications',
            'specificationname'           => 'specifications',
            'specs'                       => 'specifications',
            'features'                    => 'features',
            'keyfeatures'                 => 'features',
            'tags'                        => 'tags',
            'producttags'                 => 'tags',
            'photourl'                    => 'photo_url',
            'photo'                       => 'photo_url',
            'image'                       => 'photo_url',
            'imageurl'                    => 'photo_url',
            'featuredimage'               => 'photo_url',
            'video'                       => 'video',
            'videourl'                    => 'video',
            'videolink'                   => 'video',
            'metakeywords'                => 'meta_keywords',
            'metadescription'             => 'meta_description',
            'status'                      => 'status',
            'itemtype'                    => 'item_type'
        ];

        return $aliases[$cleaned] ?? $cleaned;
    }
}
