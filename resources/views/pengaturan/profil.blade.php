@if (Auth::user()->data_akun->foto != null)
    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/foto/' . Auth::user()->data_akun->foto) }}"
        alt="User profile picture">
@else
    <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/foto/default.png') }}"
        alt="User profile picture">
@endif