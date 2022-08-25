@include('layouts.app2')

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label  class="form-label">Caption</label>


              <input type="text" class="form-control" name="caption" value="{{ old('caption') }}">
            </div>


            <div class="mb-3">
              <label  class="form-label">Add Image</label>
             <input type="file" name="images[]" multiple class="form-control" id="image">
            </div>


            <!-- <div class="mb-3">
              <label class="form-label">User ID</label>



              <input type="text" class="form-control" name="user_id">
            </div>
          -->





            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
