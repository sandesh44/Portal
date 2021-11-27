@extends('admin.dashboard')

@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('video.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> View All Video</a>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="card-title">
                    <div class="title">Create Video</div>
                </div>
            </div>
            <div class="panel-body">
    
                <form action="{{route('video.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  
                  <div class="sub-title">Video TItle</div>
                  <div>
                      <input type="text" class="form-control" placeholder="Title" name="title" required>                                                                                                                                                                                                                                                                                                                                                    
                  </div>
                  <div class="sub-title">Video URI</div>
                  <div>
                      <input type="url" class="form-control" name="video" required>                                                                                                                                                                                                                                                                                                          
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
              </form>
                  
              </div>
        </div>
    </div>
</div>
@endsection