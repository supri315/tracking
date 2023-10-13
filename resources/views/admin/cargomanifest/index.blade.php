@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Data Cargo Manifest</h4>
        <div class="card">
			<div class="col-12 mb-5">
                    <div class="card-body">
                      <div class="demo-inline-spacing">
						<!-- <a href ="{{route('admin.barangmasuk.create')}}"
							type="button" 
							class="btn btn-primary" 
							style="float: right"> Tambah Data
						</a> -->
                      </div>
                    </div>
			</div>
			<table id="cargomanifest" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Kapal</th>
					<th>Tanggal Keberangkatan</th>
					<th>Tanggal Kedatangan</th>
					<th>Asal Pelabuhan</th>
					<th>Tujuan Pelabuhan</th>
					<th>Nomor Dokumen</th>
					<th>No Polisi</th>
					<th>Nama Supir</th>
					<th>Total Transaksi</th>
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
        $("#cargomanifest").DataTable({
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
                url: "/dashboard/cargo-manifest/data",
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "ship_name", name: "ship_name" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "asal", name: "asal" },
                { data: "tujuan", name: "tujuan" },
                { data: "no_docs", name: "no_docs" },
                { data: "nopol", name: "nopol" },
                { data: "driver", name: "driver" },
                { data: "total_transaction", name: "total_transaction" },
                { data: "aksi", name: "aksi" },
            ],
        });

    }

   

    
});

</script>
@endpush