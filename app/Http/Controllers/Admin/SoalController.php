<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoalUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Menampilkan daftar soal
     */
    public function index(Request $request)
    {
        $query = SoalUjian::query();

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('soal', 'like', "%{$search}%");
        }

        $soals = $query->orderBy('created_at', 'desc')->paginate(10);
        $totalSoal = SoalUjian::count();

        return view('admin.soal.index', compact('soals', 'totalSoal'));
    }

    /**
     * Menampilkan form tambah soal
     */
    public function create()
    {
        return view('admin.soal.create');
    }

    /**
     * Menyimpan soal baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'soal' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'opsi_e' => 'required|string',
            'kunci_jawaban' => 'required|in:a,b,c,d,e',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SoalUjian::create($request->all());

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit soal
     */
    public function edit($id)
    {
        $soal = SoalUjian::findOrFail($id);
        return view('admin.soal.edit', compact('soal'));
    }

    /**
     * Mengupdate soal
     */
    public function update(Request $request, $id)
    {
        $soal = SoalUjian::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'soal' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'opsi_e' => 'required|string',
            'kunci_jawaban' => 'required|in:a,b,c,d,e',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $soal->update($request->all());

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Menghapus soal
     */
    public function destroy($id)
    {
        $soal = SoalUjian::findOrFail($id);
        $soal->delete();

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil dihapus');
    }
}