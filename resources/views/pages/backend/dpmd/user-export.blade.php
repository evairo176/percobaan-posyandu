<table>
    <tr style="text-align: center;">
        <th colspan="6">Data User</th>

    </tr>
    <tr style="text-align: center;">
        <td colspan="6">Dinas Pemberdayaan Masyarakat dan Desa Pada Kabupaten Indramayu</td>
    </tr>
</table>
<table>
    <tr>
        <th style="width: 100px;">No</th>
        <th style="width: 350px;">Name</th>
        <th style="width: 350px;">Email</th>
        <th style="width: 350px;">Password</th>
        <th style="width: 350px;">Role</th>
        <th style="width: 350px;">Kecamatan</th>
        <th style="width: 350px;">Kelurahan</th>
    </tr>
    @foreach($user as $us)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$us->name_user}}</td>
        <td>{{$us->email}}</td>
        <td>{{$us->password_asli}}</td>
        <td>{{$us->role}}</td>
        <td>{{$us->kecamatan}}</td>
        <td>{{$us->kelurahan}}</td>
    </tr>
    @endforeach
</table>