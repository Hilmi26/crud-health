<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $artikel = Artikel::all();
        $kategori = Kategori::all();
        return view('layouts/artikel', compact('artikel'), ['kategori' => $kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data['foto'] = Storage::put('img', $request->file('foto'));
        Artikel::create($data);

        return redirect('/artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $artikel = Artikel::find($id);
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('img');
            $artikel->id = $artikel->id;
            $artikel->judul = $request->judul;
            $artikel->isi = $request->isi;
            $artikel->foto = $file;
            $artikel->save();
        } else {
            $artikel->id = $artikel->id;
            $artikel->judul = $request->judul;
            $artikel->isi = $request->isi;
            $artikel->foto;
            $artikel->save();
        }

        return redirect('/artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Artikel::find($id)->delete();
        return redirect('/artikel');
    }
}
