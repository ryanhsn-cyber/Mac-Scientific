<?php

namespace App\Http\Controllers\Back;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\HomeCutomize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{

     /**
     * Constructor Method.
     *
     * Setting Authentication
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }


    public function index(){
        $data = HomeCutomize::first();

        return view('back.home-page.index',[
            'hero_banner' => json_decode($data->hero_banner,true),
            'first_banner' => json_decode($data->banner_first,true),
            'secend_banner' => json_decode($data->banner_secend,true),
            'third_banner' => json_decode($data->banner_third,true),
            'popular_category' => json_decode($data->popular_category,true),
            'three_column_category' => json_decode($data->two_column_category,true),
            'feature_category' => json_decode($data->feature_category,true),
            'home4_banner' => json_decode($data->home_page4,true),
            'home_4_popular_category' => json_decode($data->home_4_popular_category,true),
        ]);
    }

    public function hero_banner_update(Request $request)
    {
        $request->validate([
            'img1' => 'image',
            'img2' => 'image',
            'title1' => 'required|max:200',
            'title2' => 'required|max:200',
            'subtitle1' => 'required|max:200',
            'url1' => 'required|max:200',
            'url2' => 'required|max:200',

        ]);
        $all_images_names = ['img1','img2'];
        $input = $request->all();
        foreach($all_images_names as $single_image){
            if($request->hasFile($single_image)){
                $data = HomeCutomize::first();
                $check = json_decode($data->hero_banner,true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',isset($check[$single_image]) ? $check[$single_image] : null);
            }
        }

        unset($input['_token']);
        $data = HomeCutomize::first();
        foreach(json_decode($data->hero_banner,true) as $key => $value){
            if(isset($input[$key])){
                $input[$key] =  $input[$key];
            }else{
                $input[$key] = $value;
            }
        }


        $data->hero_banner = json_encode($input,true);
        $data->update();
        return redirect()->back()->withSuccess(__('Banner Update Successfully'));

    }
    public function first_banner_update(Request $request)
    {
        $request->validate([
            'img1' => 'image',
            'img2' => 'image',
            'img3' => 'image',
            'firsturl1' => 'required|max:200',
            'firsturl2' => 'required|max:200',
            'firsturl3' => 'required|max:200',
        ]);
        $all_images_names = ['img1','img2','img3'];

        $input = $request->all();

        $data = HomeCutomize::first();

        foreach($all_images_names as $single_image){
            if($request->hasFile($single_image)){
                $data = HomeCutomize::first();
                $check = json_decode($data->banner_first,true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);
            }else{
                $check = json_decode($data->banner_first,true);
                $input[$single_image] = $check[$single_image];
            }
        }

        unset($input['_token']);


        $data->banner_first = json_encode($input,true);
        $data->update();
        return redirect()->back()->withSuccess(__('Banner Update Successfully'));

    }

    public function secend_banner_update(Request $request)
    {
        $request->validate([
            'img1' => 'image',
            'img2' => 'image',
            'img3' => 'image',
            'url1' => 'required|max:200',
            'url2' => 'required|max:200',
            'url3' => 'required|max:200',
        ]);
        $all_images_names = ['img1','img2','img3'];
        $input = $request->all();

        $data = HomeCutomize::first();

        foreach($all_images_names as $single_image){
            if($request->hasFile($single_image)){
                $data = HomeCutomize::first();
                $check = json_decode($data->banner_secend,true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);
            }else{
                $check = json_decode($data->banner_secend,true);
                $input[$single_image] = $check[$single_image];
            }
        }

        unset($input['_token']);


        $data->banner_secend = json_encode($input,true);
        $data->update();
        return redirect()->back()->withSuccess(__('Banner Update Successfully'));

    }

    public function third_banner_update(Request $request)
    {

        $request->validate([
            'img1' => 'image',
            'img2' => 'image',
            'url1' => 'required|max:200',
            'url2' => 'required|max:200',
        ]);
        $all_images_names = ['img1','img2'];

        $input = $request->all();
        $data = HomeCutomize::first();

        foreach($all_images_names as $single_image){
            if($request->hasFile($single_image)){
                $data = HomeCutomize::first();
                $check = json_decode($data->banner_third,true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);
            }else{
                $check = json_decode($data->banner_third,true);
                $input[$single_image] = $check[$single_image];
            }
        }
        unset($input['_token']);




        $data->banner_third = json_encode($input,true);
        $data->update();
        return redirect()->back()->withSuccess(__('Banner Update Successfully'));

    }


    public function popular_category_update(Request $request)
    {
        $request->validate([
            'popular_title' => 'required|max:255',
        ]);
        $input = $request->all();
        unset($input['_token']);
        $data = HomeCutomize::first();
        $data->popular_category = json_encode($input,true);
        $data->update();
        $this->clearHomeCache();
        return redirect()->back()->withSuccess(__('Popular Category Update Successfully'));
    }

    public function tree_column_category_update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $data = HomeCutomize::first();
        $data->two_column_category = json_encode($input,true);
        $data->update();
        $this->clearHomeCache();
        return redirect()->back()->withSuccess(__('Tree Column Category Update Successfully'));
    }


    public function feature_category_update(Request $request)
    {
        $request->validate([
            'feature_title' => 'required|max:255',
        ]);
        $input = $request->all();
        unset($input['_token']);
        $data = HomeCutomize::first();
        $data->feature_category = json_encode($input,true);
        $data->update();
        $this->clearHomeCache();
        return redirect()->back()->withSuccess(__('Popular Category Update Successfully'));
    }


    public function homepage4update(Request $request)
    {
        $request->validate([
            'img1' => 'image',
            'img2' => 'image',
            'img3' => 'image',
            'img4' => 'image',
            'img5' => 'image',
            'url1' => 'required|max:200',
            'url2' => 'required|max:200',
            'url3' => 'required|max:200',
            'url4' => 'required|max:200',
            'url5' => 'required|max:200',
            'label1' => 'required|max:200',
            'label2' => 'required|max:200',
            'label3' => 'required|max:200',
            'label4' => 'required|max:200',
            'label5' => 'required|max:200',
        ]);
        $all_images_names = ['img1','img2','img3','img4','img5'];
        $input = $request->all();
        foreach($all_images_names as $single_image){
            if($request->hasFile($single_image)){
                $data = HomeCutomize::first();
                $check = json_decode($data->home_page4,true);
                $input[$single_image] = ImageHelper::handleUploadedImage($request->$single_image,'assets/images',$check[$single_image]);
            }
        }

        unset($input['_token']);

        $data = HomeCutomize::first();
        if(!$data->home_page4){
        $data->home_page4 = json_encode($input,true);
        $data->update();
        }else{
            foreach(json_decode($data->home_page4,true) as $key => $value){
                if(isset($input[$key])){
                    $input[$key] =  $input[$key];
                }else{
                    $input[$key] = $value;
                }
            }
            $data->home_page4 = json_encode($input,true);
            $data->update();
        }

        return redirect()->back()->withSuccess(__('Banner Update Successfully'));


    }


    public function homepage4categoryupdate(Request $request)
    {
       $category = json_encode($request->home_4_popular_category,true);
       $data = HomeCutomize::first();
       $data->home_4_popular_category = $category;
       $data->update();
       return redirect()->back()->withSuccess(__('Banner Update Successfully'));

    }
    public function highlight_banner_update(Request $request)
    {
        $request->validate([
            'highlight_banner' => 'nullable|image|max:10240',
            'highlight_banner_url' => 'nullable|string|max:255'
        ]);

        if($request->hasFile('highlight_banner')){
            $file = $request->file('highlight_banner');
            
            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'File upload failed! Error code: ' . $file->getError() . '. The image might exceed the server upload size limit.');
            }

            $destDir = base_path('../assets/images');
            $pngPath = $destDir . '/featured-banner.png';
            $webpPath = $destDir . '/featured-banner.webp';
            $mobileWebpPath = $destDir . '/featured-banner-mobile.webp';

            // Step 1: Save the original uploaded file as PNG first
            try {
                $file->move($destDir, 'featured-banner.png');
            } catch (\Exception $e) {
                \Log::error('Highlight banner: Failed to move uploaded file: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to save uploaded file: ' . $e->getMessage());
            }
            
            // Step 2: Generate WebP versions from the saved PNG
            try {
                // Desktop WebP - full size
                $img = \Image::make($pngPath);
                if (file_exists($webpPath)) { @unlink($webpPath); }
                $img->encode('webp', 90)->save($webpPath);
                $img->destroy();
                
                // Mobile WebP - resized
                $imgMobile = \Image::make($pngPath);
                if (file_exists($mobileWebpPath)) { @unlink($mobileWebpPath); }
                $imgMobile->resize(767, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 90)->save($mobileWebpPath);
                $imgMobile->destroy();
            } catch (\Exception $e) {
                \Log::error('Highlight banner: WebP generation failed: ' . $e->getMessage());
                // PNG was already saved, so the banner still works even if WebP fails
            }
        } else {
            return redirect()->back()->with('error', 'No file was selected. Please choose an image to upload.');
        }

        $this->clearHomeCache();
        return redirect()->back()->with('success', __('Highlight Banner Updated Successfully'));
    }

    private function clearHomeCache()
    {
        Cache::forget('front_index_data_theme1');
        Cache::forget('front_index_data_theme2');
        Cache::forget('front_index_data_theme3');
        Cache::forget('front_index_data_theme4');
    }
}
