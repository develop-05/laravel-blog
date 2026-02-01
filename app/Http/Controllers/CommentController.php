<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'comment' => ['required'],
            'post_id' => ['required', 'exists:posts,id']
        ]);

        if ($validator->fails()) {
            $errors = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errors .= "<li>$error</li>";
            }
            $errors .= '</ul>';
            return response()->json([
                'status' => 'error',
                'data' => $errors,
            ]);
        }

        $comment = Comment::query()->create($validator->validated());
        return response()->json([
            'status' => 'success',
            'data' => 'Comment added successfully',
            'comment' => view('comments.new-comment', compact('comment'))->render(),
        ]);
        return redirect()->route('posts.single', ['slug' => $comment->post->slug, '#comments']);
    }
}
