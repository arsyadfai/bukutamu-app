<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Check if today is still in the first week of the month
        $now = Carbon::now();
        $firstWeekEnd = $now->copy()->startOfMonth()->endOfWeek();

        if ($now->lessThanOrEqualTo($firstWeekEnd)) {
            // Clear guest data for the first week of the month
            GuestBook::truncate();
        }

        $search = $request->input('search');
        $totalCount = GuestBook::count();
        $maleCount = GuestBook::where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount = GuestBook::where('jenis_kelamin', 'Perempuan')->count();

        $weeklyStats = [];
        for ($i = 0; $i < 4; $i++) {
            $startOfWeek = $now->copy()->subWeeks($i)->startOfWeek();
            $endOfWeek = $now->copy()->subWeeks($i)->endOfWeek();
            $weeklyStats[] = GuestBook::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        }
        $weeklyStats = array_reverse($weeklyStats);

        $monthlyStats = [];
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $startOfMonth = $now->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $now->copy()->subMonths($i)->endOfMonth();
            $monthlyStats[] = GuestBook::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $months[] = $startOfMonth->format('F Y');
        }
        $monthlyStats = array_reverse($monthlyStats);
        $months = array_reverse($months);

        $guests = GuestBook::query();
        if ($search) {
            $guests = $guests->where('name', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('keperluan', 'like', "%{$search}%");
        }
        $today = $now->toDateString();
        $todayGuests = $guests->whereDate('created_at', $today)->get();
        $guests = $guests->get();

        // Menambahkan header cache agar halaman admin tidak tersimpan di cache
        return response()
            ->view('admin.admin', compact('totalCount', 'maleCount', 'femaleCount', 'weeklyStats', 'monthlyStats', 'months', 'guests', 'todayGuests'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function showMaleGuests(Request $request)
    {
        // Mengambil tamu laki-laki dari database
        $maleGuests = GuestBook::where('jenis_kelamin', 'Laki-laki')->get();

        // Menambahkan header cache untuk mencegah halaman ini di-cache
        return response()
            ->view('admin.male', compact('maleGuests'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function showFemaleGuests() 
    {
        $femaleGuests = GuestBook::where('jenis_kelamin', 'Perempuan')->get();

        // Menambahkan header cache untuk mencegah halaman ini di-cache
        return response()
            ->view('admin.female', compact('femaleGuests'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function showMonthlyStatistics()
    {
        $now = Carbon::now();
    
        // Menghitung statistik bulanan
        $monthlyStats = [];
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $startOfMonth = $now->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $now->copy()->subMonths($i)->endOfMonth();
            $monthlyStats[] = GuestBook::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $months[] = $startOfMonth->format('F Y');
        }
        $monthlyStats = array_reverse($monthlyStats);
        $months = array_reverse($months);
    
        // Menghitung statistik mingguan
        $weeklyStats = [];
        for ($i = 0; $i < 4; $i++) {
            $startOfWeek = $now->copy()->subWeeks($i)->startOfWeek();
            $endOfWeek = $now->copy()->subWeeks($i)->endOfWeek();
            $weeklyStats[] = GuestBook::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        }
        $weeklyStats = array_reverse($weeklyStats);
    
        // Menghitung jumlah tamu pria dan wanita, serta total
        $maleCount = GuestBook::where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount = GuestBook::where('jenis_kelamin', 'Perempuan')->count();
        $totalCount = GuestBook::count();
    
        // Kirim semua data relevan ke tampilan
        return response()
            ->view('admin.statistics', compact('monthlyStats', 'months', 'maleCount', 'femaleCount', 'totalCount', 'weeklyStats'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
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
                if (file_exists(public_path($guest->photo))) {
                    unlink(public_path($guest->photo));
                }

                $photoPath = $request->file('photo')->store('uploads/guest_photos', 'public');
                $guest->photo = $photoPath;
            }

            $guest->save();

            return redirect()->route('admin.index')->with('success', 'Data tamu berhasil diupdate.');
        }

        return redirect()->route('admin.index')->with('error', 'Data tamu tidak ditemukan.');
    }
}
