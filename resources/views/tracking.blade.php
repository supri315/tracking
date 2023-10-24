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
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nomor Resi Pengiriman</label>
                    <input type="text" id="awb" name="awb" class="form-control" id="basic-default-company" placeholder="no resi pengiriman" />
                </div>
       
                
                <table id="tracking" class="table">
                <thead>
                    <tr>
                        <th>No</th>                      
                        <th>Tanggal </th>
                        <th>No Resi </th>
                        <th>Status</th>
                    </tr>
                </thead>
			<tbody>
			</tbody>
			</table>
            </div>
            </div>
        </div>


    </div>
    <div id="map"></div>

</div>


@endsection


@push('script')
<script>
       var startDateInput = document.getElementById('awb');
        var startDateValue = "";
        var dataTable = null;

        startDateInput.addEventListener('input', function () {
        startDateValue = startDateInput.value;

        // Hancurkan dataTable jika sudah ada
        if (dataTable !== null) {
            dataTable.destroy();
        }

        // Inisialisasi ulang dataTable dengan URL yang baru
        dataTable = $("#tracking").DataTable({
            searching: false,
            paging: false,
            info: false,
            processing: false,
            lengthChange: false,
            initComplete: function (settings, json) {
                $(".js-datatables").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>"
                );
            },
            ajax: {
                url: "/dashboard/tracking/data/" + startDateValue,
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "created_at", name: "created_at" },
                { data: "awb", name: "awb" },
                { data: "name", name: "name" },
            ],
        });
    });

    </script>

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
        var end = L.latLng(-5.1477, 119.4327); // Koordinat Makassar

        // Buat ikon untuk marker start dan end
        var startIcon = L.icon({
            iconUrl: 'start-icon.png', // Ganti dengan URL gambar ikon untuk start
            iconSize: [32, 32], // Sesuaikan dengan ukuran ikon
        });

        var endIcon = L.icon({
            iconUrl: 'end-icon.png', // Ganti dengan URL gambar ikon untuk end
            iconSize: [32, 32], // Sesuaikan dengan ukuran ikon
        });

        // Tambahkan marker start dan end ke peta dengan ikon yang sesuai
        L.marker(start, { icon: startIcon }).addTo(map);
        L.marker(end, { icon: endIcon }).addTo(map);

        L.Routing.control({
            waypoints: [start, end],
            routeWhileDragging: true,
            show: false, // Menghilangkan detail arah perjalanan
        }).addTo(map);
        };
  </script>
@endpush
