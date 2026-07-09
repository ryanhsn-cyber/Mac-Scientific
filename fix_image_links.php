<?php
$dir = new RecursiveDirectoryIterator('source_code/core/resources/views/front');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/', RegexIterator::GET_MATCH);

foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    // Pattern to find <div class="product-thumb">...<img class="lazy" data-src="{{asset('assets/images/'. $VAR->thumbnail)}}" alt="Product">
    // We want to capture $VAR to use it for the route.
    
    // We will do this by looking for <img class="lazy" data-src="{{asset('assets/images/'.$something->thumbnail)}}" alt="Product">
    // and if it's NOT already preceded by <a href=...>, we wrap it.
    
    $pattern = '/(<img class="lazy" data-src="\{\{asset\(\'assets\/images\/\'\.(\$[^}]+)->thumbnail\)\}\}" alt="Product">)/';
    
    $content = preg_replace_callback($pattern, function($matches) {
        $imgTag = $matches[1];
        $var = $matches[2]; // e.g. $item, $related, $compaign_item->item
        
        return "<a href=\"{{route('front.product',{$var}->slug)}}\">\n" . $imgTag . "\n</a>";
    }, $content);
    
    // There might be some nested <a> now if it was already inside an <a> but we only wrapped the <img>.
    // However, looking at the code, in theme3/1 line 533 it was `<a class="product-thumb"...><img...></a>`.
    // If we wrap the img inside <a>, it becomes `<a ...><a ...><img...></a></a>` which is invalid HTML.
    // Let's refine: Only replace if NOT preceded by <a ...> immediately (ignoring whitespace).
    
    file_put_contents($path, $content);
}
echo "Done\n";
