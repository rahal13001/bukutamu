<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class AdminbooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'email' => 'required|email',
            'lokasi' => 'required',
            'datang' => 'required',
            'keperluan' => 'required',
        ]);

        $data = $request->all();
        Book::create($data);
        return redirect('/data')->with('status', 'Data Tamu Berhasil Ditambah');
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
    public function edit(Book $book)
    {
        return view('admin.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'instansi' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'email' => 'required|email',
            'lokasi' => 'required',
            'datang' => 'required',
            'keperluan' => 'required',
        ]);

        Book::where('id', $book->id)
            ->update([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'instansi' => $request->instansi,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jk' => $request->jk,
                'datang' => $request->datang,
                'keperluan' => $request->keperluan,
                'pulang' => $request->pulang,
                'lokasi' => $request->lokasi,
            ]);
        return redirect('/data')->with('status', 'Data Tamu Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect()->route('data')->with('status', 'Data Tamu Berhasil Dihapus');
    }
}
