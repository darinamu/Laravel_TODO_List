<div class="modal fade" id="createtodo" tabindex="-1" aria-labelledby="createtodoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createtodoLabel">New TODO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if ($errors->any())
                <div class="alert alert-danger erorrs">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <script>
                </script>

                @endif
                <form method="POST" action="/create" id="form-todo">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Description" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                    <input type="hidden" id="status" name="status" value="new">
                    <select class="form-select mb-3" aria-label="User list" id="user" name="user">
                        <option selected disabled>Select user</option>
                        <option value="darina" {{ old('user') == 'darina' ? 'selected' : '' }}>Darina</option>
                        <option value="marius" {{ old('user') == 'marius' ? 'selected' : '' }}>Marius</option>
                        <option value="dominykas" {{ old('user') == 'dominykas' ? 'selected' : '' }}>Dominykas</option>
                    </select>
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <label for="radiobtn" class="form-label">Select label:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="hometodo" value="home" @if(old('todoTag')=='home' ) checked @endif>
                            <label class="form-check-label" for="hometodo">Home</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="personaltodo" value="personal" @if(old('todoTag')=='personal' ) checked @endif>
                            <label class="form-check-label" for="personaltodo">Personal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="todoTag" id="worktodo" value="work" @if(old('todoTag')=='work' ) checked @endif>
                            <label class="form-check-label" for="worktodo">Work</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>