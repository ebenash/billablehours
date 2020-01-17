@extends('layouts.app')

@section('content')
<section class="jumbotron text-center row align-items-center">
    <div class="container">
      <h1>Timesheet Invoice Generator</h1>
      <p class="lead text-muted">Submit timesheet list in csv format. Max File Size: 25MB</p>
      <p>
        <a class="btn btn-primary my-2" id="upload_modal" data-toggle="modal" href="#uploadModal" role="button" aria-expanded="false" aria-controls="uploadModal">Get Started</a>
      </p>
    </div>
  </section>

  <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="uploadModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form method="POST" action="{{route('timesheetupload')}}" enctype="multipart/form-data">
                @csrf 
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalTitle">Timesheet File Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="import_file" id="import_file" class="form-control" >
                        <small id="importfileHelpBlock" class="form-text text-muted">CSV File Format. Maximum File Size: 25MB</small>
                        <small id="importfileHelpBlock2" class="form-text text-muted"><a href="{{asset('/downloads/sample_file.csv')}}">Download Sample File</a></small>
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="headers" name="headers">
                        <label class="custom-control-label" for="headers">Headers on First Row</label><br/>
                        <small>Select if the first row in the file contains the table headings.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn  btn-primary" id="upload">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
