<div class="modal fade" id="edit_password">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="quickForm2">
            <div class="modal-body">
              <input type="hidden" id="id_pw"> 
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" class="form-control" name="old_password" id="old_password">
                    <div id="old_password-error"></div>
                  </div>
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                    <div id="new_password-error"></div>
                </div>
                <div class="form-group">
                    <label for="re_new_password">Re-type Password Baru</label>
                    <input type="password" class="form-control" name="re_new_password" id="re_new_password" >
                    <div id="re_new_password-error"></div>
                 </div>
                <!-- /.card-body -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="update_password">Ubah</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->