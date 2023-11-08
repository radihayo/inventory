<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory | {{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.header')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include("layout.navbar")
        @include("layout.sidebar")
        @include("layout.plugin")
        @yield("main-content")
        @include("script.script_all")
        
        @include("data_user.jquery.script_user")
        @include("stock_barang.jquery.script_barang")
        @include("form.jenis.jquery.script_jenis")
        @include("form.merek.jquery.script_merek")
        @include("form.satuan.jquery.script_satuan")
        @include("form.lokasi.jquery.script_lokasi")
        @include("transaksi_barang.barang_masuk.jquery.script_masuk")
        @include("transaksi_barang.barang_keluar.jquery.script_keluar")
        @include("pengaturan.jquery.script_pengaturan")
        @include("layout.footer")
    </div>
</body>
</html>