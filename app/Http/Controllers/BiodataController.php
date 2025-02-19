<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $biodatas = Biodata::all();
        return view('biodata.index', compact('biodatas'));
        // Biodata::all(); → Mengambil semua data dari tabel biodata.
        // compact('biodatas') → Mengirim data ke view agar bisa ditampilkan dalam tampilan biodata.index.s
    }

    public function create()
    {
        return view('biodata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        Biodata::create($request->all());
        return redirect()->route('biodata.index');
        // $request->all() yaitu mengambil semua data input dari formulir yang dikirim oleh pengguna
        // Biodata::create(...) menyimpan data tersebut ke dalam tabel biodata di database
    }
}
