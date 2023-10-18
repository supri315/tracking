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
                            <td>Nama Kapal : {{$data[0]["ship_name"]}}</td>
                            <td>Nomor Dokumen : {{$data[0]["no_docs"]}}</td>
                        </tr>

                        <tr>
                            <td>Tanggal Keberangkatan : {{$data[0]["start_date"]}}</td>
                            <td>Nopol Kendaraan : {{$data[0]["nopol"]}}</td>
                        </tr>

                        <tr>
                            <td>Tanggal Kedatangan : {{$data[0]["end_date"]}}</td>
                            <td>Nama Sopir : {{$data[0]["driver"]}}</td>
                        </tr>
                        
                        <tr>
                            <td>Pelabuhan Muat: {{$data[0]["asal"]}}</td>
                        </tr>
                        <tr>
                            <td>Pelabuhan Bongkar :  {{$data[0]["tujuan"]}}</td>
                        </tr>
                      </table>
        </div>
        <b><p style="text-align: center";> Cargo Manifest</p></b>

        <div class="row">

                <table class="table table-bordered" >
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Resi Kirim</th>
                            <th scope="col">Kec.Penerima</th>
                            <th scope="col">Kel.Penerima</th>
                            <th scope="col">Alamat Penerima</th>
                            <th scope="col">Nama Penerima</th>
                            <th scope="col">Telp Penerima</th>
                            <th scope="col">Nama Pengirim</th>
                            <th scope="col">Telp Pengirim</th>
                            <th scope="col">Jumlah Koli</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $cargo => $value )
                        <tr>
                            <td>{{ ++$cargo }}</td>
                            <td>{{ $value["awb"] }}</td>
                            <td>{{ $value["kecamatan"] }}</td>
                            <td>{{ $value["kelurahan"] }}</td>
                            <td>{{ $value["receiver_address"] }}</td>
                            <td>{{ $value["receiver"] }}</td>
                            <td>{{ $value["phone_receiver"] }}</td>
                            <td>{{ $value["shipper"] }}</td>
                            <td>{{ $value["shipper_phone"] }}</td>
                            <td>{{ $value["coli_total"] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
        </div>
  
    </div>


</body>

</html>