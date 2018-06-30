@extends('layouts.app')

@section('pagetitle')
    Edit Blog
@endsection

@section('content')
    {{--
    <form method="POST" action="{{ route('blogs.update', $blog->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input name="title" value="{{ old('title', $blog->title) }}">
        <textarea name="description">{{ old('description', $blog->description) }}</textarea>
        <button dusk="update-button">Update</button>
    </form>
    --}}


    <form method="POST" action="{{ route('blogs.update', $blog->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="blog-title">Title</label>

            <input type="text"
                   class="form-control"
                   id="blog-title"
                   aria-describedby="Blog Title"
                   placeholder="Enter title"
                   name="title"
                   value="{{ old('title', $blog->title) }}"
            >

            <small id="titleHelp" class="form-text text-muted">
                Title your personal blog. Great for journalling!
            </small>
        </div>

        <div class="form-group">
            <label for="blog-description">Description</label>

            <textarea type="text"
                      class="form-control"
                      id="blog-description"
                      aria-describedby="Blog Description"
                      placeholder="Enter description"
                      name="description"
            >{{ old('description', $blog->description) }}</textarea>

            <small id="descriptionHelp" class="form-text text-muted">Talking to yourself has never been better</small>
        </div>

        <button dusk="update-button">Update</button>

    </form>
@endsection