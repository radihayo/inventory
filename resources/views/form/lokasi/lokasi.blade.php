@extends('layout.main_layout')
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Lokasi Barang</h1>
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
                            <button type="button" class="btn btn-default float-right mx-auto my-auto" id="btn_add_lokasi">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div> 
                        <div class="card-body">
                            <table id="table_lokasi" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>        
                            </table>
                            @include('form.lokasi.modal.add_lokasi')
                            @include('form.lokasi.modal.edit_lokasi')                        
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