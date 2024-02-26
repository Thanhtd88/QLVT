<div class="modal fade" id="import-vehicle" tabindex="-1" aria-labelledby="import-vehicle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="import-vehicle">Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="{{ route('admin.vehicle.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        <div class="input-group">
                            <x-text-input type="file" name="import_file" class="form-control" required accept='.csv'/> 
                            <button style="margin: 0 5px" href="" type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Đồng ý</button>  
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->                    
            </div>
        </div>
    </div>
</div>

