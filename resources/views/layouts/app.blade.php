<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('judul', 'Mesin & Peralatan')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="topbar">
  <h1>Mesin &amp; Peralatan</h1>
  <p>Pendataan mesin cuci dan pengering</p>
</header>

<main>
  @yield('isi')
</main>

</body>
</html>