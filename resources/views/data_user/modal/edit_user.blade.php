<div class="modal fade" id="edit_user">
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
                        <label for="nama_edit">Nama</label>
                        <input type="text" class="form-control" name="nama_edit" id="nama_edit">
                        <div id="nama_edit-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input type="text" class="form-control" name="email_edit" id="email_edit">
                                <div id="email_edit-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_kelamin_edit">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin_edit" id="jenis_kelamin_edit">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Laki - Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                                <div id="jenis_kelamin_edit-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tempat_lahir_edit">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir_edit" id="tempat_lahir_edit">
                                <div id="tempat_lahir_edit-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_edit">Tanggal Lahir</label>                        
                                <div class="input-group date" id="date_picker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="tanggal_lahir_edit" id="tanggal_lahir_edit" data-target="#date_picker1"/>
                                    <div class="input-group-append" data-target="#date_picker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="tanggal_lahir_edit-error"></div>                            
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="agama_edit">Agama</label>
                                <select class="form-control " name="agama_edit" id="agama_edit">
                                    <option value="">--Pilih--</option>
                                    <option value="0">Islam</option>
                                    <option value="1">Kristen</option>
                                    <option value="2">Hindu</option>
                                    <option value="3">Buddha</option>
                                    <option value="4">Konghucu</option>
                                </select>
                                <div id="agama_edit-error"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_telp_edit">Nomor Telepon</label>
                                <input type="text" class="form-control input_number" name="no_telp_edit" id="no_telp_edit">
                                <div id="no_telp_edit-error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_edit">Alamat</label>
                        <input type="text" class="form-control" name="alamat_edit" id="alamat_edit">
                        <div id="alamat_edit-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data_user">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>