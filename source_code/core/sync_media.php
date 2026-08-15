use App\Models\MediaManager;
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
echo "Added $count images to Media Gallery.\n";
