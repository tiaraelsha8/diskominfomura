<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::latest()->get();
        return view('backend.video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:20000',
        ]);

        //upload video
        $video = $request->file('video');
        $video->storeAs('video', $video->hashName());

        //create product
        Video::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video' => $video->hashName(),
        ]);

        //redirect to index
        return redirect()->route('video.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get product by ID
        $video = video::findOrFail($id);

        //render view with product
        return view('backend.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:20000',
        ]);

        //get product by ID
        $video = video::findOrFail($id);

        //check if video is uploaded
        if ($request->hasFile('video')) {
            //delete old video
            Storage::delete('video/' . $video->video);

            //upload new video
            $video = $request->file('video');
            $video->storeAs('video', $video->hashName());

            //update product with new video
            $video->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'video' => $video->hashName(),
            ]);
        } else {
            //update product without video
            $video->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        //redirect to index
        return redirect()->route('video.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $video = video::findOrFail($id);

        //delete video
        Storage::delete('video/' . $video->video);

        //delete video
        $video->delete();

        //redirect to index
        return redirect()->route('video.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
