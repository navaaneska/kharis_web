<div class="d-flex">
    <a href="{{ route('events.show', ['event' => $event->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i
            class="fa fa-eye"></i></a>
    <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i
            class="bi-pencil-square"></i></a>

    <div>
        <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete" {{-- data-name="{{ $employee->firstname . ' ' . $employee->lastname }}" --}}>
                <i class="bi-trash"></i>
            </button>
        </form>
    </div>

    <a href="{{ route('events-media.createNew', ['id' => $event->id]) }}"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
        Create Media</a>
    <a href="{{ route('events-peserta.show', ['events_pesertum' => $event->id]) }}"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
        Peserta</a>
</div>
