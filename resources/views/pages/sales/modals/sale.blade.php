<script src="{{ asset('assets/plugins/custom/autonumeric/autoNumeric.js') }}"></script>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Pembayaran</h3>
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
        </div>

        <form action="{{ route('sale.storeSale') }}" method="POST" id="store_sale" accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="invoice_code" value="{{ $invoice_code ?? '' }}" id="invoice_code">
                <input type="hidden" name="customer" value="{{ $customer ?? '' }}">
                <input type="hidden" name="total_gross" value="{{ $total ?? '' }}" id="total_gross">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(%)</label>
                            <input type="text" name="discount_percent" id="discount_percent" class="form-control"
                                value="0">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(Rp)</label>
                            <input type="text" name="discount_cash" id="discount_cash" class="form-control"
                                value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Total Pembayaran</label>
                    <input type="text" name="total_net" id="total_net" class="form-control form-control-lg"
                        value="{{ $total ?? '' }}"
                        style="font-weight: bold; text-align: right; color: blue; font-size: 24pt;" readonly>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Uang</label>
                    <input type="text" name="payment_money" id="payment_money" class="form-control"
                        style="font-weight: bold; text-align: right; color: red; font-size: 20pt;">
                </div>
                <div class="form-group">
                    <label for="">Sisa Uang</label>
                    <input type="text" name="change_money" id="change_money" class="form-control"
                        style="font-weight: bold; text-align: right; color: blue; font-size: 20pt;" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="save-button">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function calculateDiscount() {
        let total_gross = $('#total_gross').val();
        let discount_percent = ($('#discount_percent').val() == '') ? 0 : $('#discount_percent').autoNumeric('get');
        let discount_cash = ($('#discount_cash').val() == '') ? 0 : $('#discount_cash').autoNumeric('get');

        let result = 0;
        result = parseFloat(total_gross) - (parseFloat(total_gross) * parseFloat(discount_percent) /
            100) - parseFloat(
            discount_cash);

        $('#total_net').val(result);

        let total = $('#total_net').val();
        $('#total_net').autoNumeric('set', total);

    }

    function calculateChangeMoney() {
        let total = $('#total_net').autoNumeric('get');
        let payment_money = ($('#payment_money').val() == '') ? 0 : $('#payment_money').autoNumeric('get');

        let result = 0;
        result = parseFloat(payment_money) - parseFloat(total);

        $('#change_money').val(result);

        let change_money = $('#change_money').val();
        $('#change_money').autoNumeric('set', change_money);
    }

    $(document).ready(function() {
        // Initiate Toast from Sweet Alert
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $('#discount_percent').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            nDec: '2',
        });

        $('#discount_cash').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            nDec: '0',
        });

        $('#total_net').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            nDec: '0',
        });

        $('#payment_money').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            nDec: '0',
        });

        $('#change_money').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            nDec: '0',
        });

        $('#discount_percent').keyup(function(e) {
            calculateDiscount();
        });

        $('#discount_cash').keyup(function(e) {
            calculateDiscount();
        });

        $('#payment_money').keyup(function(e) {
            calculateChangeMoney();
        });

        $('#store_sale').submit(function(e) {
            e.preventDefault();

            let total_net = ($('#total_net').val() == '') ? 0 : $('#total_net').autoNumeric('get');
            let payment_money = ($('#payment_money').val() == '') ? 0 : $('#payment_money').autoNumeric(
                'get');
            let change_money = ($('#change_money').val() == '') ? 0 : $('#change_money').autoNumeric(
                'get');

            if (parseFloat(total_net) < 0) {
                Toast.fire({
                    icon: 'error',
                    title: 'Maaf, total pembayaran tidak valid.'
                });
            } else if (parseFloat(payment_money) == 0 || parseFloat(payment_money) == '' || parseFloat(
                    payment_money < 0)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Maaf, jumlah uang belum dimasukkan.'
                });
            } else if (parseFloat(change_money) < 0) {
                Toast.fire({
                    icon: 'error',
                    title: 'Maaf, jumlah uang belum mencukupi.'
                });
            } else {
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    dataType: "json",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#save-button').prop('disable', true);
                        $('#save-button').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('#save-button').prop('disable', false);
                        $('#save-button').html('Simpan');
                    },
                    success: function(response) {
                        if (response.success) {
                            // console.log(response.success);
                            Swal.fire({
                                title: 'Transaksi Berhasil!',
                                text: "Anda berhasil melakukan transaksi.",
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                            })
                            window.location.reload();
                        } else {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
