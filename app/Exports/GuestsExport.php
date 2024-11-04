<?
namespace App\Exports;

use App\Models\GuestBook;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return GuestBook::all(); // Ambil semua data tamu
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Alamat',
            'No. Telepon',
            'Asal Instansi',
            'Jenis Kelamin',
            'Bertemu',
            'Keperluan',
            'Foto',
        ];
    }

    public function map($guest): array
    {
        return [
            $guest->id,
            $guest->nama,
            $guest->alamat,
            $guest->nope,
            $guest->asal_instansi,
            $guest->jenis_kelamin,
            $guest->bertemu,
            $guest->keperluan,
            // Jika Anda ingin menampilkan foto, Anda perlu menambahkan URL ke gambar atau path
            $guest->foto ? asset('uploads/guest_photos/' . $guest->foto) : 'Tidak ada foto',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Misalkan Anda ingin mengatur format tabel
            1 => ['font' => ['bold' => true]], // Mengatur baris header menjadi bold
        ];
    }
}
