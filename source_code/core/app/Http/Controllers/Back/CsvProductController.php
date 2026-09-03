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
     * Download the standard CSV Template for bulk product uploading.
     */
    public function template()
    {
        $templatePath = base_path('../assets/bulk_product_template.csv');

        if (file_exists($templatePath)) {
            return response()->download($templatePath, 'mac_scientific_bulk_products_template.csv', [
                'Content-Type' => 'text/csv'
            ]);
        }

        // Generate on the fly if file missing
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=mac_scientific_bulk_products_template.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $columns = [
            'name', 'category', 'subcategory', 'childcategory', 'brand',
            'sku', 'current_price', 'previous_price', 'stock', 'short_description',
            'description', 'how_to_use', 'specifications', 'features', 'tags',
            'photo_url', 'video', 'meta_keywords', 'meta_description', 'status'
        ];

        $sampleRow = [
            'Digital Microscope 1000x HD', 'Laboratory Equipment', 'Microscopes', '', 'Mac Scientific',
            'MS-MIC-1000', '8500', '9500', '25', 'High-definition digital laboratory microscope with 1000x magnification',
            'Professional optical glass lenses with 4.3 inch LCD display and rechargeable lithium battery for laboratory research and clinical analysis.',
            'Connect USB cable to power source or charge battery. Place specimen slide on the adjustable stage and rotate focus wheel until crisp focus is reached.',
            'Magnification: 50x-1000x; Display: 4.3 inch LCD; Light Source: 8 adjustable LEDs',
            '1000x Magnification, 4.3-inch Screen, Rechargeable Battery, LED Illumination',
            'microscope, lab, optics, digital',
            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b',
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'microscope, lab equipment, mac scientific',
            'Professional digital microscope with 1000x magnification for research and diagnostic labs.',
            '1'
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
     * Export all products to CSV in the exact template format.
     */
    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=products_export_' . date('Y_m_d_His') . '.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $items = Item::with(['category', 'subcategory', 'childcategory', 'brand'])->where('item_type', '!=', 'affiliate')->get();

        $callback = function () use ($items) {
            $fh = fopen('php://output', 'w');

            // Header row
            fputcsv($fh, [
                'name', 'category', 'subcategory', 'childcategory', 'brand',
                'sku', 'current_price', 'previous_price', 'stock', 'short_description',
                'description', 'how_to_use', 'specifications', 'features', 'tags',
                'photo_url', 'video', 'meta_keywords', 'meta_description', 'status'
            ]);

            foreach ($items as $item) {
                fputcsv($fh, [
                    $item->name,
                    $item->category ? $item->category->name : '',
                    $item->subcategory ? $item->subcategory->name : '',
                    $item->childcategory ? $item->childcategory->name : '',
                    $item->brand ? $item->brand->name : '',
                    $item->sku,
                    $item->discount_price,
                    $item->previous_price,
                    $item->stock,
                    $item->sort_details,
                    $item->details,
                    $item->how_to_use,
                    $item->specification_name,
                    $item->features,
                    $item->tags,
                    $item->photo ? (Str::startsWith($item->photo, 'http') ? $item->photo : asset('assets/images/' . $item->photo)) : '',
                    $item->video,
                    $item->meta_keywords,
                    $item->meta_description,
                    $item->status
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
     * Intelligent Bulk Product CSV Importer
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

        // Read and normalize header row
        $rawHeaders = fgetcsv($handle);
        if (!$rawHeaders) {
            fclose($handle);
            @unlink($fullTempPath);
            return back()->withError(__('The uploaded CSV file appears to be empty.'));
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

            // Skip completely empty lines
            if (count(array_filter($row)) === 0) {
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

            $name = $data['name'] ?? '';
            if (empty($name)) {
                $rowErrors[] = "Row {$rowNum}: Skipped because Product Name is missing.";
                $failedCount++;
                continue;
            }

            try {
                // 1. Resolve Category
                $catName = strtolower(trim($data['category'] ?? ''));
                $categoryId = 0;
                if (!empty($catName)) {
                    if (isset($categoriesByName[$catName])) {
                        $categoryId = $categoriesByName[$catName]->id;
                    } elseif (is_numeric($data['category'] ?? null) && Category::where('id', $data['category'])->exists()) {
                        $categoryId = intval($data['category']);
                    } else {
                        // Auto-create category
                        $newCat = Category::create([
                            'name'   => $data['category'],
                            'slug'   => Str::slug($data['category']),
                            'status' => 1
                        ]);
                        $categoriesByName[strtolower(trim($newCat->name))] = $newCat;
                        $categoryId = $newCat->id;
                    }
                }
                if (!$categoryId) {
                    $categoryId = $defaultCategory ? $defaultCategory->id : 0;
                }

                // 2. Resolve Subcategory
                $subName = strtolower(trim($data['subcategory'] ?? ''));
                $subcategoryId = 0;
                if (!empty($subName)) {
                    if (isset($subcategoriesByName[$subName])) {
                        $subcategoryId = $subcategoriesByName[$subName]->id;
                    } elseif (is_numeric($data['subcategory'] ?? null) && Subcategory::where('id', $data['subcategory'])->exists()) {
                        $subcategoryId = intval($data['subcategory']);
                    } elseif ($categoryId) {
                        $newSub = Subcategory::create([
                            'category_id' => $categoryId,
                            'name'        => $data['subcategory'],
                            'slug'        => Str::slug($data['subcategory']),
                            'status'      => 1
                        ]);
                        $subcategoriesByName[strtolower(trim($newSub->name))] = $newSub;
                        $subcategoryId = $newSub->id;
                    }
                }

                // 3. Resolve Child Category
                $childName = strtolower(trim($data['childcategory'] ?? ''));
                $childcategoryId = 0;
                if (!empty($childName)) {
                    if (isset($childcategoriesByName[$childName])) {
                        $childcategoryId = $childcategoriesByName[$childName]->id;
                    } elseif (is_numeric($data['childcategory'] ?? null) && ChieldCategory::where('id', $data['childcategory'])->exists()) {
                        $childcategoryId = intval($data['childcategory']);
                    } elseif ($subcategoryId && $categoryId) {
                        $newChild = ChieldCategory::create([
                            'category_id'    => $categoryId,
                            'subcategory_id' => $subcategoryId,
                            'name'           => $data['childcategory'],
                            'slug'           => Str::slug($data['childcategory']),
                            'status'         => 1
                        ]);
                        $childcategoriesByName[strtolower(trim($newChild->name))] = $newChild;
                        $childcategoryId = $newChild->id;
                    }
                }

                // 4. Resolve Brand
                $brandName = strtolower(trim($data['brand'] ?? ''));
                $brandId = 0;
                if (!empty($brandName)) {
                    if (isset($brandsByName[$brandName])) {
                        $brandId = $brandsByName[$brandName]->id;
                    } elseif (is_numeric($data['brand'] ?? null) && Brand::where('id', $data['brand'])->exists()) {
                        $brandId = intval($data['brand']);
                    } else {
                        $newBrand = Brand::create([
                            'name'   => $data['brand'],
                            'slug'   => Str::slug($data['brand']),
                            'status' => 1
                        ]);
                        $brandsByName[strtolower(trim($newBrand->name))] = $newBrand;
                        $brandId = $newBrand->id;
                    }
                }

                // 5. SKU & Slug
                $sku = !empty($data['sku']) ? trim($data['sku']) : ('MS-' . strtoupper(Str::random(8)));
                $slug = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($name);

                // 6. Prices
                $rawCurrentPrice = floatval(preg_replace('/[^0-9.]/', '', $data['current_price'] ?? 0));
                $rawPreviousPrice = floatval(preg_replace('/[^0-9.]/', '', $data['previous_price'] ?? 0));
                $currVal = $curr->value > 0 ? $curr->value : 1;
                $discountPrice = $rawCurrentPrice / $currVal;
                $previousPrice = $rawPreviousPrice > 0 ? ($rawPreviousPrice / $currVal) : 0;

                // 7. Stock
                $stock = isset($data['stock']) && $data['stock'] !== '' ? intval(preg_replace('/[^0-9]/', '', $data['stock'])) : 10;

                // 8. Descriptions & Content
                $details = $data['description'] ?? ($data['short_description'] ?? $name);
                $sortDetails = $data['short_description'] ?? Str::limit(strip_tags($details), 180);
                $howToUse = $data['how_to_use'] ?? null;
                $specifications = $data['specifications'] ?? null;
                $features = $data['features'] ?? null;
                $tags = $data['tags'] ?? null;
                $video = $data['video'] ?? null;
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

                // 9. Photo Download / Association
                $photoUrl = $data['photo_url'] ?? ($data['photo'] ?? '');
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
            'errors'  => array_slice($rowErrors, 0, 10) // Display up to 10 row errors
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
            'name'                     => 'name',
            'productname'              => 'name',
            'title'                    => 'name',
            'category'                 => 'category',
            'categoryname'             => 'category',
            'categoryid'               => 'category',
            'subcategory'              => 'subcategory',
            'subcategoryname'          => 'subcategory',
            'childcategory'            => 'childcategory',
            'childcategoryname'        => 'childcategory',
            'brand'                    => 'brand',
            'brandname'                => 'brand',
            'sku'                      => 'sku',
            'currentprice'             => 'current_price',
            'price'                    => 'current_price',
            'discountprice'            => 'current_price',
            'saleprice'                => 'current_price',
            'previousprice'            => 'previous_price',
            'regularprice'             => 'previous_price',
            'originalprice'            => 'previous_price',
            'mrp'                      => 'previous_price',
            'stock'                    => 'stock',
            'quantity'                 => 'stock',
            'qty'                      => 'stock',
            'shortdescription'         => 'short_description',
            'sortdetails'              => 'short_description',
            'shortdesc'                => 'short_description',
            'description'              => 'description',
            'details'                  => 'description',
            'desc'                     => 'description',
            'howtouse'                 => 'how_to_use',
            'usage'                    => 'how_to_use',
            'specifications'           => 'specifications',
            'specification'            => 'specifications',
            'specificationname'        => 'specifications',
            'specs'                    => 'specifications',
            'features'                 => 'features',
            'keyfeatures'              => 'features',
            'tags'                     => 'tags',
            'producttags'              => 'tags',
            'photourl'                 => 'photo_url',
            'photo'                    => 'photo_url',
            'image'                    => 'photo_url',
            'imageurl'                 => 'photo_url',
            'featuredimage'            => 'photo_url',
            'video'                    => 'video',
            'videourl'                 => 'video',
            'videolink'                => 'video',
            'metakeywords'             => 'meta_keywords',
            'metadescription'          => 'meta_description',
            'status'                   => 'status',
            'itemtype'                 => 'item_type'
        ];

        return $aliases[$cleaned] ?? $cleaned;
    }
}
