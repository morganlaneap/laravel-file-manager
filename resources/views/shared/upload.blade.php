<!-- upload modal -->
<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload file...</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('file.upload') }}" class="dropzone" id="uploaddropzone">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                <button type="button" id="upload-file-submit" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload</button>
            </div>
        </div>
    </div>
</div>
