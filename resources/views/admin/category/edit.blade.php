@extends('admin.dashboard')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
    
                <form action="{{route('category.update',$category->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="sub-title">Categoy Name
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Category" name="category_name" value="{{$category->category_name}}" required>
                    </div>
                
                    <div class="sub-title">Description</div>
                    <div>
                        <textarea class="form-control" rows="3" name="description" required>{{$category->description}}</textarea>
                    </div>
                    <div class="sub-title">Parent Id</div>
                    <div>
                        <select name="parent_id" id="parent_id" class="form-control" required>
                            <option value="0">Main Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"  @if($category->id == $category->parent_id) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sub-title">Status</div>
                    <div>
                        <div class="form-check" data-children-count="1">
                            <input class="form-check-input" type="checkbox" value="1" name="status" id="status"  @if($category->status == 1) selected @endif>
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