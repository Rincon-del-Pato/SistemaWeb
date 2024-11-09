<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="relative">

    {{-- Menu toggler --}}
    <a class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $item['class'] }}"
       href="#"
       data-toggle="dropdown" {!! $item['data-compiled'] ?? '' !!}>

        {{-- Icon (optional) --}}
        @isset($item['icon'])
            <i class="{{ $item['icon'] }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }} mr-3"></i>
        @endisset

        {{-- Text --}}
        <span>{{ $item['text'] }}</span>

        {{-- Label (optional) --}}
        @isset($item['label'])
            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $item['label_color'] ?? 'blue' }}-100 text-{{ $item['label_color'] ?? 'blue' }}-800">
                {{ $item['label'] }}
            </span>
        @endisset

    </a>

    {{-- Menu items --}}
    <ul class="absolute left-0 hidden w-48 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 group-hover:block">
        @each('adminlte::partials.navbar.dropdown-item', $item['submenu'], 'item')
    </ul>

</li>
