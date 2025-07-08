<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousel = Carousel::latest()->get();
        return view('backend.carousel.index', compact('carousel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('carousel', $image->hashName());

        //create Carousel
        Carousel::create([
            'judul' => $request->judul,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('carousel.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $carousel = Carousel::findOrFail($id);

        //render view with product
        return view('backend.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get product by ID
        $carousel = Carousel::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('carousel/' . $carousel->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('carousel', $image->hashName());

            //update product with new image
            $carousel->update([
                'judul' => $request->judul,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $carousel->update([
                'judul' => $request->judul,
            ]);
        }

        //redirect to index
        return redirect()->route('carousel.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $carousel = Carousel::findOrFail($id);

        //delete image
        Storage::delete('carousel/' . $carousel->foto);

        //delete image
        $carousel->delete();

        //redirect to index
        return redirect()->route('carousel.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
