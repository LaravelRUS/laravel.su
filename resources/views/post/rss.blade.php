<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[{{ $meta['title'] }}]]></title>
        <link><![CDATA[{{ url($meta['link']) }}]]></link>
        <description><![CDATA[{{ $meta['description'] }}]]></description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ $meta['updated'] }}</pubDate>

        @foreach($items as $item)
            <item>
                <title><![CDATA[{{ $item->title }}]]></title>
                <link>{{ url($item->link) }}</link>
                <description><![CDATA[{!! $item->title !!}]]></description>
                <author><![CDATA[{{ $item->authorName }}]]></author>
                <guid isPermaLink="false">{{ $item->id }}</guid>
                <pubDate>{{ $item->updated->toRssString() }}</pubDate>
                @if($item->__isset('enclosure'))
                    <enclosure url="{{ url($item->enclosure) }}" length="{{ $item->enclosureLength }}" type="{{ $item->enclosureType }}" />
                @endif
                @foreach($item->category as $category)
                    <category>{{ $category }}</category>
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>