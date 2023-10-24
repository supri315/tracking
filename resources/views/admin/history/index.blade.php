@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> History Barang</h4>
        <div class="card">

			<table id="historyTables" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>No Resi</th>
					<th>Barang Masuk</th>
					<th>Barang Masuk Pelabuhan</th>
					<th>Barang Tiba Pelabuhan</th>
					<th>Barang Proses Sortir di Tujuan</th>
					<th>Barang Proses Kirim</th>
					<th>Nama Kurir Kirim</th>
					<th>Jumlah Koli</th>
					<th>Total Berat</th>
					<th>Total Volume</th>
					<th>Kode Kiriman</th>
					<!-- <th>Status</th> -->
                    <!-- <th>Aksi</th> -->

				</tr>
        	</thead>
			<tbody>
			</tbody>
			</table>
	</div>
</div>

@endsection

@push('script')
<script>

$(function () {
	fetch_data();

    function fetch_data() {
        $("#historyTables").DataTable({
            language: {
                searchPlaceholder: "Search...",
                sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
                sProcessing: "Sedang memproses...",
                sLengthMenu: "Tampilkan _MENU_ entri",
                sZeroRecords: "Tidak ditemukan data yang sesuai",
                sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                sInfoPostFix: "",
                sSearch: "",
                sUrl: "",
                oPaginate: {
                    sFirst: "Pertama",
                    sPrevious: "Sebelumnya",
                    sNext: "Selanjutnya",
                    sLast: "Terakhir",
                },
            },
            paging: true,
            processing: true,
            lengthChange: false,
            initComplete: function (settings, json) {
                $(".js-datatables").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>"
                );
            },
            ajax: {
                url: "/dashboard/history/data",
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "awb", name: "awb" },
                { data: "goods_entry", name: "goods_entry" },
                { data: "goods_entry_port", name: "goods_entry_port" },
                { data: "goods_arrive_port", name: "goods_arrive_port" },
                { data: "sorting_process_destination", name: "sorting_process_destination" },
                { data: "process_send_destination", name: "process_send_destination" },
                { data: "courier", name: "courier" },
                { data: "coli_total", name: "coli_total" },
                { data: "weight_total", name: "weight_total" },
                { data: "volume_total", name: "volume_total" },
                { data: "code", name: "code" },
                // { data: "aksi", name: "aksi" },
            ],
        });

    }

   

    
});

</script>
@endpush