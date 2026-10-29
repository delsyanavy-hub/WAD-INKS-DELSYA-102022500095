@if ($errors->any())
  <div class="alert error">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ $action }}" class="kartu-form">
  @csrf
  @if ($method !== 'POST')
    @method($method)
  @endif

  <label>Kode
    <input type="text" name="kode" value="{{ old('kode', $mesin->kode) }}">
  </label>

  <label>Jenis
    <select name="jenis">
      @foreach (\App\Models\Mesin::JENIS as $j)
        <option value="{{ $j }}" @selected(old('jenis', $mesin->jenis) === $j)>{{ $j }}</option>
      @endforeach
    </select>
  </label>

  <label>Merek
    <input type="text" name="merek" value="{{ old('merek', $mesin->merek) }}">
  </label>

  <label>Kapasitas (kg)
    <input type="number" name="kapasitas_kg" min="1" value="{{ old('kapasitas_kg', $mesin->kapasitas_kg) }}">
  </label>

  <label>Status
    <select name="status">
      @foreach (\App\Models\Mesin::STATUS as $s)
        <option value="{{ $s }}" @selected(old('status', $mesin->status) === $s)>{{ $s }}</option>
      @endforeach
    </select>
  </label>

  <div class="aksi-form">
    <a class="btn" href="{{ route('mesin.index') }}">Batal</a>
    <button type="submit" class="btn primary">{{ $tombol }}</button>
  </div>
</form>