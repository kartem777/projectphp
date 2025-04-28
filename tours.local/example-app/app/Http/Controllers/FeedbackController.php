<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index() {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }
    public function indexadmin() {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function store(Request $request) {
        $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'description' => $request->input('description'),
        ]);

        return redirect()->back()->with('success', 'Ми отримали ваш лист!');
    }
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedbacks.index')->with('success', 'Відгук видалено успішно.');
    }
}
