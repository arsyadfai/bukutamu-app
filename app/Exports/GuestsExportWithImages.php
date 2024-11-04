<?php

namespace App\Exports;

use App\Models\GuestBook;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class GuestsExportWithImages
{
    protected $guests;

    public function __construct($guests)
    {
        $this->guests = $guests;
    }

    public function exportWithImages($filePath, $startDate, $endDate)
    {
        // Format tanggal periode
        $formattedStartDate = Carbon::parse($startDate)->format('d-m-Y');
        $formattedEndDate = Carbon::parse($endDate)->format('d-m-Y');

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan judul laporan dan periode
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'Laporan Data Tamu');
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', "Periode: $formattedStartDate s/d $formattedEndDate");
        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        $sheet->getStyle('A1:A2')->getAlignment()->setHorizontal('center');

        // Menambahkan header tabel dengan formatting
        $headers = ['ID', 'Foto', 'Nama', 'Alamat', 'No Telepon', 'Jenis Kelamin', 'Bertemu', 'Keperluan'];
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '4', $header);
            $sheet->getStyle($columnLetter . '4')->getFont()->setBold(true);
            $sheet->getStyle($columnLetter . '4')->getAlignment()->setHorizontal('center');
            $columnLetter++;
        }

        // Isi data tamu mulai dari baris 5
        $rowNumber = 5;
        foreach ($this->guests as $guest) {
            $sheet->setCellValue('A' . $rowNumber, $guest->id);
            $sheet->setCellValue('C' . $rowNumber, $guest->name);
            $sheet->setCellValue('D' . $rowNumber, $guest->alamat);
            $sheet->setCellValue('E' . $rowNumber, $guest->nope);
            $sheet->setCellValue('F' . $rowNumber, $guest->jenis_kelamin);
            $sheet->setCellValue('G' . $rowNumber, $guest->bertemu);
            $sheet->setCellValue('H' . $rowNumber, $guest->keperluan);

            // Menambahkan gambar jika tersedia
            if ($guest->photo && file_exists(public_path($guest->photo))) {
                $drawing = new Drawing();
                $drawing->setName('Guest Photo');
                $drawing->setPath(public_path($guest->photo));
                $drawing->setHeight(40); // Atur tinggi gambar
                $drawing->setCoordinates('B' . $rowNumber);
                $drawing->setWorksheet($sheet);
                $drawing->setResizeProportional(true); // Memastikan proporsi gambar terjaga
                $drawing->setOffsetX(5); // Mengatur offset horizontal
                $drawing->setOffsetY(5); // Mengatur offset vertical
            }

            // Atur tinggi baris
            $sheet->getRowDimension($rowNumber)->setRowHeight(50);
            $rowNumber++;
        }

        // Menerapkan border pada tabel
        $lastRow = $rowNumber - 1;
        $sheet->getStyle('A4:H' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Atur lebar kolom secara otomatis setelah mengisi data
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Simpan file Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path($filePath));
    }
}
