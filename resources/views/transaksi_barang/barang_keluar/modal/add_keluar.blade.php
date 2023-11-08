<div class="modal fade" id="add_keluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <form id="quickForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal_keluar_add">Tanggal Keluar</label>                        
                        <div class="input-group date" id="date_picker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="tanggal_keluar_add" id="tanggal_keluar_add" data-target="#date_picker1"/>
                            <div class="input-group-append" data-target="#date_picker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div id="tanggal_keluar_add-error"></div>                            
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="id_barang_add">Nama Barang</label>
                        <select class="form-control" name="id_barang_add" id="id_barang_add">
                            <option value="">--Pilih--</option>
                            @foreach ($data_barang as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <div id="id_barang_add-error"></div>
                    </div> 
                    <div class="form-group">
                        <label for="jumlah_add">Jumlah</label>
                        <input type="text" class="form-control input_number" name="jumlah_add" id="jumlah_add">
                        <div id="jumlah_add-error"></div>
                    </div> 
                    <div class="form-group">
                        <label for="keterangan_add">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan_add" id="keterangan_add"></textarea>
                        <div id="keterangan_add-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="store_data_keluar">Simpan</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>