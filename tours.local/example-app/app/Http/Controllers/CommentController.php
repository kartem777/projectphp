<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
        // Зберігаємо новий коментар
    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:post,id',
        ]);

        Comment::create([
            'comment' => $data['comment'],
            'post_id' => $data['post_id'],
            'user_id' => auth()->id(),
            'tour_id' => null,
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
