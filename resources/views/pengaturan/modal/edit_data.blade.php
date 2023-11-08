<div class="modal fade" id="edit_data">
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
                        <label for="nama_update">Nama</label>
                        <input type="text" class="form-control" name="nama_update" id="nama_update">
                        <div id="nama_update-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email_update">Email</label>
                                <input type="text" class="form-control" name="email_update" id="email_update">
                                <div id="email_update-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_kelamin_update">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin_update" id="jenis_kelamin_update">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Laki - Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                                <div id="jenis_kelamin_update-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tempat_lahir_update">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_update" id="tempat_lahir_update">
                                <div id="tempat_lahir_update-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_update">Tanggal Lahir</label>                        
                                <div class="input-group date" id="date_picker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="tanggal_lahir_update" id="tanggal_lahir_update" data-target="#date_picker1"/>
                                    <div class="input-group-append" data-target="#date_picker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="tanggal_lahir_update-error"></div>                            
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="agama_update">Agama</label>
                                <select class="form-control " name="agama_update" id="agama_update">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Islam</option>
                                    <option value="1">Kristen</option>
                                    <option value="2">Hindu</option>
                                    <option value="3">Buddha</option>
                                    <option value="4">Konghucu</option>
                                </select>
                                <div id="agama_update-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_telp_update">Nomor Telepon</label>
                                <input type="text" class="form-control input_number" name="no_telp_update" id="no_telp_update">
                                <div id="no_telp_update-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_update">Alamat</label>
                        <input type="text" class="form-control" name="alamat_update" id="alamat_update">
                        <div id="alamat_update-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>