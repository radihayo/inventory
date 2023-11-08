<div class="modal fade" id="edit_jenis">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <form id="quickForm">
                <div class="modal-body">
                    <input type="hidden" id="id"> 
                    <div class="form-group">
                        <label for="jenis_edit">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenis_edit" id="jenis_edit">
                        <div id="jenis_edit-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data_jenis">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>