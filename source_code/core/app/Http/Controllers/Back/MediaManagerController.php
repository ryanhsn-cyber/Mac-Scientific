<?php

namespace App\Http\Controllers\Back;

use App\Models\MediaManager;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }

    public function index()
    {
        $images = MediaManager::orderBy('id', 'desc')->get();
        return view('back.media.index', compact('images'));
    }

    public function create()
    {
        return view('back.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image',
            'title' => 'nullable|max:255',
        ]);

        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'), 'assets/images');
        $media = MediaManager::create($input);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'url' => asset('assets/images/' . $media->photo)
            ]);
        }

        return redirect()->route('back.media.index')->withSuccess(__('Image Uploaded Successfully.'));
    }

    public function destroy($id)
    {
        $media = MediaManager::findOrFail($id);
        ImageHelper::handleDeletedImage($media, 'photo', 'assets/images/');
        $media->delete();
        
        return redirect()->route('back.media.index')->withSuccess(__('Image Deleted Successfully.'));
    }

    public function sync()
    {
        $dir = base_path('../assets/images');
        $files = array_diff(scandir($dir), array('.', '..'));
        $count = 0;
        foreach($files as $file) {
            if(!is_dir($dir.'/'.$file)) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                    $exists = MediaManager::where('photo', $file)->exists();
                    if(!$exists) {
                        MediaManager::create(['photo' => $file, 'title' => $file]);
                        $count++;
                    }
                }
            }
        }
        return redirect()->route('back.media.index')->withSuccess(__("Successfully synced {$count} images to Media Gallery."));
    }
}
