<div class="modal fade" id="edit_masuk">
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
                        <label for="tanggal_masuk_edit">Tanggal Masuk</label>                        
                        <div class="input-group date" id="date_picker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="tanggal_masuk_edit" id="tanggal_masuk_edit" data-target="#date_picker2"/>
                            <div class="input-group-append" data-target="#date_picker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div id="tanggal_masuk_edit-error"></div>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_barang_edit">Nama Barang</label>
                        <select class="form-control" name="id_barang_edit" id="id_barang_edit" disabled>
                            <option value="">--Pilih--</option>
                            @foreach ($data_barang as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <div id="id_barang_edit-error"></div>
                    </div> 
                    <div class="form-group">
                        <label for="jumlah_edit">Jumlah</label>
                        <input type="text" class="form-control input_number" name="jumlah_edit" id="jumlah_edit" disabled>
                        <div id="jumlah_edit-error"></div>
                    </div> 
                    <div class="form-group">
                        <label for="keterangan_edit">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan_edit" id="keterangan_edit"></textarea>
                        <div id="keterangan_edit-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data_masuk">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>