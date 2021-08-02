<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\BooksExport;
use App\Models\Employe;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isNull;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timezone($location)
    {
        return date_default_timezone_set($location);
    }

    public function index()
    {
        $waktu = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $this->timezone($waktu->timezone);
        $employe = Employe::all();
        return view('user.books', compact('employe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employe = Employe::all();
        return view('user.books', compact('employe'));
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
            'instansi' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'email' => 'required|email',
            'lokasi' => 'required',
            'pegawai' => 'required',
            'suhu' => 'between:1,99999999.99'
        ]);

        $tanggal = date('Y-m-d');
        $datang = date('H:i:s');
        $pulang = date('H:i:s');
        $nama = $request->nama;
        $instansi = $request->instansi;
        $no_hp = $request->no_hp;
        $jk = $request->jk;
        $email = $request->email;
        $keperluan = $request->keperluan;
        $lokasi = $request->lokasi;
        $btnIn = $request->btnIn;
        $btnOut = $request->btnOut;
        $employes_id = $request->pegawai;
        $suhu = $request->suhu;

        $book = new Book;
        if ($btnIn == 1) {
            //cek data dobel
            $cek_dobel = $book->where(['tanggal' => $tanggal, 'no_hp' => $no_hp]);
            $null = $cek_dobel->whereNull('pulang')->count();
            $notnull = $cek_dobel->whereNotNull('pulang')->count();

            if ($null > 0) {
                return redirect()->back()->with('status', 'Anda Sudah Mengisi Data Kedatangan, Mohon Isi Data Kembali Saat Pulang');
            } elseif ($notnull > 0) {
                $book->create([
                    'tanggal' => $tanggal,
                    'datang' => $datang,
                    // 'pulang' => $pulang,
                    'instansi' => $instansi,
                    'no_hp' => $no_hp,
                    'nama' => $nama,
                    'jk' => $jk,
                    'email' => $email,
                    'keperluan' => $keperluan,
                    'lokasi' => $lokasi,
                    'employes_id' => $employes_id,
                    'suhu' => $suhu
                ]);
            }

            //save data datang
            $book->create([
                'tanggal' => $tanggal,
                'datang' => $datang,
                // 'pulang' => $pulang,
                'instansi' => $instansi,
                'no_hp' => $no_hp,
                'nama' => $nama,
                'jk' => $jk,
                'email' => $email,
                'keperluan' => $keperluan,
                'lokasi' => $lokasi,
                'employes_id' => $employes_id,
                'suhu' => $suhu
            ]);
        } elseif ($btnOut == 1) {

            //cek apakah sudah absen datang atau belum
            $cek_absen = $book->where(['tanggal' => $tanggal, 'no_hp' => $no_hp])->count();
            if ($cek_absen == 0 && isNull('datang')) {
                return redirect()->back()->with('status', 'Anda Belum Mengisi Data Kedatangan, Mohon Isi Terlebih Dahulu');
            } else {
                //simpan absen pulang
                $book->where(['tanggal' => $tanggal, 'no_hp' => $no_hp])->update([
                    'pulang' => $pulang,
                    'keperluan' => $keperluan,
                ]);
            }
        }
        return redirect()->route('index')->with('status', 'Data Berhasil Teregistrasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Request $request)
    {
        if (request()->ajax()) {

            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $query = Book::whereDate('tanggal', '=', $request->from_date)->with(['employe'])->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $query = Book::whereBetween('tanggal', array($request->from_date, $request->to_date))->with(['employe'])->get();
                }
            } else {
                $query = Book::query()->with(['employe']);
            }

            return DataTables::of($query)
                ->addColumn('aksi', function ($book) {
                    return '
            <a href = "' . route('admin_edit', $book->id) . '"
            class = "btn btn-warning float-left">
                Edit </a>
            <form action="' . route('admin_delete', $book->id) . '" method="POST">
                ' . method_field('delete') . csrf_field() . '
                <button type="submit" class="btn btn-danger" onclick = "return confirm(\'Anda yakin ingin menghapus data ?\') ">
                    Hapus
                </button>
            </form>
            ';
                })->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    // public function export()
    // {
    //     return Excel::download(new BooksExport, 'book.xlsx');
    // }

    public function export(Request $request)
    {

        $from_date = $request->from_date;
        $to_date = $request->to_date;


        return Excel::download(new BooksExport($from_date, $to_date), 'bukutamu.xlsx');
    }
}
