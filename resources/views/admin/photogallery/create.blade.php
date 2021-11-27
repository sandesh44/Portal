@extends('admin.dashboard')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="card-title">
                    <div class="title">Create Image</div>
                </div>
            </div>
            <div class="panel-body">
    
                <form action="{{route('photogallery.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  
                  <div class="sub-title">Image TItle</div>
                  <div>
                      <input type="text" class="form-control" placeholder="Title" name="title" required>                                                                                                                                                                                                                                                                                                                                                    
                  </div>
                  <div class="sub-title">Image</div>
                  <div>
                      <input type="file" name="image" required>                                                                                                                                                                                                                                                                                                          
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
              </form>
                  
              </div>
        </div>
    </div>
</div>
@endsection