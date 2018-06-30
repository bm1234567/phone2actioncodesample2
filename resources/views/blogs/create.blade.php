@extends('layouts.app')

@section('pagetitle')
    Create Blog
@endsection

@section('content')
    <form method="POST" action="{{ route('blogs.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="blog-title">Title</label>

            <input type="text"
                   class="form-control"
                   id="blog-title"
                   aria-describedby="Blog Title"
                   placeholder="Enter title"
                   name="title"
                   value="{{ old('title') }}"
            >

            <small id="titleHelp" class="form-text text-muted">Title your personal blog. Great for journalling!</small>
        </div>

        <div class="form-group">
            <label for="blog-description">Description</label>

            <textarea type="text"
                   class="form-control"
                   id="blog-description"
                   aria-describedby="Blog Description"
                   placeholder="Enter description"
                   name="description"
            >{{ old('description') }}</textarea>

            <small id="descriptionHelp" class="form-text text-muted">Talking to yourself has never been better</small>
        </div>

        <button dusk="create-button">Create</button>
    </form>
@endsection