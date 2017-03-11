@extends('layouts.app')

@section('content')


    <table class="table table-hover">
        <th>Music List</th>
        @foreach ($files as $file)
        <tr>
            <td>{{ $file->path }}</td>
        <tr>
    @endforeach
    </table>
    
    

   
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Add Music
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
     
      <div class="modal-body">
      {{-- <form action="/music"  class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
       {{ csrf_field() }}
       <div class="fallback">
       <input name="file" type="file" multiple /></div>
      </form> --}}

        <form method="POST" action="/music" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="dropzone clsbox" id="mydropzone"></div>
                    
        </form>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>


    
@endsection

@section('scripts')
<script>  
        var myDropzone = new Dropzone("div#mydropzone",  { 
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "/upload",
        });

</script>
@endsection