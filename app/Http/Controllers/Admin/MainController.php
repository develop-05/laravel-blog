<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function index()
    {
        $categories_cnt = Category::count();
        $posts_cnt = Post::count();
        $users_cnt = User::count();
        $comments_cnt = Comment::count();

        return view('admin.index', compact('categories_cnt', 'posts_cnt', 'users_cnt', 'comments_cnt'));
    }
}