<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class BooksExport implements FromQuery, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    protected $from_date;
    protected $to_date;

    public function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function query()
    {
        if (!empty($this->from_date)) {
            if ($this->from_date === $this->to_date) {
                $data = DB::table('books')
                    ->join('employes', 'books.employes_id', 'employes.id')
                    ->where('tanggal', '=', $this->to_date)
                    ->select('tanggal', 'nama', 'jk', 'instansi', 'no_hp', 'employes.name', 'email', 'keperluan', 'lokasi', 'suhu', 'datang', 'pulang')->orderBy('tanggal');
            } else {
                $data = DB::table('books')
                    ->join('employes', 'books.employes_id', 'employes.id')
                    ->whereBetween('tanggal', [$this->from_date, $this->to_date])
                    ->select('tanggal', 'nama', 'jk', 'instansi', 'no_hp', 'employes.name', 'email', 'keperluan', 'lokasi', 'suhu', 'datang', 'pulang')->orderBy('tanggal');
            }  // return Book::query()->whereBetween('tanggal', [$this->from_date, $this->to_date]);
        } else {
            $data =  DB::table('books')
                ->join('employes', 'books.employes_id', 'employes.id')
                ->select('tanggal', 'nama', 'jk', 'instansi', 'no_hp',  'employes.name', 'email', 'keperluan', 'lokasi', 'suhu', 'datang', 'pulang')->orderBy('tanggal');
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Jenis Kelamin',
            'Instansi',
            'Nomor HP',
            'Menemui',
            'Email',
            'Keperluan',
            'Lokasi',
            'Suhu',
            'Datang',
            'Pulang',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 26,
            'C' => 12,
            'D' => 25,
            'E' => 15,
            'F' => 45,
            'G' => 55,
            'H' => 55,
            'I' => 10,
            'J' => 10,
            'K' => 10,
            'L' => 10,

        ];
    }
}
