@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">CEK ONGKOS KIRIM</h5>
            </div>
            <div class="card-body">
               
            <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Kecamatan</label>
                        <select class="form-select" name="disctric_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($disctrics as $disctric)
                          <option value="{{ $disctric->id }}">{{ $disctric->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('disctric_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('disctric_id') }}</span>
                        @endif
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Total Koli</label>
                    <input type="text" name="coli_total" class="form-control" placeholder="total koli" />
                    @if ($errors->has('coli_total'))
                    <span class="red-text" style="color:red;">{{ $errors->first('coli_total') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Total Berat</label>
                    <input type="text" name="weight_total" class="form-control" placeholder="total berat" onkeyup="sumShipping();" id="weight_total"/>
                    @if ($errors->has('weight_total'))
                    <span class="red-text" style="color:red;">{{ $errors->first('weight_total') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Total Volume</label>
                    <input type="text" name="volume_total" class="form-control" placeholder="total volume" onkeyup="sumShipping();" id="volume_total"/>
                    @if ($errors->has('volume_total'))
                    <span class="red-text" style="color:red;">{{ $errors->first('volume_total') }}</span>
                    @endif
                </div>
                <div class="mb-3 text-center">
                    <label class="form-label" for="basic-default-phone"><b>Biaya Pengiriman</b></label>
                    <input type="text" name="shipping_amount" class="form-control" placeholder="biaya pengiriman" id="shipping_amount" disabled/>
                    @if ($errors->has('shipping_amount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('shipping_amount') }}</span>
                    @endif
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Diskon</label>
                    <input type="text" name="discount" class="form-control" placeholder="diskon" onkeyup="sumShipping();" id="discount" />
                    @if ($errors->has('discount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('discount') }}</span>
                    @endif
                </div> -->
                <!-- <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Total Pembayaran</label>
                    <input type="text" name="total_amount" class="form-control" placeholder="total pembayaran" onkeyup="sumShipping();" id="total_amount"  disable/>
                    @if ($errors->has('total_amount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('total_amount') }}</span>
                    @endif
                </div> -->
            </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    function sumShipping() {
        var weight_total = parseFloat(document.getElementById('weight_total').value);
        var volume_total = parseFloat(document.getElementById('volume_total').value);
        var shipping_amount = document.getElementById('shipping_amount');
        var total_amount = document.getElementById('total_amount');

        if (!isNaN(weight_total)) {
            var shippingAmountWeight = weight_total * 10000;
            shipping_amount.value = shippingAmountWeight;
            total_amount.value = shippingAmountWeight
        } else if (!isNaN(volume_total)) {
            var shippingAmountVolume = volume_total * 10000;
            shipping_amount.value = shippingAmountVolume;
            total_amount.value = shippingAmountVolume
        } else {
            shipping_amount.value = "Invalid input";
        }
    }
</script>

@endpush