<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // public function userIndex()
    // {
    //     $galleries = Gallery::latest()->paginate(9);
    //     return view('user.gallery.index', compact('galleries'));
    // }

    // public function userShow(Gallery $gallery)
    // {
    //     return view('user.gallery.show', compact('gallery'));
    // }
    public function userIndex()
    {
        $galleries = Gallery::latest()->paginate(9);
        return view('user.gallery.index', compact('galleries'));
    }

    public function userShow($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Increment views count
        $gallery->increment('views');

        // Get all galleries for recommendations (excluding current)
        $galleries = Gallery::where('id', '!=', $id)->latest()->get();

        return view('user.gallery.show', compact('gallery', 'galleries'));
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $imagePath = $request->file('image')->store('galleries', 'public');
        } else {
            $imagePath = $gallery->image;
        }

        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil diupdate!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery berhasil dihapus!');
    }
}
