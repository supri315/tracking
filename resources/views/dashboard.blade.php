@extends('admin.layout')
 
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <!-- <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">CEK ONGKOS KIRIM</h5>
            </div> -->
            <div class="card-body">
            <h5>About Us</h5>         
            <img src="{{url('/assets/img/logobulat.png')}}" class="mb-4" width="130"/>
            <p>Kitrans Logistics</p>         
            <p>PT. KUNCI INTI TRANSINDO (Kitrans) adalah Perusahaan Jasa Pengiriman Barang, yaitu penyedia layanan transportasi terpadu (Multimoda), dengan menggunakan kombinasi berbagai mode transportasi darat, laut dan udara, mulai dari pemuatan barang, pengepakan, penyimpanan dan pengantaran sampai sepatutnya disampaikan pada titik akhir tujuan. Dengan tujuan untuk meningkatkan / mempromosikan hubungan dagang dan bisnis antara klien kami dengan pelanggan mereka secara efektif dan efisien, setiap layanan, baik dalam skala besar maupun kecil, akan diselesaikan dengan konsep Kitrans Logistics <b>"ONE STOP LOGISTICS SERVICE".</b></p>         
            <p> Visi<br>
             Menjadi perusahaan logistik dan jasa layanan yang lengkap, padu, handal dan mendunia</p>
            <p> Misi<br>
            perusahaan adalah untuk mendorong pemeberdayaan dan membawa kesejahteraan kepada segenap sumber daya manusia untuk dapat memenuhi harapan pelanggan.
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