@extends('layout.main_layout')
@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
  <div class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sign-in-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang Masuk Hari Ini</span>
                <span class="info-box-number">{{$barang_masuk}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sign-out-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang Keluar Hari Ini</span>
                <span class="info-box-number">{{$barang_keluar}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Barang</span>
                <span class="info-box-number">{{$barang}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah User</span>
                <span class="info-box-number">{{$user}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Transaksi</h3>
                {{-- <a href="javascript:void(0);">View Report</a> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">Total Barang Masuk Dan Keluar</span>
                  <span>{{$total_data_masuk}}</span>
                  <span>{{$total_data_keluar}}</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                <div>
                  <div>
                    @if ($transaksi_masuk>0)
                    <span style="color: #28a745;margin-right:5px">
                      <i class="fas fa-arrow-up"></i> {{$transaksi_masuk}}%
                    </span>
                    @else
                    <span style="color: #28a745;margin-right:5px">
                      <i class="fas fa-arrow-down"></i> {{abs($transaksi_masuk)}}%
                    </span>
                    @endif

                    @if ($transaksi_keluar>0)
                    <span style="color: #dc3545;">
                      <i class="fas fa-arrow-up"></i> {{$transaksi_keluar}}%
                    </span>
                    @else
                    <span style="color: #dc3545;">
                      <i class="fas fa-arrow-down"></i> {{abs($transaksi_keluar)}}%
                    </span>  
                    @endif
                  </div>
                  <div>
                    <span class="text-muted">Sejak Bulan Kemarin</span>
                  </div>
                </div>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square" style="color: #28a745;"></i> Barang Masuk
                </span>

                <span>
                  <i class="fas fa-square" style="color: #dc3545;"></i> Barang Keluar
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Barang Baru Ditambahkan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($barang_baru as $data)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->stock}}</td>
                    </tr>  
                    @endforeach
                  </tbody>
                </table>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="/barang" class="uppercase">Lihat Semua Barang</a>
            </div>
            <!-- /.card-footer -->
          </div>
        </div>    
        <!-- /.col-md-6 -->
        </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
</div>
@include("dashboard.jquery.script_dashboard")      
@endsection