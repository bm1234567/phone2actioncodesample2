@extends('layouts.app')

@section('pagetitle')
    Blog
@endsection

@section('content')

    {{--
    <div>
        <div dusk="blog-title">{{ $blog->title }}</div>
        <div>{{ $blog->description }}</div>
        <a href="{{ route('blogs.edit', $blog->id) }}" dusk="blog-edit-link">Edit</a>
        <button dusk="blog-delete-link" @click="confirmDelete('Are you sure?', {{ $blog->id }})">Delete</button>
    </div>
    --}}

    <div class="card" style="width: 18rem;">
        {{--<img class="card-img-top" src="..." alt="Card image cap">--}}
        <div class="card-body">
            <h5 class="card-title" dusk="blog-title">{{ $blog->title }}</h5>
            <p class="card-text">{{ $blog->description }}</p>

            <a href="{{ route('blogs.edit', $blog->id) }}"
               class="btn btn-primary"
               dusk="blog-edit-link"
            >
                Edit
            </a>
            <button class="btn btn-primary"
                    @click="confirmDelete('Are you sure?', {{ $blog->id }})"
                    dusk="blog-delete-link"
            >
                Delete
            </button>
        </div>
    </div>
@endsection

