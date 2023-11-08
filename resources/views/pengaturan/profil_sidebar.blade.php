@if(Auth::user()->data_akun->foto != null)
<img src="{{ asset('storage/foto/'.Auth::user()->data_akun->foto) }}" class="img-circle elevation-2" alt="User Image">
@else
<img src="{{ asset('storage/foto/default.png') }}" class="img-circle elevation-2" alt="User Image">
@endif