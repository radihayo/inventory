<div class="modal fade" id="edit_foto">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Foto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- mmm --}}
        {{-- <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="upload_foto" action="javascript:void(0)" >
            @csrf
            <div class="form-group">
              <label for="foto">File input</label>
              <div class="input-group" id="form_foto">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="foto" id="foto" required>
                      <label class="custom-file-label" for="foto">Choose file</label>                      
                  </div>
              </div>
              <div id="foto-error"></div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="upload">Upload</button>
        </div> --}}
{{-- mmm         --}}
        <div class="modal-body">
          <div class="form-group">
            <div class="form-group">
              <div class="row d-flex justify-content-center">
                <div id="upload-demo"></div>
              </div>
              <div class="input-group">
                <div class="custom-file">
                  {{-- <input type="file" class="custom-file-input" name="image" id="image" accept="image/*">
                  <label class="custom-file-label" for="image">Choose file</label>                       --}}

                  <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </div>
              </div>
              <div id="image-error"></div>
            </div> 
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="upload-image">Upload</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

