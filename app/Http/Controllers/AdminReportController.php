<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use App\Exports\GuestsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Pastikan Anda mengimpor PDF
use App\Exports\GuestsExportWithImages; // Pastikan Anda mengimpor export dengan gambar
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request)
{
    // Memulai query untuk mengambil data tamu
    $query = GuestBook::query();

    // Filter berdasarkan tanggal jika kedua tanggal ada
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('created_at', [
            Carbon::parse($request->start_date)->startOfDay(),
            Carbon::parse($request->end_date)->endOfDay(),
        ]);
    }

    // Jika tidak ada filter tanggal, tampilkan semua data
    else {
        // Mengurutkan berdasarkan tanggal (semua data)
        $query->orderBy('created_at', 'desc');
    }

    // Pencarian berdasarkan nama, alamat, atau keperluan
    if ($request->search) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%")
              ->orWhere('keperluan', 'like', "%{$search}%");
        });
    }

    // Mengambil data tamu berdasarkan query yang telah difilter
    $guests = $query->get();

    // Mengembalikan view dengan data tamu yang telah difilter
    return view('admin.reports', compact('guests'));
}

public function export(Request $request)
{
    $fileType = $request->file_type;
    $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Retrieve guest data based on date filter
    $query = GuestBook::query();

    // Filter berdasarkan tanggal hanya jika kedua tanggal ada
    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay(),
        ]);
    }

    // Pencarian juga diterapkan pada export
    if ($request->search) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%")
              ->orWhere('keperluan', 'like', "%{$search}%");
        });
    }

    $guests = $query->get();

    // Generate file name based on period
    $fileName = 'data_tamu';
    if ($startDate && $endDate) {
        $formattedStartDate = Carbon::parse($startDate)->format('d-m-Y');
        $formattedEndDate = Carbon::parse($endDate)->format('d-m-Y');
        $fileName .= "_{$formattedStartDate}_to_{$formattedEndDate}";
    }
    
    // Export to selected file type
    switch ($fileType) {
        case 'excel':
            return Excel::download(new GuestsExport($guests), "$fileName.xlsx");

        case 'excel_with_images':
            $filePath = "$fileName.xlsx";
            (new GuestsExportWithImages($guests))->exportWithImages($filePath, $startDate, $endDate);
            return response()->download(public_path($filePath))->deleteFileAfterSend(true);

        case 'pdf':
            $pdf = PDF::loadView('admin.pdf', compact('guests', 'startDate', 'endDate'));
            return $pdf->download("$fileName.pdf");

        default:
            return redirect()->back()->with('error', 'Invalid file type selected');
    }
}

    
    // Fungsi pengujian untuk mengunduh Excel
    public function testExport()
    {
        return Excel::download(new GuestsExport(), 'guests.xlsx');
    }
}
