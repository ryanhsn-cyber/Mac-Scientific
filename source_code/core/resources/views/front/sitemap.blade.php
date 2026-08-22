{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    {{-- Homepage --}}
    <url>
        <loc>{{ route('front.index') }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Shop / Catalog --}}
    <url>
        <loc>{{ route('front.catalog') }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- Categories --}}
    @foreach ($categories as $category)
    <url>
        <loc>{{ route('front.catalog') . '?category=' . $category->slug }}</loc>
        <lastmod>{{ !empty($category->updated_at) ? date('Y-m-d\TH:i:sP', strtotime($category->updated_at)) : date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Products with Images --}}
    @foreach ($items as $item)
    <url>
        <loc>{{ route('front.product', $item->slug) }}</loc>
        <lastmod>{{ !empty($item->updated_at) ? date('Y-m-d\TH:i:sP', strtotime($item->updated_at)) : date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        @if (!empty($item->photo) || !empty($item->thumbnail))
        <image:image>
            <image:loc>{{ asset('assets/images/' . ($item->photo ?: $item->thumbnail)) }}</image:loc>
            <image:title>{{ htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8') }}</image:title>
            <image:caption>{{ htmlspecialchars($item->sort_details ?: $item->name, ENT_QUOTES, 'UTF-8') }}</image:caption>
        </image:image>
        @endif
    </url>
    @endforeach

    {{-- Blog Index --}}
    <url>
        <loc>{{ route('front.blog') }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Blog Posts --}}
    @foreach ($posts as $post)
    <url>
        <loc>{{ route('front.blog.details', $post->slug) }}</loc>
        <lastmod>{{ !empty($post->updated_at) ? date('Y-m-d\TH:i:sP', strtotime($post->updated_at)) : date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        @if (!empty($post->photo))
        <image:image>
            <image:loc>{{ asset('assets/images/' . $post->photo) }}</image:loc>
            <image:title>{{ htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8') }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach

    {{-- CMS Pages --}}
    @foreach ($pages as $page)
    <url>
        <loc>{{ route('front.page', $page->slug) }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- Contact Page --}}
    <url>
        <loc>{{ route('front.contact') }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
