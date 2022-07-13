@extends('layout.app')

@section('title-block')Todo App @endsection

@section('content')

<div class="container">

    <header class="d-flex flex-wrap justify-content-between mb-3">
        <a href="/" class="d-flex text-dark text-decoration-none">
            <h1 class="my-3">TODO List</h1>
        </a>

        <button type="button" class="btn btn-warning float-end align-self-center" data-bs-toggle="modal" data-bs-target="#createtodo">
            Add TODO
        </button>
    </header>

    @include('createtodo')


    @if (count($errors) > 0)
    <script>
        $(document).ready(function() {
            $('#createtodo').modal('show');
        });
    </script>
    @endif



    <div class="d-flex mb-3">
        <form method="GET" action="{{ route('filter') }}">
            <div class="input-group">
                <select class="form-select" aria-label="Label list" id="label_filter" name="label_filter">
                    <option selected disabled>Select label</option>
                    <option value="home" {{ request()->get('label_filter') == 'home' ? 'selected' : '' }}>home</option>
                    <option value="personal" {{ request()->get('label_filter') == 'personal' ? 'selected' : '' }}>personal</option>
                    <option value="work" {{ request()->get('label_filter') == 'work' ? 'selected' : '' }}>work</option>
                </select>

                <button type="submit" class="btn btn-success">
                    Filter
                </button>
            </div>
        </form>
        <a class="btn btn-primary ms-2" href="/" role="button">Reset</a>
    </div>

    <table class="table table-fixed">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">User</th>
                <th scope="col">Label</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($todos) > 0)
            @foreach($todos as $el)
            <tr>
                <td scope="row">{{ $el->title }}</th>
                <td>{{ $el->description }}</td>
                <td>
                    <form method="POST" action="{{ route('edit_status', $el->id) }}">
                        @csrf
                        <input type="hidden" name="edit_status" value="@if ($el->status == 'new') in progress
                            @elseif ($el->status == 'in progress') complete 
                            @elseif ($el->status == 'complete') closed @endif" />
                        <input type="hidden" name="todo_user" value="{{ $el->user }}">
                        <button type="submit" title="change status" @if ($el->status == 'new') class="btn btn-sm btn-outline-danger"
                            @elseif ($el->status == 'in progress') class="btn btn-sm btn-outline-warning"
                            @elseif ($el->status == 'complete') class="btn btn-sm btn-outline-success"
                            @elseif ($el->status == 'closed') class="btn btn-sm btn-outline-secondary" disabled @endif>{{ $el->status }}</button>
                    </form>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        {{ $el->user }}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-tag me-2" @if ($el->label == 'home') style="color: gold;"
                            @elseif ($el->label == 'work') style="color: darkorchid;"
                            @elseif ($el->label == 'personal') style="color: deepskyblue;" @endif></i>
                        {{ $el->label }}
                    </div>
                </td>
                <td>
                    <div class="row g-1">
                        <div class="col">
                            <a href="{{ route('showonetodo', $el->id) }}"><button type="button" title="view" class="btn btn-sm btn-outline-info">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col">
                            <button type="button" title="edit" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#edittodo{{ $el->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                        <div class="col">
                            <a href="{{ route('deletetodo', $el->id) }}"><button type="button" title="delete" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>

            @include('edittodo')
            @endforeach
            @else
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger" role="alert">
                        TODO List is empty!
                    </div>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    document.querySelector(".btn-close").addEventListener("click", function() {
        document.getElementById("form-todo").reset();
    });
</script>

@endsection