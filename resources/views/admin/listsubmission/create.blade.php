@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data Daftar Kiriman</h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.daftarkiriman.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tanggal Kedatangan</label>
                    <input type="date" id="start_date" name="end_date" class="form-control" id="basic-default-company" placeholder="tanggal kedatangan" />
                    @if ($errors->has('end_date'))
                    <span class="red-text" style="color:red;">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Kurir</label>
                        <select class="form-select" name="user_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($supir as $value)
                          <option value="{{ $value->id }}">{{ $value->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('user_id') }}</span>
                        @endif
                </div>
                
                <table id="transactiondatakiriman" class="table">
                <thead>
                    <tr>
                        <th>No</th>                      
                        <th>Nama Penerima</th>
                        <th>Alamat Penerima</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th> 
                        <th>No Hp Penerima</th>
                        <th>Jumlah Koli</th>
                    </tr>
                </thead>
			<tbody>
			</tbody>
			</table>
                <button type="submit" class="btn btn-primary mt-4">Tambah Data</button>

            </form>
            </div>
            </div>
        </div>


    </div>
</div>

@endsection


@push('script')
<script>
       var startDateInput = document.getElementById('start_date');
        var startDateValue = "";
        var dataTable = null;

        startDateInput.addEventListener('input', function () {
        startDateValue = startDateInput.value;

        // Hancurkan dataTable jika sudah ada
        if (dataTable !== null) {
            dataTable.destroy();
        }

        // Inisialisasi ulang dataTable dengan URL yang baru
        dataTable = $("#transactiondatakiriman").DataTable({
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
                url: "/dashboard/daftar-kiriman/getdatatransaction/" + startDateValue,
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "receiver", name: "receiver" },
                { data: "receiver_address", name: "receiver_address" },
                { data: "kecamatan", name: "kecamatan" },
                { data: "kelurahan", name: "kelurahan" },
                { data: "phone_receiver", name: "phone_receiver" },
                { data: "coli_total", name: "coli_total" },
            ],
        });
    });

    </script>
@endpush
