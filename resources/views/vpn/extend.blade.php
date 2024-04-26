<div class="modal animated fade fadeInDown" id="modal_extend" tabindex="-1" role="dialog" aria-labelledby="modal_extend"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">
            <form action="" id="form_extend">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleEdit"><i class="fas fa-info me-1 bs-tooltip"
                            title="Select Router"></i>Extend With Balance</h5>
                    <button type="button" class="btn-close bs-tooltip" data-bs-dismiss="modal" aria-label="Close"
                        title="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="amount">Value Extend :</label>
                        <select name="amount" id="amount" class="form-control" style="width: 100%;" required>
                            <option value="">Please Select amount to extend</option>
                            <option value="1">1 Month : IDR 10.000</option>
                            <option value="2">2 Month : IDR 20.000</option>
                            <option value="3">3 Month : IDR 30.000</option>
                            <option value="4">4 Month : IDR 40.000</option>
                            <option value="5">5 Month : IDR 50.000</option>
                            <option value="6">6 Month : IDR 60.000</option>
                            <option value="12">1 Years : IDR 100.000</option>
                        </select>
                        <span id="err_amount" class="error invalid-feedback" style="display: hide;"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-times me-1 bs-tooltip" title="Close"></i>Close</button>
                    <button id="btn_modal_submit" type="submit" class="btn btn-primary"><i
                            class="fas fa-paper-plane me-1 bs-tooltip" title="Submit"></i>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
