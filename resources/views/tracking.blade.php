@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">TRACKING PENGIRIMAN</h5>
            </div>
            
            <form action="{{ route('tracking.data') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nomor Resi Pengiriman</label>
                    <input type="text" id="awb" name="awb" class="form-control" id="basic-default-company" placeholder="no resi pengiriman" />
                </div>
            
                <button type="submit" class="btn btn-primary">Cari</button>

            </form>

                @if(session('error'))
                <div class="alert alert-danger mt-2">
                        {{ session('error') }}
                 </div>
                @endif



            @if(!empty($data))
                <table id="tracking" class="table mt-4">
                <thead>
                    <tr>
                        <th>No</th>                      
                        <th>Tanggal </th>
                        <th>No Resi </th>
                        <th>Status</th>
                    </tr>
                </thead>
			<tbody>
                @foreach ($data as $key => $value) 
            <tr>
                <td scope="row">{{++$key}}</td>
                <td>{{$value->created_at}}</td>
                <td>{{$value->awb}}</td>
                <td>{{$value->name}}</td>
            </tr>
            @endforeach
			</tbody>
			</table>
            @endif
            </div>
            </div>
        </div>


    </div>



    @if(!empty($data))

    <div id="map"></div>

    @endif

</div>


@endsection



@push('script')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script>
        // Pastikan perpustakaan telah dimuat sebelum menginisialisasi
        window.onload = function () {
        var map = L.map('map').setView([-7.2575, 112.7521], 6); // Koordinat Surabaya

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic3VwcmkzMTUiLCJhIjoiY2szdHQzYmVzMDJ3MjNtbndsNmFoNTl1byJ9.YdVfTKGs_77g-kN1qqGicg', {
            attribution: '&copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11', // Pilihan tipe peta (Anda dapat mengganti ini)
            accessToken: 'pk.eyJ1Ijoic3VwcmkzMTUiLCJhIjoiY2szdHQzYmVzMDJ3MjNtbndsNmFoNTl1byJ9.YdVfTKGs_77g-kN1qqGicg' // Gantilah dengan kunci API Mapbox Anda
        }).addTo(map);

        var start = L.latLng(-7.2575, 112.7521); // Koordinat Surabaya
        var end = L.latLng(-7.2575, 112.7521); // Koordinat Surabaya
        // var end = L.latLng(-5.1477, 119.4327); // Koordinat Makassar

        // // Buat ikon untuk marker start dan end
        // var startIcon = L.icon({
        //     iconUrl: 'start-icon.png', // Ganti dengan URL gambar ikon untuk start
        //     iconSize: [32, 32], // Sesuaikan dengan ukuran ikon
        // });

        // var endIcon = L.icon({
        //     iconUrl: 'end-icon.png', // Ganti dengan URL gambar ikon untuk end
        //     iconSize: [32, 32], // Sesuaikan dengan ukuran ikon
        // });

        // Tambahkan marker start dan end ke peta dengan ikon yang sesuai
        // L.marker(start, { icon: startIcon }).addTo(map);
        // L.marker(end, { icon: endIcon }).addTo(map);

        L.Routing.control({
            waypoints: [start, end],
            routeWhileDragging: true,
            show: false, // Menghilangkan detail arah perjalanan
        }).addTo(map);
        };
  </script>
@endpush
