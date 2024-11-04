<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Query untuk menghitung total tamu
        $totalCount = GuestBook::count();

        // Query untuk menghitung jumlah tamu berdasarkan jenis kelamin
        $maleCount = GuestBook::where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount = GuestBook::where('jenis_kelamin', 'Perempuan')->count();

        // Statistik kunjungan mingguan (4 minggu terakhir dari bulan berjalan)
        $weeklyStats = [];
        for ($i = 0; $i < 4; $i++) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeklyStats[] = GuestBook::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        }
        $weeklyStats = array_reverse($weeklyStats); // Untuk menampilkan dari minggu terakhir ke minggu pertama

        // Statistik kunjungan bulanan (6 bulan terakhir dari bulan berjalan)
        $monthlyStats = [];
        $months = []; // Inisialisasi array untuk nama bulan
        for ($i = 0; $i < 6; $i++) {
            $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();
            $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();
            $monthlyStats[] = GuestBook::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $months[] = $startOfMonth->format('F Y'); // Menyimpan nama bulan dan tahun
        }
        $monthlyStats = array_reverse($monthlyStats); // Untuk menampilkan dari bulan terakhir ke bulan pertama
        $months = array_reverse($months); // Menghitung bulan untuk menyesuaikan dengan data yang terbalik

        // Query untuk data tamu, dengan fitur pencarian
        $guests = GuestBook::query();

        if ($search) {
            $guests = $guests->where('name', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('keperluan', 'like', "%{$search}%");
        }

        // Dapatkan data tamu yang ditambahkan hari ini
        $today = now()->toDateString(); // Mengambil tanggal hari ini
        $todayGuests = $guests->whereDate('created_at', $today)->get(); // Ambil data yang ditambahkan hari ini

        // Dapatkan hasil pencarian atau semua tamu jika tidak ada pencarian
        $guests = $guests->get();

        return view('admin.admin', compact('totalCount', 'maleCount', 'femaleCount', 'weeklyStats', 'monthlyStats', 'months', 'guests', 'todayGuests'));
    }

    public function destroy($id)
    {
        $guest = GuestBook::find($id);
    
        if ($guest) {
            // Hapus foto jika ada
            if (file_exists(public_path($guest->photo))) {
                unlink(public_path($guest->photo));
            }
    
            // Hapus data tamu dari database
            $guest->delete();
    
            return redirect()->route('admin.index')->with('success', 'Data tamu berhasil dihapus.');
        }
    
        return redirect()->route('admin.index')->with('error', 'Data tamu tidak ditemukan.');
    }

    public function edit($id)
    {
        $guest = GuestBook::find($id);

        if ($guest) {
            return view('admin.edit', compact('guest'));
        }

        return redirect()->route('admin.index')->with('error', 'Data tamu tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nope' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string',
            'bertemu' => 'required|string',
            'keperluan' => 'required|string',
        ]);

        $guest = GuestBook::find($id);

        if ($guest) {
            $guest->name = $request->input('name');
            $guest->alamat = $request->input('alamat');
            $guest->nope = $request->input('nope');
            $guest->jenis_kelamin = $request->input('jenis_kelamin');
            $guest->bertemu = $request->input('bertemu');
            $guest->keperluan = $request->input('keperluan');

            // Jika ada file foto baru, upload dan update
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if (file_exists(public_path($guest->photo))) {
                    unlink(public_path($guest->photo));
                }

                // Simpan foto baru
                $photoPath = $request->file('photo')->store('uploads/guest_photos', 'public');
                $guest->photo = $photoPath;
            }

            $guest->save();

            return redirect()->route('admin.index')->with('success', 'Data tamu berhasil diupdate.');
        }

        return redirect()->route('admin.index')->with('error', 'Data tamu tidak ditemukan.');
    }
}
