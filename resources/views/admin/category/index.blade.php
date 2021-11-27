@extends('admin.dashboard')
@section('custom-style')
    <!-- TABLE STYLES-->
    <link href="/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('category.create') }}" class="btn add-btn" ><i class="fa fa-eye"></i>Create Category</a>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                 Category Tables
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Parent Id</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                                <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->category_name}}</td>
                                <td>{{$item->description}}</td>
                                <td> @if($item->parent_id == 0)
                                    Main Category
                                @else
                                    {{ $item->subCategory->category_name }}
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="btn btn-xs btn-success">Active</span>
                                    @else
                                    <span class="btn btn-xs btn-danger">In Active</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('category.edit', $item->id)}}" class="btn btn-xs btn-primary">Edit</a></td>
                                <td><form action="{{ route('category.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form>
                                </td>
                                </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection
@section('custom-script')
    <!-- DATA TABLE SCRIPTS -->
    <script src="/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="/assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
       
       
@endsection