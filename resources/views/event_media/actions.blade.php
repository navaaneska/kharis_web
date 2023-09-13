<div class="d-flex">
    <a href="{{ route('events-media.show', ['events_medium' => $media->id]) }}"
        class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
    <a href="{{ route('events-media.edit', ['events_medium' => $media->id]) }}"
        class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

    <div>
        <form action="{{ route('events-media.destroy', ['events_medium' => $media->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete" {{-- data-name="{{ $employee->firstname . ' ' . $employee->lastname }}" --}}>
                <i class="bi-trash"></i>
            </button>
        </form>
    </div>
</div>
