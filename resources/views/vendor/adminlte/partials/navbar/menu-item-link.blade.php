<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="relative">

    <a class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 {{ $item['class'] }}"
       href="{{ $item['href'] }}"
       @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

        {{-- Icon (optional) --}}
        @isset($item['icon'])
            <i class="{{ $item['icon'] }} mr-2 {{
                isset($item['icon_color']) ? 'text-' . $item['icon_color'] : ''
            }}"></i>
        @endisset

        {{-- Text --}}
        <span class="flex-grow">{{ $item['text'] }}</span>

        {{-- Label (optional) --}}
        @isset($item['label'])
            <span class="ml-2 px-2 py-0.5 text-xs font-medium rounded-full {{
                'bg-' . ($item['label_color'] ?? 'blue') . '-100 ' .
                'text-' . ($item['label_color'] ?? 'blue') . '-800'
            }}">
                {{ $item['label'] }}
            </span>
        @endisset

    </a>

</li>
