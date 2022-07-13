<div class="modal fade" id="edittodo{{ $el->id }}" tabindex="-1" aria-labelledby="edittodoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edittodoLabel">Edit TODO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit', $el->id) }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $el->title }}">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Description" id="description" name="description">{{ $el->description }}</textarea>
                    </div>
                    <input type="hidden" id="status" name="status" value="{{ $el->status }}">
                    <select class="form-select mb-3" aria-label="User list" id="user" name="user">
                        <option selected disabled>Select user</option>
                        <option value="darina" {{ $el->user == 'darina' ? 'selected' : '' }}>Darina</option>
                        <option value="marius" {{ $el->user == 'marius' ? 'selected' : '' }}>Marius</option>
                        <option value="dominykas" {{ $el->user == 'dominykas' ? 'selected' : '' }}>Dominykas</option>
                    </select>
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <label for="radiobtn" class="form-label">Select label:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="hometodo" value="home" @if($el->label == 'home') checked @endif>
                            <label class="form-check-label" for="hometodo">Home</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="personaltodo" value="personal" @if($el->label == 'personal') checked @endif>
                            <label class="form-check-label" for="personaltodo">Personal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="worktodo" value="work" @if($el->label == 'work') checked @endif>
                            <label class="form-check-label" for="worktodo">Work</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>