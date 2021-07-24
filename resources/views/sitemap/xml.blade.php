<?xml version="1.0" encoding="UTF-8"?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    @foreach ( $menuList as $menu )
        <url>
            <loc>{{ config('app.url') . '/' . $menu->id . '/' . str_replace(' ', '-', $menu->menu_name ) }}</loc>
            <lastmod>2021-07-03T04:08:51+00:00</lastmod>
            <priority>0.51</priority>
        </url>
    @endforeach

    @foreach ( $contentList as $content )
        <url>
            <loc>{{ config('app.url') . '/' . $content->id . '/' . str_replace(' ', '-', $content->title ) }}</loc>
            <lastmod>2021-07-03T04:08:51+00:00</lastmod>
            <priority>0.51</priority>
        </url>
    @endforeach

</urlset>