<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestBook;

class GuestBookController extends Controller
{
    public function index()
    {
        // Menampilkan semua tamu yang sudah terdaftar
        $guests = GuestBook::all();
        return view('guestbook.index', compact('guests'));
    }

    public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'name' => 'required',
        'nope' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'asal_instansi' => 'required',
        'keperluan' => 'required',
        'bertemu' => 'required',
        'photo' => 'required',
    ]);

    // Proses gambar
    $image = $request->photo; // Data base64 dari input tersembunyi
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = 'guest_' . time() . '.jpg'; // Nama file yang unik
    \File::put(public_path('/uploads/guest_photos/') . $imageName, base64_decode($image));

    // Simpan informasi tamu beserta path foto ke dalam database
    GuestBook::create([
        'name' => $request->name,
        'nope' => $request->nope,
        'jenis_kelamin' => $request->jenis_kelamin, // Tambahkan jenis kelamin
        'alamat' => $request->alamat, // Tambahkan alamat
        'asal_instansi' => $request->asal_instansi,
        'keperluan' => $request->keperluan,
        'bertemu' => $request->bertemu,
        'photo' => '/uploads/guest_photos/' . $imageName, // Simpan path file foto di database
    ]);

    return redirect()->back()->with('success', 'Data tamu berhasil disimpan.');
}

}
