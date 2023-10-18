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
@endpush
