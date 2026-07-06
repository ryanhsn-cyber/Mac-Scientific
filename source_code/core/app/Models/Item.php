<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = ['category_id','subcategory_id','childcategory_id','brand_id','name','slug','sku','tags','video','sort_details','specification_name','specification_description','is_specification','details','photo','thumbnail','discount_price','previous_price','stock','meta_keywords','meta_description','status','is_type','tax_id','date','item_type','file','link','file_type','license_name','license_key','affiliate_link'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory')->withDefault();
    }

    public function childcategory()
    {
        return $this->belongsTo('App\Models\ChieldCategory')->withDefault();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->withDefault();
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\CampaignItem');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Tax')->withDefault();
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }

    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public static function taxCalculate($item)
    {
        if($item->tax){
            $price = $item->discount_price;
            $percentage = $item->tax->value;
            $tax = ($price * $percentage) / 100;
            return $tax;
        }else{
            return 0;
        }
        
    }




    public function getWishlistItemId()
    {
        return Wishlist::whereItemId($this->id)->first()->id;
    }


    public function user()
    {
    	return $this->belongsTo('App\Models\User','vendor_id')->withDefault();
    }


    public function is_stock()
    {
        $item = $this;
        // license product stock check------------
        if($item->item_type == 'license'){
            if($item->license_key){
                $lisense_key = json_decode($item->license_key,true);
                if(count($lisense_key) > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        // digital product stock check-------------

        if($item->item_type == 'digital'){
            return true;
        }
        if($item->item_type == 'affiliate'){
            return true;
        }

        // physical product stock check

        if($item->item_type == 'normal'){
            if($item->stock){
                if($item->stock != 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
          
        }
     
    }

    public function getHtmlSpecifications()
    {
        $spec_name = $this->specification_name;
        $spec_desc = $this->specification_description;

        if (!$spec_name || $spec_name === '[null]') {
            return '';
        }

        // Check if it is a JSON array
        if (is_string($spec_name) && strpos($spec_name, '[') === 0 && strpos($spec_name, ']') === strlen($spec_name) - 1) {
            $names = json_decode($spec_name, true);
            $descriptions = json_decode($spec_desc, true);
            
            if (is_array($names)) {
                $filtered_names = array_filter($names, function($val) {
                    return !is_null($val) && $val !== '';
                });
                if (empty($filtered_names)) {
                    return '';
                }

                $html = '<table class="table table-bordered"><tbody>';
                if (!is_array($descriptions)) {
                    $descriptions = array_fill(0, count($names), '');
                }
                if (count($names) !== count($descriptions)) {
                    if (count($descriptions) < count($names)) {
                        $descriptions = array_pad($descriptions, count($names), '');
                    } else {
                        $descriptions = array_slice($descriptions, 0, count($names));
                    }
                }
                foreach (array_combine($names, $descriptions) as $name => $description) {
                    if ($name || $description) {
                        $html .= '<tr><td><strong>' . e($name) . '</strong></td><td>' . e($description) . '</td></tr>';
                    }
                }
                $html .= '</tbody></table>';
                return $html;
            }
        }

        return $spec_name;
    }

}

