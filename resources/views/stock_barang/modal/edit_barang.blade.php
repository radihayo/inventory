<div class="modal fade" id="edit_barang">
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
                        <label for="nama_edit">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_edit" id="nama_edit">
                        <div id="nama_edit-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ukuran_edit">Ukuran</label>
                                <input type="text" class="form-control" name="ukuran_edit" id="ukuran_edit">
                                <div id="ukuran_edit-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="stock_edit">Stock</label>
                                <input type="text" class="form-control input_number" name="stock_edit" id="stock_edit">
                                <div id="stock_edit-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_edit">Jenis</label>
                        <select class="form-control " name="id_jenis_edit" id="id_jenis_edit">
                            @foreach ($data_jenis as $item)
                            <option value="{{$item->id}}">{{$item->jenis}}</option>
                            @endforeach
                        </select>
                        <div id="id_jenis_edit-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="id_merek_edit">Merek</label>
                        <select class="form-control " name="id_merek_edit" id="id_merek_edit">
                            @foreach ($data_merek as $item)
                            <option value="{{$item->id}}">{{$item->merek}}</option>
                            @endforeach
                        </select>
                        <div id="id_merek_edit-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_satuan_edit">Satuan</label>
                                <select class="form-control " name="id_satuan_edit" id="id_satuan_edit">
                                    @foreach ($data_satuan as $item)
                                    <option value="{{$item->id}}">{{$item->satuan}}</option>
                                    @endforeach
                                </select>
                                <div id="id_satuan_edit-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_lokasi_edit">Lokasi</label>
                                <select class="form-control " name="id_lokasi_edit" id="id_lokasi_edit">
                                    @foreach ($data_lokasi as $item)
                                    <option value="{{$item->id}}">{{$item->lokasi}}</option>
                                    @endforeach
                                </select>
                                <div id="id_lokasi_edit-error"></div>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data_barang">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>