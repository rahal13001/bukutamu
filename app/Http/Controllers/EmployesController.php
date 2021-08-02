<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Employe::query();
            return DataTables::of($query)
                // return view('admin.employes.employes')
                ->addColumn('aksi', function ($item) {
                    return '
                <a href = "' . route('pegawai_edit', $item->id) . '"g
                class = "btn btn-warning float-left">
                    Edit </a>

                <form action="' . route('pegawai_delete', $item->id) . '" method="POST" class="delete-form">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger" onclick = "return confirm(\'Anda yakin ingin menghapus data ?\') ">
                                    Hapus
                                </button>
                            </form>
                            
                ';
                })->rawColumns(['aksi'])
                ->make();
        }

        return view('admin.pegawai.pegawai');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Employe::create($data);
        return redirect()->route('pegawai_index')->with('status', 'Data Pegawai Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        return view('admin.pegawai.edit', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        Employe::where('id', $employe->id)
            ->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,

            ]);
        return redirect()->route('pegawai_index')->with('status', 'Data Pegawai Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        Employe::destroy($employe->id);
        return redirect()->route('pegawai_index')->with('status', 'Data Pegawai Berhasil Dihapus');
    }
}
