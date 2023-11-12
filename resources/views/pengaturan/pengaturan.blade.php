@extends('layout.main_layout')
@section('main-content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <!-- Profile Image -->
                    <div class="card card-primary mt-4">
                        <div class="card-body box-profile">
                            <div>
                                <input type="file" class="form-control" name="images" id="images" style="display:none;" accept="image/*">
                                <button type="button" class="btn btn-default" id="import_photo"><i class="fas fa-camera"></i></button>               
                            </div>       
                            <div class="text-center" id="fotoprofil">
                                @if (Auth::user()->data_akun->foto != null)
                                <img href="" class="profile-user-img img-fluid img-circle" 
                                src="{{ asset('storage/foto/' . Auth::user()->data_akun->foto) }}"
                                alt="User profile picture">
                                @else
                                <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/foto/default.png') }}" alt="User profile picture">
                                @endif
                            </div>
                        
                            <ul class="list-group list-group-unbordered mb-3 mt-3" id="data_akun_login">
                                <li class="list-group-item">
                                    <b>Nama</b>                                
                                    <span class="float-right">{{$data_user->nama}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <span class="float-right">{{$data_user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b>
                                    <span class="float-right">
                                        @if ($data_user->jenis_kelamin == '0')
                                            Laki - Laki
                                        @else
                                            Perempuan
                                        @endif
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tempat Lahir</b>
                                    <span class="float-right">{{ $data_user->tempat_lahir}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Lahir</b>
                                    <span class="float-right">{{Carbon\Carbon::parse($data_user->tanggal_lahir)->format('d-m-Y') }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Agama</b>
                                    <span class="float-right">
                                        @if ($data_user->agama=='0')
                                            Islam
                                        @elseif($data_user->agama=='1')
                                            Kristen
                                        @elseif($data_user->agama=='2')
                                            Hindu
                                        @elseif($data_user->agama=='3')
                                            Buddha
                                        @elseif($data_user->agama=='4')
                                            Konghucu
                                        @endif
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor Telepon</b>
                                    <span class="float-right">{{ $data_user->no_telp}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b>
                                    <span class="float-right">{{ $data_user->alamat}}</span>
                                </li>
                            </ul>
                            <button type="button" class="float-left btn btn-primary" id="btn_edit_password"><i class="fas fa-lock"></i></button>              
                            <button type="button" class="float-right btn btn-primary" id="btn_edit_data" data-id="{{$data_user->id}}"><i class="fas fa-user"></i></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            @include('pengaturan.modal.edit_foto')
            @include('pengaturan.modal.edit_data')
            @include('pengaturan.modal.edit_password')            
    </section>
    <!-- /.content -->
</div>
@endsection