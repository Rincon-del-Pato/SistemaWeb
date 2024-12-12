@props(['command'])

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
        Cambiar Estado
    </button>
    <div class="dropdown-menu">
        @foreach(['Pendiente', 'En_Preparacion', 'Listo'] as $status)
            <form action="{{ route('commands.update-status', $command) }}" method="POST" class="dropdown-item">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ $status }}">
                <button type="submit" class="btn btn-link p-0">
                    {{ $status }}
                </button>
            </form>
        @endforeach
    </div>
</div>
