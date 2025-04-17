<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    // Display all tags
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    // Show the form to create a new tag
    public function create()
    {
        return view('admin.tags.create');
    }

    // Store a newly created tag
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tag,name',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully!');
    }

    // Show the form to edit an existing tag
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    // Update an existing tag
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tag,name,' . $id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully!');
    }

    // Delete a tag
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully!');
    }

    // Show details of a single tag
    public function show($id)
    {
        $tag = Tag::with('tours')->findOrFail($id);
        return view('admin.tags.show', compact('tag'));
    }
}
