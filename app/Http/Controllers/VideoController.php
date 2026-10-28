<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::latest('tanggal')->get();

        return view('backend.v_video.index', compact('video'));
    }

    public function create()
    {
        return view('backend.v_video.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'url_video' => 'required|url|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        Video::create($data);

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('backend.v_video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'url_video' => 'required|url|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $video->update($data);

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.video.index')
            ->with('success', 'Video berhasil dihapus.');
    }
        public function indexFrontend()
    {
        $videos = Video::where('status', 'published')
            ->latest('tanggal')
            ->get();

        return view('frontend.video', compact('videos'));
    }
}