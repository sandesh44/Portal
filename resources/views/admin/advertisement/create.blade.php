@extends('admin.dashboard')

@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('advertisement.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> View All  Advertisement</a>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
    
                <form action="{{route('advertisement.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="sub-title">Advertisement Name</div>
                    <div>
                        <input type="text" class="form-control" placeholder="Advertisement Name" name="title" required>
                    </div>
                
                    <div class="sub-title">URL</div>
                    <div>
                        <input type="url" class="form-control" placeholder="URL" name="url" required>
                    </div>
            
                    <div class="sub-title">Image</div>
                    <div>
                        <input type="file"  name="image" required>
                    </div>
                   
                    <div class="sub-title">Status</div>
                    <div>
                        <div class="form-check" data-children-count="1">
                            <input class="form-check-input" type="checkbox" value="1" name="status" id="status" checked>
                            <label class="form-check-label" for="invalidCheck">
                                Mark as Active
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection