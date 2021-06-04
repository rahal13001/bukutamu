<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\BooksExport;
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
        return view('user.books', compact($waktu));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.books');
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


        $book = new Book;
        if ($btnIn == 1) {
            //Zona waktu

            $waktu = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
            $this->timezone($waktu->timezone);
            //cek data dobel
            $cek_dobel = $book->where(['tanggal' => $tanggal, 'no_hp' => $no_hp])->count();

            if ($cek_dobel > 0 && isNull('pulang')) {
                return redirect()->back()->with('status', 'Anda Sudah Mengisi Data Kedatangan, Mohon Isi Data Kembali Saat Pulang');
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
                'lokasi' => $lokasi
            ]);
        } elseif ($btnOut == 1) {

            //Zona Waktu
            $waktu = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
            $this->timezone($waktu->timezone);

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
                    $query = Book::whereDate('tanggal', '=', $request->from_date)->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $query = Book::whereBetween('tanggal', array($request->from_date, $request->to_date))->get();
                }
            } else {
                $query = Book::query();
            }

            return DataTables::of($query)
                ->addColumn('aksi', function ($book) {
                    return '
            <a href = "' . route('admin_edit', $book->id) . '"
            class = "badge badge-warning">
                Edit </a>

            <button type="button" class="badge badge-danger float-right" data-toggle="modal" data-target="#deleteModal">
                Hapus
            </button>
            
            <!-- Modal Delete-->
            <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Yakin mau menghapus data ?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <form action="' . route('admin_delete', $book->id) . '" method="POST">
                    ' . method_field('delete') . csrf_field() . '
                    <button type="submit" class="btn btn-danger float-right">
                        Hapus
                    </button>
                </form>
                    </div>
                </div>
                </div>
            </div>
            ';
                })->rawColumns(['aksi'])
                ->make();
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
