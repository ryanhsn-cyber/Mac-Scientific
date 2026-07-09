<?php
$files = glob('source_code/core/resources/views/back/item/**/*.blade.php');
$files = array_merge($files, glob('source_code/core/resources/views/back/item/*.blade.php'));

foreach($files as $file) {
    $content = file_get_contents($file);
    
    // We use a regular expression to find a label with an asterisk, followed by some whitespace, 
    // and then an input, select, or textarea tag.
    $pattern = '/(<label[^>]*>.*?\*<\/label>\s*<(input|select|textarea)(?![^>]*\brequired\b)[^>]*?)(\s*>)/is';
    
    // We'll replace it by adding 'required' just before the closing >
    // Exception: type="file" usually handles its own required differently or we shouldn't force it to be required on edit.
    $content = preg_replace_callback($pattern, function($matches) {
        $tag = $matches[0];
        
        // Don't add required to type="file" on edit pages (as it might not be required if already uploaded)
        if (strpos($tag, 'type="file"') !== false) {
            return $tag; // leave unchanged
        }
        
        // Don't add required to summernote textareas as it breaks HTML5 validation sometimes
        // But our custom.js handles required manually by checking prop('required'), so it's actually fine.
        
        return $matches[1] . ' required' . $matches[3];
    }, $content);
    
    file_put_contents($file, $content);
}
echo "Added required attributes successfully.\n";
