<script>
function addDoc(pId){
    $("#exampleModal #pId").val(pId);
    $("#exampleModal").modal('show');
}
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
             
            <form method="POST" id="upload-image-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <input id="pId" name="pId" type="hidden"> 
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <div class="sDoc_File"> 
                                <label for="exampleFormControlFile1">Document <span class="text text-danger">(Please Upload Files in pdf,txt,xls,xlsx,docx,doc Format Only.)*</span></label>
                                <input   type="file" id="file" name="file"  class="form-control" accept=".xlsx, .xls, .doc, .docx, .txt, .pdf" id="sDoc_File"> 
                                <span class="text-danger" id="image-input-error"></span>
                            </div>  
                        </div>
                    </div> 
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <label for="name">Document Actual Hours</label>
                            <input type="number" min="1" max="1000" value="{{old('sAlctHours')}}"   name="sAlctHours" class="form-control" id="sAlct_Hours" placeholder="Document Actual Hours">
                            <span class="text-danger" id="actualhrs-input-error"></span>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
 