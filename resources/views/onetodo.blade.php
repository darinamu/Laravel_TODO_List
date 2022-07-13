@extends('layout.app')

@section('title-block'){{ $onetodo->title }}@endsection

@section('content')

<div class="container">
    <header class="mb-3">
        <a href="/" class="d-flex text-dark text-decoration-none">
            <h1 class="my-3">TODO List</h1>
        </a>
    </header>

    <div class="card @if ($onetodo->status == 'new') border-danger
                            @elseif ($onetodo->status == 'in progress') border-warning
                            @elseif ($onetodo->status == 'complete') border-success
                            @elseif ($onetodo->status == 'closed') border-secondary @endif" style="max-width: 18rem;">
        <div class="card-body">
            <h3 class="card-title mb-3">Title: {{ $onetodo->title }}</h3>
            <p class="card-text mb-1"><span class="fw-bold">Description:</span> {{ $onetodo->description }}</p>
            <p class="card-text mb-1 @if ($onetodo->status == 'new') text-danger
                            @elseif ($onetodo->status == 'in progress') text-warning
                            @elseif ($onetodo->status == 'complete') text-success
                            @elseif ($onetodo->status == 'closed') text-secondary @endif>"><span class="fw-bold text-dark">Status:</span> {{ $onetodo->status }}</p>
            <p class="card-text mb-1"><span class="fw-bold"><i class="fa-solid fa-user"></i></span> {{ $onetodo->user }}</p>
            <p class="card-text"><span class="fw-bold"><i class="fa-solid fa-tag" @if ($onetodo->label == 'home') style="color: gold;"
                        @elseif ($onetodo->label == 'work') style="color: darkorchid;"
                        @elseif ($onetodo->label == 'personal') style="color: deepskyblue;" @endif></i></span> {{ $onetodo->label }}</p>
        </div>

        @if (count($statuses) > 0)

        <div class="card-footer bg-transparent @if ($onetodo->status == 'new') border-danger
                            @elseif ($onetodo->status == 'in progress') border-warning
                            @elseif ($onetodo->status == 'complete') border-success
                            @elseif ($onetodo->status == 'closed') border-secondary @endif">
            <ul class="list-group list-group-flush">
                
                @foreach($statuses as $elem)
                <li class="list-group-item">{{ $elem->todo_user }} change status to <span class="fw-bold @if ($elem->todo_status == 'new') text-danger
                                @elseif ($elem->todo_status == 'in progress') text-warning
                                @elseif ($elem->todo_status == 'complete') text-success
                                @elseif ($elem->todo_status == 'closed') text-secondary @endif">{{ $elem->todo_status }}</span> <br> {{ $elem->created_at->format('Y-m-d') }}</li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

@endsection