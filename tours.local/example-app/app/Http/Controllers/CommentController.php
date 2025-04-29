<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store_post(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:post,id',
        ]);

        Comment::create([
            'comment' => $data['comment'],
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }

    public function store_tour(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'tour_id' => 'required|exists:tour,id',
        ]);

        Comment::create([
            'comment' => $data['comment'],
            'tour_id' => $data['tour_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }

    public function store_comment(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'comment_id' => 'required|exists:comments,id',
        ]);

        $parentComment = Comment::findOrFail($data['comment_id']);

        Comment::create([
            'comment' => $data['comment'],
            'comment_id' => $parentComment->id,
            'user_id' => auth()->id(),
            'post_id' => $parentComment->post_id,
            'tour_id' => $parentComment->tour_id,
        ]);

        return redirect()->back();
    }


    // Форма редагування коментаря
    public function edit(Comment $comment)
    {
        // Перевіряємо, чи поточний користувач є автором коментаря
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('comments.edit', compact('comment'));
    }

    // Оновлюємо коментар
    public function update(Request $request, Comment $comment)
    {
        // Аналогічна перевірка власника
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update(['body' => $data['body']]);
        // Повертаємось до сторінки посту (наприклад)
        return redirect()->back();
    }

    // Видаляємо коментар
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();
        return redirect()->back();
    }
}
