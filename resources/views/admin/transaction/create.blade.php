@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data Barang Masuk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.barangmasuk.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tanggal Pengiriman</label>
                    <input type="date" name="ship_date" class="form-control" placeholder="tanggal pengiriman" />
                    @if ($errors->has('ship_date'))
                    <span class="red-text" style="color:red;">{{ $errors->first('ship_date') }}</span>
                    @endif
                </div>
            
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Cabang Tujuan</label>
                        <select class="form-select" name="destination_branch_id" id="exampleFormControlSelect1" aria-label="Default select example">
                          @foreach($branchs as $branch)
                          <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('branch_id'))
                        <span class="red-text" style="color:red;">{{ $errors->first('branch_id') }}</span>
                        @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Pengirim</label>
                    <input type="text" name="shipper" class="form-control" placeholder="pengirim" />
                    @if ($errors->has('shipper'))
                    <span class="red-text" style="color:red;">{{ $errors->first('shipper') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Pengirim</label>
                    <textarea class="form-control" name="shipper_address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @if ($errors->has('shipper_address'))
                    <span class="red-text" style="color:red;">{{ $errors->first('shipper_address') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP Pengirim</label>
                    <input type="text" name="shipper_phone" class="form-control" id="basic-default-company" placeholder="no hp pengirim" />
                    @if ($errors->has('shipper_phone'))
                    <span class="red-text" style="color:red;">{{ $errors->first('shipper_phone') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Penerima</label>
                    <input type="text" name="receiver" class="form-control" placeholder="penerima" />
                    @if ($errors->has('receiver'))
                    <span class="red-text" style="color:red;">{{ $errors->first('receiver') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Penerima</label>
                    <textarea class="form-control" name="receiver_address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @if ($errors->has('receiver_address'))
                    <span class="red-text" style="color:red;">{{ $errors->first('receiver_address') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP Penerima</label>
                    <input type="text" name="phone_receiver" class="form-control" id="basic-default-company" placeholder="no hp penerima" />
                    @if ($errors->has('phone_receiver'))
                    <span class="red-text" style="color:red;">{{ $errors->first('phone_receiver') }}</span>
                    @endif
                </div>
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
                    <label class="form-label" for="basic-default-phone">Kelurahan</label>
                    <input type="text" name="kelurahan" class="form-control" placeholder="kelurahan" />
                    @if ($errors->has('kelurahan'))
                    <span class="red-text" style="color:red;">{{ $errors->first('kelurahan') }}</span>
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
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Biaya Pengiriman</label>
                    <input type="text" name="shipping_amount" class="form-control" placeholder="biaya pengiriman" id="shipping_amount"/>
                    @if ($errors->has('shipping_amount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('shipping_amount') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Diskon</label>
                    <input type="text" name="discount" class="form-control" placeholder="diskon" onkeyup="sumShipping();" id="discount" />
                    @if ($errors->has('discount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('discount') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Total Pembayaran</label>
                    <input type="text" name="total_amount" class="form-control" placeholder="total pembayaran" onkeyup="sumShipping();" id="total_amount" />
                    @if ($errors->has('total_amount'))
                    <span class="red-text" style="color:red;">{{ $errors->first('total_amount') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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
        var discount = parseFloat(document.getElementById('discount').value);

        if (!isNaN(weight_total)) {
            var shippingAmountWeight = weight_total * 10000;
            shipping_amount.value = shippingAmountWeight;
            formulaDiscount = (shipping_amount.value * (discount / 100));
            total_amount.value = shippingAmountWeight - formulaDiscount
        } else if (!isNaN(volume_total)) {
            var shippingAmountVolume = volume_total * 10000;
            shipping_amount.value = shippingAmountVolume;
            formulaDiscount = (shipping_amount.value * (discount / 100));
            total_amount.value = shippingAmountVolume - formulaDiscount
        } else {
            shipping_amount.value = "Invalid input";
        }
    }
</script>

@endpush