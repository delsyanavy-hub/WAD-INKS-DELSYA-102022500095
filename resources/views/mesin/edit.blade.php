@extends('layouts.app')

@section('judul', 'Ubah mesin')

@section('isi')
<h2>Ubah mesin</h2>
@include('mesin._form', [
    'action' => route('mesin.update', $mesin),
    'method' => 'PUT',
    'tombol' => 'Simpan perubahan',
])
@endsection