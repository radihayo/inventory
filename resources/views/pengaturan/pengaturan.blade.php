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
                            <button type="button" class="btn btn-default" id="btn_edit_foto"><i class="fas fa-camera"></i></button>                            
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
                            {{-- mmm --}}
                            {{-- <div class="row">
                                <div class="col-md-4 text-center">
                                    <div id="upload-demo" style="width:250px"></div>
                                </div>
                                <div class="col-md-4" style="padding-top:30px;">
                                    <strong>Select Image:</strong>
                                    <input type="file" id="image" accept="image/*">
                                    <br />
                                    <button class="btn btn-success" id="upload-image">Upload Image</button>
                                </div>
            
            
                                <div class="col-md-4">
                                    <div id="image-preview"
                                        style="background:#e1e1e1;padding:30px;height:300px;"></div>
                                </div>
                            </div> --}}
                            {{-- <ul class="list-group list-group-unbordered mb-3 mt-3">
                                <li class="list-group-item">
                                    <b>Nama</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->nama}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b>
                                    <span class="float-right">
                                        @if (Auth::user()->data_akun->jenis_kelamin == '0')
                                            Laki - Laki
                                        @else
                                            Perempuan
                                        @endif
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tempat Lahir</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->tempat_lahir}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Lahir</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->tanggal_lahir}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Agama</b>
                                    <span class="float-right">
                                        @if (Auth::user()->data_akun->agama=='0')
                                            Islam
                                        @elseif(Auth::user()->data_akun->agama=='1')
                                            Kristen
                                        @elseif(Auth::user()->data_akun->agama=='2')
                                            Hindu
                                        @elseif(Auth::user()->data_akun->agama=='3')
                                            Buddha
                                        @elseif(Auth::user()->data_akun->agama=='4')
                                            Konghucu
                                        @endif
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor Telepon</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->no_telp}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b>
                                    <span class="float-right">{{ Auth::user()->data_akun->alamat}}</span>
                                </li>
                            </ul> --}}
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
                                    <span class="float-right">{{ $data_user->tanggal_lahir}}</span>
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
{{-- @include("pengaturan.jquery.script_pengaturan")     --}}
@endsection