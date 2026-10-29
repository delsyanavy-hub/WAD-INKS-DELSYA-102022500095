@extends('layouts.app')

@section('judul', 'Tambah mesin')

@section('isi')
<h2>Tambah mesin</h2>
@include('mesin._form', [
    'mesin'  => new \App\Models\Mesin(),
    'action' => route('mesin.store'),
    'method' => 'POST',
    'tombol' => 'Simpan mesin',
])
@endsection