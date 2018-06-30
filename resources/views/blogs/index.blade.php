@extends('layouts.app')

@section('pagetitle')
    Blogs
@endsection

@section('content')
    <ul class="blogs list-group" dusk="blogs">
        @foreach($blogs as $blog)
            <li class="blog list-group-item list-group-item-action">
                <a class="blog-link" href="{{ route('blogs.show', $blog->id) }}">
                    {{ $blog->title }}
                </a>
            </li>
        @endforeach
    </ul>

    <div>
        {{ $blogs->links() }}
    </div>
@endsection
