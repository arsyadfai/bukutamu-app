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
        $query = GuestBook::query();

        // Filter berdasarkan tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Mengambil data tamu berdasarkan query
        $guests = $query->orderBy('created_at', 'desc')->get();

        // Mengembalikan view dengan data tamu
        return view('admin.reports', compact('guests'));
    }

    public function export(Request $request)
    {
        $fileType = $request->file_type;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        // Retrieve guest data based on date filter
        $query = GuestBook::query();
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $guests = $query->get();
    
        // Generate file name based on period
        $fileName = 'guests';
        if ($startDate && $endDate) {
            $formattedStartDate = Carbon::parse($startDate)->format('d-m-Y');
            $formattedEndDate = Carbon::parse($endDate)->format('d-m-Y');
            $fileName .= "_{$formattedStartDate}_to_{$formattedEndDate}";
        }
    
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
