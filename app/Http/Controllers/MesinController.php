<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        $query = Mesin::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('merek', 'like', "%$cari%")
                  ->orWhere('kode', 'like', "%$cari%");
            });
        }
        if (in_array($request->jenis, Mesin::JENIS, true)) {
            $query->where('jenis', $request->jenis);
        }
        if (in_array($request->status, Mesin::STATUS, true)) {
            $query->where('status', $request->status);
        }

        $daftar    = $query->orderBy('kode')->get();
        $ringkasan = Mesin::selectRaw('status, COUNT(*) as total')
                          ->groupBy('status')
                          ->pluck('total', 'status');

        return view('mesin.index', compact('daftar', 'ringkasan'));
    }

    public function create()
    {
        return view('mesin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan());
        Mesin::create($data);

        return redirect()->route('mesin.index')
            ->with('pesan', "Mesin {$data['kode']} berhasil ditambahkan.");
    }

    public function edit(Mesin $mesin)
    {
        return view('mesin.edit', compact('mesin'));
    }

    public function update(Request $request, Mesin $mesin)
    {
        $data = $request->validate($this->aturan($mesin->id));
        $mesin->update($data);

        return redirect()->route('mesin.index')
            ->with('pesan', "Mesin {$data['kode']} berhasil diperbarui.");
    }

    public function destroy(Mesin $mesin)
    {
        $kode = $mesin->kode;
        $mesin->delete();

        return redirect()->route('mesin.index')
            ->with('pesan', "Mesin $kode berhasil dihapus.");
    }

    private function aturan(?int $id = null): array
    {
        return [
            'kode'         => ['required', 'string', 'max:20', Rule::unique('mesins', 'kode')->ignore($id)],
            'jenis'        => ['required', Rule::in(Mesin::JENIS)],
            'merek'        => ['required', 'string', 'max:50'],
            'kapasitas_kg' => ['required', 'integer', 'min:1'],
            'status'       => ['required', Rule::in(Mesin::STATUS)],
        ];
    }
}