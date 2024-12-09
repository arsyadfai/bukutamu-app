<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
{
    // Dapatkan tanggal saat ini
    $now = Carbon::now();
    
    // Inisialisasi variabel untuk pencarian dan statistik tamu
    $search = $request->input('search');
    $totalCount = GuestBook::count();
    $maleCount = GuestBook::where('jenis_kelamin', 'Laki-laki')->count();
    $femaleCount = GuestBook::where('jenis_kelamin', 'Perempuan')->count();

    // Tentukan tanggal mulai bulan ini dan akhir bulan ini
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();
    // Hitung jumlah minggu dalam bulan ini
$weeksInMonth = $startOfMonth->diffInWeeks($endOfMonth) + 1; // +1 untuk menghitung minggu pertama

echo "Jumlah minggu dalam bulan ini: " . $weeksInMonth;

    // Tentukan minggu pertama bulan ini (dimulai dari hari Minggu)
    $currentWeekStart = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);

    // Inisialisasi array untuk menampung data statistik mingguan
    $weeklyStats = [];
    $weekNumber = 1;

    // Loop untuk menghitung statistik per minggu
    while ($currentWeekStart->lte($endOfMonth)) {
        // Tentukan akhir minggu yang berlaku
        $currentWeekEnd = $currentWeekStart->copy()->endOfWeek(Carbon::SUNDAY);

        // Sesuaikan agar akhir minggu tidak melewati akhir bulan
        if ($currentWeekEnd->gt($endOfMonth)) {
            $currentWeekEnd = $endOfMonth;
        }

        // Hitung jumlah kunjungan pada minggu ini
        $weeklyCount = GuestBook::whereBetween('created_at', [$currentWeekStart->startOfDay(), $currentWeekEnd->endOfDay()])->count();

        // Simpan statistik mingguan
        $weeklyStats[] = $weeklyCount;

        // Pindah ke minggu berikutnya
        $currentWeekStart = $currentWeekEnd->copy()->addDay();
        $weekNumber++;

        // Jika sudah melebihi 4 minggu, hentikan
        if ($weekNumber > 5) {
            break;
        }
    }

    // Memastikan jika minggu pertama dimulai dari tanggal 1 bulan ini
    $shiftedStats = [];
    if (count($weeklyStats) > 1) {
        // Geser data mingguan untuk memastikan minggu pertama sesuai
        for ($i = 1; $i < count($weeklyStats); $i++) {
            $shiftedStats[$i] = $weeklyStats[$i];
        }
    } else {
        // Jika hanya ada 1 minggu, tetap tampilkan
        $shiftedStats[1] = $weeklyStats[0];
    }

    // Menyusun label Minggu untuk chart (gunakan Minggu 1, Minggu 2, dst)
    $weeklyLabels = [];
    foreach (array_keys($shiftedStats) as $weekIndex) {
        $weeklyLabels[] = "Minggu " . $weekIndex;
    }

    // Ambil data statistik minggu yang telah digeser
    $weeklyData = array_values($shiftedStats); // [15, 20, 12, 18, ...]

    // Mengambil data bulanan untuk 6 bulan terakhir
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

    // Filter pencarian tamu berdasarkan input dari form
    $guests = GuestBook::query();
    if ($search) {
        $guests = $guests->where('name', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%")
            ->orWhere('keperluan', 'like', "%{$search}%");
    }

    $today = $now->toDateString();
    $todayGuests = $guests->whereDate('created_at', $today)->get();
    $guests = $guests->get();

    return response()
        ->view('admin.admin', compact('weeklyLabels', 'weeklyData', 'totalCount', 'maleCount', 'femaleCount', 'monthlyStats', 'months', 'guests', 'todayGuests'))
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
    
        // Tentukan tanggal mulai bulan ini dan akhir bulan ini
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();
    // Hitung jumlah minggu dalam bulan ini
$weeksInMonth = $startOfMonth->diffInWeeks($endOfMonth) + 1; // +1 untuk menghitung minggu pertama

echo "Jumlah minggu dalam bulan ini: " . $weeksInMonth;

    // Tentukan minggu pertama bulan ini (dimulai dari hari Minggu)
    $currentWeekStart = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);

    // Inisialisasi array untuk menampung data statistik mingguan
    $weeklyStats = [];
    $weekNumber = 1;

    // Loop untuk menghitung statistik per minggu
    while ($currentWeekStart->lte($endOfMonth)) {
        // Tentukan akhir minggu yang berlaku
        $currentWeekEnd = $currentWeekStart->copy()->endOfWeek(Carbon::SUNDAY);

        // Sesuaikan agar akhir minggu tidak melewati akhir bulan
        if ($currentWeekEnd->gt($endOfMonth)) {
            $currentWeekEnd = $endOfMonth;
        }

        // Hitung jumlah kunjungan pada minggu ini
        $weeklyCount = GuestBook::whereBetween('created_at', [$currentWeekStart->startOfDay(), $currentWeekEnd->endOfDay()])->count();

        // Simpan statistik mingguan
        $weeklyStats[] = $weeklyCount;

        // Pindah ke minggu berikutnya
        $currentWeekStart = $currentWeekEnd->copy()->addDay();
        $weekNumber++;

        // Jika sudah melebihi 4 minggu, hentikan
        if ($weekNumber > 5) {
            break;
        }
    }

    // Memastikan jika minggu pertama dimulai dari tanggal 1 bulan ini
    $shiftedStats = [];
    if (count($weeklyStats) > 1) {
        // Geser data mingguan untuk memastikan minggu pertama sesuai
        for ($i = 1; $i < count($weeklyStats); $i++) {
            $shiftedStats[$i] = $weeklyStats[$i];
        }
    } else {
        // Jika hanya ada 1 minggu, tetap tampilkan
        $shiftedStats[1] = $weeklyStats[0];
    }

    // Menyusun label Minggu untuk chart (gunakan Minggu 1, Minggu 2, dst)
    $weeklyLabels = [];
    foreach (array_keys($shiftedStats) as $weekIndex) {
        $weeklyLabels[] = "Minggu " . $weekIndex;
    }

    // Ambil data statistik minggu yang telah digeser
    $weeklyData = array_values($shiftedStats); // [15, 20, 12, 18, ...]

    // Mengambil data bulanan untuk 6 bulan terakhir
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

        // Menghitung jumlah tamu pria dan wanita, serta total
        $maleCount = GuestBook::where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount = GuestBook::where('jenis_kelamin', 'Perempuan')->count();
        $totalCount = GuestBook::count();
    
        // Kirim semua data relevan ke tampilan
        return response()
            ->view('admin.statistics', compact('weeklyLabels', 'weeklyData', 'totalCount', 'maleCount', 'femaleCount', 'monthlyStats', 'months'))
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
    // Validasi data tamu
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'nope' => 'required|string|max:15',
        'jenis_kelamin' => 'required|string',
        'bertemu' => 'required|string',
        'keperluan' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $guest = GuestBook::find($id);
    $guest->name = $request->input('name');
    $guest->alamat = $request->input('alamat');
    $guest->nope = $request->input('nope');
    $guest->jenis_kelamin = $request->input('jenis_kelamin');
    $guest->bertemu = $request->input('bertemu');
    $guest->keperluan = $request->input('keperluan');

    // Cek apakah ada foto yang diunggah
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($guest->photo && file_exists(public_path($guest->photo))) {
            unlink(public_path($guest->photo));  // Menghapus foto lama
        }

        // Simpan foto baru
        $photoPath = $request->file('photo')->store('photos', 'public'); // Menyimpan foto di folder 'photos'
        $guest->photo = 'storage/' . $photoPath; // Menyimpan path foto
    }

    $guest->save();

    return redirect()->route('admin.index')->with('success', 'Data tamu berhasil diperbarui.');
}
    

    public function settings()
    {
        return view('admin.settings'); // Tampilan untuk halaman pengaturan
    }
    
    public function updateSettings(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),  // Ganti validasi username menjadi email
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',  // Jika password baru diisi
        ]);
    
        $user = Auth::user();
    
        // Cek apakah password saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok']);
        }
    
        // Update email jika berbeda
        if ($request->email !== $user->email) {
            $user->email = $request->email;
        }
    
        // Update password jika password baru diisi
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }
    
        $user->save();
    
        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }    
}
