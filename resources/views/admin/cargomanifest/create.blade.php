@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data Cargo Manifest</h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.cargomanifest.store')}}" method="post">
                @csrf
        

                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Asal Pelabuhan</label>
                        <select class="form-select" name="kapal_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($kapals as $kapal)
                          <option value="{{ $kapal->id }}">{{ $kapal->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('kapal_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('kapal_id') }}</span>
                        @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Keberangkatan</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" id="basic-default-company" placeholder="tanggal keberangkatan" />
                    @if ($errors->has('start_date'))
                    <span class="red-text" style="color:red;">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kedatangan</label>
                    <input type="date" name="end_date" class="form-control" id="basic-default-company" placeholder="tanggal kedatangan" />
                    @if ($errors->has('end_date'))
                    <span class="red-text" style="color:red;">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Asal Pelabuhan</label>
                        <select class="form-select" name="source_branch_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($branchSource as $branch)
                          <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('source_branch_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('source_branch_id') }}</span>
                        @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Tujuan Pelabuhan</label>
                        <select class="form-select" name="destination_source_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($branchDestinations as $branch)
                          <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('destination_branch_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('destination_branch_id') }}</span>
                        @endif
                </div>
              
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nomor Dokumen</label>
                    <input type="text" name="no_docs" class="form-control" placeholder="nomor dokumen" />
                    @if ($errors->has('no_docs'))
                    <span class="red-text" style="color:red;">{{ $errors->first('no_docs') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nomor Polisi</label>
                    <input type="text" name="nopol" class="form-control" placeholder="nomor polisi" />
                    @if ($errors->has('nopol'))
                    <span class="red-text" style="color:red;">{{ $errors->first('nopol') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nama Supir</label>
                    <input type="text" name="driver" class="form-control" placeholder="nama supir" />
                    @if ($errors->has('driver'))
                    <span class="red-text" style="color:red;">{{ $errors->first('driver') }}</span>
                    @endif
                </div>
                
                <table id="transactiondata" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Resi</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan\</th>
                        <th>Alamat</th>
                        <th>Nama Penerima</th>
                        <th>No Hp Penerima</th>
                        <th>Nama Pengirim</th>
                        <th>No Hp Pengirim</th>
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
        dataTable = $("#transactiondata").DataTable({
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
                url: "/dashboard/cargo-manifest/getdatatransaction/" + startDateValue,
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "awb", name: "awb" },
                { data: "kecamatan", name: "kecamatan" },
                { data: "kelurahan", name: "kelurahan" },
                { data: "receiver_address", name: "receiver_address" },
                { data: "receiver", name: "receiver" },
                { data: "phone_receiver", name: "phone_receiver" },
                { data: "shipper", name: "shipper" },
                { data: "shipper_phone", name: "shipper_phone" },
                { data: "coli_total", name: "coli_total" },
            ],
        });
    });

    </script>
@endpush
