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
        $videos = Video::latest()->get();
        return view('backend.video.index', compact('videos'));
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
        $videos = $request->file('video');
        $videos->storeAs('videos', $videos->hashName());

        //create product
        Video::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video' => $videos->hashName(),
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
        $videos = video::findOrFail($id);

        //render view with product
        return view('backend.video.edit', compact('videos'));
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
            'video' => 'mimetypes:video/mp4,video/avi,video/quicktime|max:20000',
        ]);

        //get product by ID
        $videos = Video::findOrFail($id);

        //check if video is uploaded
        if ($request->hasFile('video')) {
            //delete old video
            Storage::delete('videos/' . $videos->video);

            //upload new video
            $file = $request->file('video');
            $file->storeAs('videos', $file->hashName());

            //update product with new image
            $videos->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'video' => $file->hashName(),
            ]);
        } else {
            //update product without image
            $videos->update([
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
        $videos = video::findOrFail($id);

        //delete video
        Storage::delete('videos/' . $videos->video);

        //delete video
        $videos->delete();

        //redirect to index
        return redirect()->route('video.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
