<?php
$dir = new RecursiveDirectoryIterator('source_code/core/resources/views/front');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/', RegexIterator::GET_MATCH);

foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    // Use `s` modifier for dot matching newlines, and match the specific structure
    $pattern = '/<a href="\{\{route\(\'front\.product\',\$[^>]+\)\}\}">\s*(<img class="lazy"[^>]+>)\s*<\/a><\/a>/s';
    
    $content = preg_replace_callback($pattern, function($matches) {
        return $matches[1] . "</a>";
    }, $content);
    
    file_put_contents($path, $content);
}
echo "Fixed nested a tags again\n";
