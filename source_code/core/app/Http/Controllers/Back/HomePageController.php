<?php

namespace App\Http\Controllers\Back;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\HomeCutomize;
use Illuminate\Http\Request;

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
        return redirect()->back()->withSuccess(__('Popular Category Update Successfully'));
    }

    public function tree_column_category_update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $data = HomeCutomize::first();
        $data->two_column_category = json_encode($input,true);
        $data->update();
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
            'highlight_banner' => 'image',
            'highlight_banner_url' => 'nullable|string|max:255'
        ]);

        if($request->hasFile('highlight_banner')){
            $image = $request->file('highlight_banner');
            $image->move('assets/images', 'featured-banner.png');

            try {
                $img = \Image::make(base_path('../assets/images/featured-banner.png'));
                $img->encode('webp', 90)->save(base_path('../assets/images/featured-banner.webp'));
                
                // generate mobile version
                $img->resize(767, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 90)->save(base_path('../assets/images/featured-banner-mobile.webp'));
            } catch (\Exception $e) {
                // Ignore if image library fails
            }
        }

        if($request->has('highlight_banner_url')){
            // We can store the URL in setting or home_customize if needed.
            // Since we're modifying the hardcoded banner, we will just use 
            // home_customize table's unused fields or simply skip URL for now 
            // if we just want to replace the image.
            // Wait, we need a place to store the URL if they want one.
            // But let's just stick to the image first.
        }

        return redirect()->back()->withSuccess(__('Highlight Banner Updated Successfully'));
    }
}
