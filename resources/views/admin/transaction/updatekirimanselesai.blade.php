@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Update Kiriman Selesai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updatekiriman.update') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">No Resi</label>
                    <input type="text" name="awb" class="form-control" placeholder="no resi"/>
                    @if ($errors->has('awb'))
                    <span class="red-text" style="color:red;">{{ $errors->first('awb') }}</span>
                    @endif
                </div>

                <input type="text" name="latitude" id="latitude" class="form-control" hidden/>
                <input type="text" name="longitude" id="longitude" class="form-control" hidden/>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
                @if(session('error'))
                <div class="alert alert-danger mt-2">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation tidak didukung oleh browser Anda.");
        }
    }

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        // Mengisi nilai input fields
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;
    }

    document.addEventListener("DOMContentLoaded", function() {
        getLocation();
    });
</script>



@endpush
