@extends('admin.dashboard')
@section('custom-style')
    <!-- TABLE STYLES-->
    <link href="/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('news.create') }}" class="btn add-btn" ><i class="fa fa-eye"></i>Create News</a>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="title"><a href="{{ route('news.create') }}" class="btn btn-success">Create News</a></div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>News Title</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->news_title}}</td>
                                <td><img src="{{asset('/storage/image/'.$item->image) }}" height="75" width="120" alt=""  /></td>
                                <td>{{$item->category->category_name}}</td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="badge badge-success">published</span>
                                    @else
                                    <span class="badge badge-danger">draft</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('news.edit', $item->id)}}" class="btn btn-xs btn-primary">Edit</a></td>
                                <td><form action="{{ route('news.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs  btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
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