@extends('admin.dashboard')

@section('content')
<div class="col-auto float-right ml-auto">
    
</div>

<div class="row">
  <div class="col-xs-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <div class="card-title">
                  <div class="title"><a href="{{ route('news.index') }}" class="btn btn-success">SHOW NEWS</a></div>
              </div>
          </div>
          <div class="panel-body">
    
            <form action="{{route('news.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="">News Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      @php echo  $categories_dropdown @endphp
                    </select>
                  </div>
                    <div class="form-group col-md-3">
                      <label for="">News Title</label>
                      <input type="text" class="form-control"  placeholder="News Title" name="news_title" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Image</label>
                      <input type="file" name="image" required>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">News Description</label>
                    <textarea class="ckeditor form-control" name="news_content"></textarea>
                   </div>
                   <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">Seo Title</label>
                      <input type="text" class="form-control"  placeholder="Seo Title" name="seo_title"  required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">Seo Subtitle</label>
                      <input type="text" class="form-control" name="seo_subtitle"required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Seo Keyword</label>
                        <input type="text" class="form-control"  placeholder="Seo Keyword" name="seo_keywords" required>
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Seo Description</label>
                    <textarea class="form-control" rows="3" name="seo_description" placeholder="Seo Description" required></textarea>
                   </div>
                    <div class="form-group  col-md 12"  data-children-count="1" >
                        <label class="form-check-label" for="invalidCheck">Mark as Active</label>
                        <input class="form-check-input" type="checkbox" value="1" name="status" id="status" checked>  
                    </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
            
        </div>
      </div>
  </div>
</div>
@endsection