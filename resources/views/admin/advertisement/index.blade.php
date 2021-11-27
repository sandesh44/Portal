@extends('admin.dashboard')
@section('custom-style')
    <!-- TABLE STYLES-->
    <link href="/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
@endsection
@section('content')
<div class="col-auto float-right ml-auto">
    <a href="{{ route('advertisement.create') }}" class="btn add-btn" ><i class="fa fa-eye"></i>Create Advertisement</a>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="title"><a href="{{ route('advertisement.create') }}" class="btn btn-success">Create Advertisement</a></div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Advertisement Name</th>
                                <th>Url</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisement as $item)
                                <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->url}}</td>
                                <td><img src="{{asset('/storage/image/'.$item->image) }}" height="75" width="75" alt="" /></td>
                                <td>
                                    @if($item->status == 1)
                                    <p><a href="#" class="text-success">Active</a></p>
                                    @else
                                    <p><a href="#" class="text-danger">In Active</a></p>
                                    @endif

                                </td>
                                <td><a href="{{ route('advertisement.edit', $item->id)}}" class="btn btn-primary">Edit</a></td>
                                <td><form action="{{ route('advertisement.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
       <script type="text/javascript">
        
            $('.show_confirm').click(function(event) {
                 var form =  $(this).closest("form");
                 var name = $(this).data("name");
                 event.preventDefault();
                 swal({
                     title: `Are you sure you want to delete this record?`,
                     text: "If you delete this, it will be gone forever.",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                 })
                 .then((willDelete) => {
                   if (willDelete) {
                     form.submit();
                   }
                 });
             });
         
       </script>
@endsection