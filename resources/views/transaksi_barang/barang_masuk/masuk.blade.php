@extends('layout.main_layout')
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang Masuk</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">     
                            <div class="row">
                                <div class="col-6 mx-auto my-auto d-flex justify-content-start">
                                    <button type="button" class="btn btn-success" id="btn_print">
                                        <i class="fas fa-print"></i> Print Data
                                    </button>
                                </div>
                                <div class="col-6 mx-auto my-auto d-flex justify-content-end">
                                    <button type="button" class="btn btn-tool" id="btn_add_masuk">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div> 
                        <div class="card-body">
                            <table id="table_masuk" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>        
                            </table>
                            @include('transaksi_barang.barang_masuk.modal.add_masuk')
                            @include('transaksi_barang.barang_masuk.modal.edit_masuk')                        
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>    
@endsection