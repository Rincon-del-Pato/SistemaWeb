<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">

    <a class="nav-link flex items-center gap-3 text-base {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>

        <span class="overflow-hidden nav-text">
            {{ $item['text'] }}

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} float-right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </span>

    </a>

</li>


{{-- <li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">

    <a class="flex items-center p-2 text-base text-white rounded hover:bg-blue-700 {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : 'text-white'
        }} "></i>

        <span class="ml-3 font-normal">
            {{ $item['text'] }}

            @isset($item['label'])
                <span class="inline-flex items-center justify-center px-2 ml-3 text-xs font-medium text-white rounded {{ $item['label_color'] ? 'bg-'.$item['label_color'] : 'bg-white' }}">
                    {{ $item['label'] }}
                </span>
            @endisset
        </span>

    </a>

</li> --}}
