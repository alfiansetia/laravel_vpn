<div class="modal animated fade fadeInDown" id="modal_pay" tabindex="-1" role="dialog" aria-labelledby="modal_pay"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-info me-1 bs-tooltip"
                        title="Select Router"></i>Pembayaran</h5>
                <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                    title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 17px">
                    Silahkan transfer dengan jumlah <b>(IDR <span class="modal_amount">Loading..</span>)</b> ke :
                    <br>
                    <br>Nama Bank : <b><span class="modal_bank_name">Loading..</span></b>
                    <br>No Rekening : <b><span class="modal_acc_number">Loading..</span></b>
                    <br>Atas Nama : <b><span class="modal_acc_name">Loading..</span></b>
                    <br>Jumlah : <b><span class="modal_amount">Loading..</span></b>
                    <br>
                    <br><span style="color: red"> Pastikan Anda sudah mentransfer, dan klik tombol Confirm dibawah
                        ini
                        untuk mengirimkan bukti transaksinya (wajib).
                    </span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                <button id="btn_modal_confirm" type="button" class="btn btn-primary"><i
                        class="fas fa-paper-plane me-1 bs-tooltip" title="Confirm"></i>Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>
