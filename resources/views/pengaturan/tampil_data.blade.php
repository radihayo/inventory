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