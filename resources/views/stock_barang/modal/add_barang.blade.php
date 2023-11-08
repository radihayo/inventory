<div class="modal fade" id="add_barang">
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
                        <label for="nama_add">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_add" id="nama_add">
                        <div id="nama_add-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ukuran_add">Ukuran</label>
                                <input type="text" class="form-control" name="ukuran_add" id="ukuran_add">
                                <div id="ukuran_add-error"></div>
                            </div>
                        </div>    
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="stock_add">Stock</label>
                                <input type="text" class="form-control input_number" name="stock_add" id="stock_add">
                                <div id="stock_add-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_add">Jenis</label>
                        <select class="form-control " name="id_jenis_add" id="id_jenis_add">
                            <option value="">--Pilih--</option>
                            @foreach ($data_jenis as $item)
                            <option value="{{$item->id}}">{{$item->jenis}}</option>
                            @endforeach
                        </select>
                        <div id="id_jenis_add-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="id_merek_add">Merek</label>
                        <select class="form-control " name="id_merek_add" id="id_merek_add">
                            <option value="">--Pilih--</option>
                            @foreach ($data_merek as $item)
                            <option value="{{$item->id}}">{{$item->merek}}</option>
                            @endforeach
                        </select>
                        <div id="id_merek_add-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_satuan_add">Satuan</label>
                                <select class="form-control " name="id_satuan_add" id="id_satuan_add">
                                    <option value="">--Pilih--</option>
                                    @foreach ($data_satuan as $item)
                                    <option value="{{$item->id}}">{{$item->satuan}}</option>
                                    @endforeach
                                </select>
                                <div id="id_satuan_add-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_lokasi_add">Lokasi</label>
                                <select class="form-control " name="id_lokasi_add" id="id_lokasi_add">
                                    <option value="">--Pilih--</option>
                                    @foreach ($data_lokasi as $item)
                                    <option value="{{$item->id}}">{{$item->lokasi}}</option>
                                    @endforeach
                                </select>
                                <div id="id_lokasi_add-error"></div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="store_data_barang">Simpan</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>