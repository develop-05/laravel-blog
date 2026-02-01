<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(20)->fragment('comments');
        return view('post.index', compact('posts'));
    }

    
    
    
    public function  show($slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->firstOrFail();
        $post->views += 1;
        $post->update();

        $comments = $post->comments()->latest()->paginate(2);
        // dump($comments);

        $related_posts = Post::query()
            ->where('category_id', '=', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(2)
            ->get();

        return view('post.show', [
            'post' => $post,
            'related_posts' => $related_posts,
            'comments' => $comments
        ]);
    }

    public function search(Request $request)
    {
        $posts = Post::query()
        ->whereLike('title', '%' . $request->s . '%')
        ->with('category')
        ->paginate(2)
        ->withQueryString();
        return view('post.search', [
            'posts' => $posts,
        ]);
    }


}
