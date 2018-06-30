<?php

namespace App\Http\Controllers;

//use App\Blog;
use App\Repository\BlogRepository;  // Why might we replace App\Blog with App\BlogRepository?
                                    // Please See Notes in: App\Repository\BlogRepository.php file

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blogs.index', [
            'blogs' => BlogRepository::getBlogIndex(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        BlogRepository::createBlog($request->all(), auth()->user()->id);

        Log::info('Blog Created'); //arbitrary logging just for demo purposes

        return redirect()
            ->route('blogs.index')
            ->with('message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
//    public function show(Blog $blog)
    public function show(BlogRepository $blog)
    {
        return view('blogs.show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
//    public function edit(Blog $blog)
    public function edit(BlogRepository $blog)
    {
        return view('blogs.edit', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, Blog $blog)
    public function update(Request $request, BlogRepository $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $blog->update($request->all());

        Log::info('Blog Updated'); //arbitrary logging just for demo purposes

        return redirect()
            ->route('blogs.index')
            ->with('message', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Blog $blog)
    public function destroy(BlogRepository $blog)
    {
//        return redirect()
//            ->route('blogs.index')
//            ->with('message', 'Deleted');


        $blog->delete();

        Log::info('Blog Deleted'); //arbitrary logging just for demo purposes

        session()->flash('message', 'Deleted');

        return ['redirect' => route('blogs.index')];
    }
}
