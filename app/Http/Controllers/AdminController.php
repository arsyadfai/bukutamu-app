<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;

class AdminController extends Controller
{
    public function index()
    {
        $totalGuests = GuestBook::count(); // Mengambil jumlah total tamu
        $guests = GuestBook::all(); // Mengambil semua data tamu, termasuk foto

        return view('admin.admin', compact('totalGuests', 'guests')); // Kirim data tamu ke view
    }

    // Tambahkan fungsi lain yang Anda butuhkan, seperti edit, destroy, dll.
}
