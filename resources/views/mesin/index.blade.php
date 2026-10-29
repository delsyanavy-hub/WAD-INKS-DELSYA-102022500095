@extends('layouts.app')

@section('judul', 'Daftar mesin')

@section('isi')
<h2>Daftar mesin</h2>

@if (session('pesan'))
  <div class="alert ok">{{ session('pesan') }}</div>
@endif

<section class="summary">
  <div><strong>{{ $ringkasan->sum() }}</strong><span>Total mesin</span></div>
  <div><strong>{{ $ringkasan['Beroperasi'] ?? 0 }}</strong><span>Beroperasi</span></div>
  <div><strong>{{ $ringkasan['Maintenance'] ?? 0 }}</strong><span>Maintenance</span></div>
  <div><strong>{{ $ringkasan['Rusak'] ?? 0 }}</strong><span>Rusak</span></div>
</section>

<form class="toolbar" method="get" action="{{ route('mesin.index') }}">
  <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari merek atau kode mesin">
  <select name="jenis">
    <option value="">Semua jenis</option>
    @foreach (\App\Models\Mesin::JENIS as $j)
      <option value="{{ $j }}" @selected(request('jenis') === $j)>{{ $j }}</option>
    @endforeach
  </select>
  <select name="status">
    <option value="">Semua status</option>
    @foreach (\App\Models\Mesin::STATUS as $s)
      <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
    @endforeach
  </select>
  <button type="submit" class="btn">Terapkan filter</button>
  <a class="btn primary" href="{{ route('mesin.create') }}">Tambah mesin</a>
</form>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>Kode</th>
        <th>Jenis</th>
        <th>Merek</th>
        <th>Kapasitas</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($daftar as $m)
        <tr>
          <td>{{ $m->kode }}</td>
          <td>{{ $m->jenis }}</td>
          <td>{{ $m->merek }}</td>
          <td>{{ $m->kapasitas_kg }} kg</td>
          <td><span class="badge {{ strtolower($m->status) }}">{{ $m->status }}</span></td>
          <td class="aksi">
            <a class="btn kecil" href="{{ route('mesin.edit', $m) }}">Ubah</a>
            <form method="POST" action="{{ route('mesin.destroy', $m) }}"
                  onsubmit="return confirm('Hapus mesin {{ $m->kode }}?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn kecil hapus">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if ($daftar->isEmpty())
    <p class="kosong">Belum ada mesin yang cocok. Tambahkan mesin baru atau ubah filter.</p>
  @endif
</div>
@endsection