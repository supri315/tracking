@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Data Daftar Kiriman</h4>
        <div class="card">
			<div class="col-12 mb-5">
                    <div class="card-body">
                      <div class="demo-inline-spacing">
						<a href ="{{route('admin.daftarkiriman.create')}}"
							type="button" 
							class="btn btn-primary" 
							style="float: right"> Tambah Data
						</a>
                      </div>
                    </div>
			</div>
			<table id="listsubmission" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanngal Kedatangan</th>
					<th>Nama Kurir</th>
					<th>Total Transaksi</th>
					<!-- <th>Total Transaksi</th> -->
                    <th>Aksi</th>

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
        $("#listsubmission").DataTable({
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
                url: "/dashboard/daftar-kiriman/data",
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "end_date", name: "end_date" },
                { data: "name", name: "name" },
                { data: "total_transaction", name: "total_transaction" },
                { data: "aksi", name: "aksi" },
            ],
        });

    }

   

    
});

</script>
@endpush