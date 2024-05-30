<!DOCTYPE html>
<html>
<head>
    <title>Toyota Vehicles</title>
    <link rel="stylesheet" type="text/css" href="toyota/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Mobil Toyota GR</h1>
    </header>
    <main>
        @foreach($kendaraans as $kendaraan)
        <section class="vehicle">
            <h2> {{ $kendaraan->model }} </h2>
            <img src="{{ $kendaraan->image->getUrl() }}" alt="Toyota Corolla">
            <p>{!! $kendaraan->deskripsi !!}</p>
            <h4>Mesin Dan Performa</h4>
            <p>{!! $kendaraan->mesin !!}</p>
            <h4>Fitur-fitur</h4>
            <p>{!! $kendaraan->fitur !!}</p>
            <h4>Harga</h4>
            <p> {{  $kendaraan->price }}</p>
        </section>
        @endforeach
        <!-- Add more vehicles as needed -->
    </main>
</body>
</html>