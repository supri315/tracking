<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
   
   @page {
        size: A4;
        margin: 1cm;
    }

    body {
        margin: 0;
        padding: 0;
    }
   
    img.center {
        display: block;
        margin: 0 auto;
    }

</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
        <div class="row">
        <img src="{{url('/assets/img/Kop Surat (kecil).jpg')}}" class="center mt-3 mb-4" />
                <table class="table table-borderless">
              
                        <tr>
                            <td><b>Nama Kurir</b> : {{$data[0]["name"]}}</td>
                        </tr>

                      </table>
        </div>

        <div class="row">

                <table class="table table-bordered" >
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Resi</th>
                            <th scope="col">Nama Penerima</th>
                            <th scope="col">Alamat Penerima</th>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Telp Penerima</th>
                            <th scope="col">Jumlah Koli</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $daftarkiriman => $value )
                        <tr>
                            <td>{{ ++$daftarkiriman }}</td>
                            <td>{{ $value["awb"] }}</td>
                            <td>{{ $value["receiver"] }}</td>
                            <td>{{ $value["receiver_address"] }}</td>
                            <td>{{ $value["kelurahan"] }}</td>
                            <td>{{ $value["kecamatan"] }}</td>
                            <td>{{ $value["phone_receiver"] }}</td>
                            <td>{{ $value["coli_total"] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
        </div>
  
    </div>


</body>

</html>