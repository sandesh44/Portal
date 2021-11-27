@extends('admin.dashboard')

@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('photogallery.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> View All Image</a>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
    
                <form action="{{route('photogallery.update',$photo->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="sub-title">Title Name</div>
                     <div>
                        <input type="text" class="form-control" placeholder="Category" name="title" value="{{$photo->title}}" required>
                    </div>
                    <div class="sub-title">Image</div>
                    <div>
                        <input type="file" name="image" required> 
                        <img src="{{asset('/storage/image/'.$photo->image) }}" height="75" width="75" alt="" />  
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection