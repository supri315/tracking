@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Data Pengguna</h4>
        <div class="card">
			<div class="col-12 mb-5">
                    <div class="card-body">
                      <div class="demo-inline-spacing">
						<a href ="{{route('admin.user.create')}}"
							type="button" 
							class="btn btn-primary" 
							style="float: right"> Tambah Data
						</a>
                      </div>
                    </div>
			</div>
			<table id="users" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Role</th>
					<th>Branch</th>
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
        $("#users").DataTable({
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
            // responsive: false,
            processing: true,
            // scrollX: true,
            // filter: false,
            lengthChange: false,
            initComplete: function (settings, json) {
                $(".js-datatables").wrap(
                    "<div style='overflow:auto; width:100%;position:relative;'></div>"
                );
            },
            ajax: {
                url: "/dashboard/users/data",
                // data: {
                //     kode_satker: kode_satker_tab1,
                //     bulan: bulan_tab1,
                //     tahun: tahun_tab1,
                // },
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                { data: "role_name", name: "role_name" },
                { data: "branch_name", name: "branch_name" },
            
                { data: "aksi", name: "aksi" },
            ],
        });
        // $("#menu1Export").on("click", function ()  {
        //     kode_satker = kode_satker_tab1
        //     bulan = bulan_tab1
        //     tahun = tahun_tab1
        //     location.href = `/panev/pembinaan/pegawai-tidak-diklat/export?kode_satker_tab1=${kode_satker}&bulan_tab1=${bulan}&tahun_tab1=${tahun}`
        // });

    }

    // $("#kode_satker_tab1").change(function () {
    //     var kode_satker_tab1 = $("#kode_satker_tab1").val();
    //     var bulan_tab1 = $("#bulan_tab1").val();
    //     var tahun_tab1 = $("#tahun_tab1").val();

    //     $("#menu1Table").DataTable().destroy();

    //     fetch_data1(kode_satker_tab1, bulan_tab1, tahun_tab1);
    // });

    // $("#bulan_tab1").change(function () {
    //     var kode_satker_tab1 = $("#kode_satker_tab1").val();
    //     var bulan_tab1 = $("#bulan_tab1").val();
    //     var tahun_tab1 = $("#tahun_tab1").val();

    //     $("#menu1Table").DataTable().destroy();

    //     fetch_data1(kode_satker_tab1, bulan_tab1, tahun_tab1);
    // });

    // $("#tahun_tab1").change(function () {
    //     var kode_satker_tab1 = $("#kode_satker_tab1").val();
    //     var bulan_tab1 = $("#bulan_tab1").val();
    //     var tahun_tab1 = $("#tahun_tab1").val();

    //     $("#menu1Table").DataTable().destroy();

    //     fetch_data1(kode_satker_tab1, bulan_tab1, tahun_tab1);
    // });

    // $("body").on("click", ".modal-deletetab1", function() {
    //     var judulid = $(this).attr('data-id');
    //     swal({
    //         title: "Yakin?",
    //         text: "kamu akan menghapus data ini ?",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //         if (willDelete) {
    //             window.location = "/panev/pembinaan/pegawai-tidak-diklat/delete/"+judulid+"" 
    //             swal("Data berhasil dihapus", {
    //             icon: "success",
    //             });
    //         } else {
    //             swal("Data Tidak Jadi dihapus");
    //         }
    //     });
    // });

    
});

</script>
@endpush