<div class="modal fade" id="add_user">
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
                        <label for="nama_add">Nama</label>
                        <input type="text" class="form-control" name="nama_add" id="nama_add">
                        <div id="nama_add-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email_add">Email</label>
                                <input type="text" class="form-control" name="email_add" id="email_add">
                                <div id="email_add-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_kelamin_add">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin_add" id="jenis_kelamin_add">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Laki - Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                                <div id="jenis_kelamin_add-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tempat_lahir_add">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_add" id="tempat_lahir_add">
                                <div id="tempat_lahir_add-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_add">Tanggal Lahir</label>                        
                                <div class="input-group date" id="date_picker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="tanggal_lahir_add" id="tanggal_lahir_add" data-target="#date_picker1"/>
                                    <div class="input-group-append" data-target="#date_picker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="tanggal_lahir_add-error"></div>                            
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="agama_add">Agama</label>
                                <select class="form-control " name="agama_add" id="agama_add">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Islam</option>
                                    <option value="1">Kristen</option>
                                    <option value="2">Hindu</option>
                                    <option value="3">Buddha</option>
                                    <option value="4">Konghucu</option>
                                </select>
                                <div id="agama_add-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_telp_add">Nomor Telepon</label>
                                <input type="text" class="form-control input_number" name="no_telp_add" id="no_telp_add">
                                <div id="no_telp_add-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_add">Alamat</label>
                        <input type="text" class="form-control" name="alamat_add" id="alamat_add">
                        <div id="alamat_add-error"></div>
                    </div>    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="store_data_user">Simpan</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>