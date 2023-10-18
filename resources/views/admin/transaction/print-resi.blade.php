<!DOCTYPE html>

<html>

<head>
<style>
table, th, td {
  border: 0px solid black;
  border-collapse: collapse;
}
</style>
</head>

<body>

<div>
    <table style="width:50%">
    <tr>
        <td rowspan ="2">        
        <img src="{{url('/assets/img/kitrans.jpeg')}}" width="100" height="50"/>
        </td>
        <td>7/6/21 13:45</td>
    </tr>
    <tr>
      
        <td>Asal : Surabaya</td>
        <td>Ongkir : Rp. 300.000</td>
    </tr>
    <tr>
    <td rowspan="4">        
            {!! QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}

        </td>
        <td>Tujuan : Makassar</td>
        <td>Diskon : Rp. 300.000</td>

    </tr>
    <tr>
        <td>Pengirim : Eko</td>
        <td>Asuransi : 0</td>
    </tr>
    <tr>
        <td>Penerima : Untung</td>
        <td>Total : Rp. 300.000</td>

    </tr>
    <tr>
         <td>No hp : 082655362833</td>
    </tr>
    <tr>
        <td>subksjsjksjsjsj</td>
        <td>Berat : 40kg &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Koli: 2</td>
    </tr>
    <tr>
        <td><b>REG</b></td>
        <td>Alamat : Jalan Bulukumba rt 20 rw 7</td>
    </tr>
    </table>    
    <hr />

    <table style="width:50%">
    <tr>
        <td rowspan ="2">        
        <img src="{{url('/assets/img/kitrans.jpeg')}}" width="100" height="50"/>
        </td>
        <td>7/6/21 13:45</td>
    </tr>
    <tr>
      
        <td>Asal : Surabaya</td>
        <td>Ongkir : Rp. 300.000</td>
    </tr>
    <tr>
    <td rowspan="4">        
            {!! QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}

        </td>
        <td>Tujuan : Makassar</td>
        <td>Diskon : Rp. 300.000</td>

    </tr>
    <tr>
        <td>Pengirim : Eko</td>
        <td>Asuransi : 0</td>
    </tr>
    <tr>
        <td>Penerima : Untung</td>
        <td>Total : Rp. 300.000</td>

    </tr>
    <tr>
         <td>No hp : 082655362833</td>
    </tr>
    <tr>
        <td>subksjsjksjsjsj</td>
        <td>Berat : 40kg &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Koli: 2</td>
    </tr>
    <tr>
        <td><b>REG</b></td>
        <td>Alamat : Jalan Bulukumba rt 20 rw 7</td>
    </tr>
    </table> 

</div>

    

</body>

</html>