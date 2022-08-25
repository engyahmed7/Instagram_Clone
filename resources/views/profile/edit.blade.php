

        @include('includes.navbar')
        <div class="container">
            <form method="POST" action="{{ route('profile.update',$profiles['id']) }}" enctype="multipart/form-data" >
                @method('PUT')
                @csrf
              
                    <div class="mb-3">
                      <label for="bio" class="form-label">Bio</label>
                      <input type="text" class="form-control" name="bio" value="{{ $profiles['bio'] }}">
                    </div>
                    <div class="mb-3">
                      <label for="gender" class="form-label">Gender</label>
                      <input type="text" class="form-control" name="gender" value="{{ $profiles['gender'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" name="website" value="{{ $profiles['website'] }}">
                      </div>
                      <div class="mb-3">
                        <label for="image" class="form-label">Avatar</label>
                        <input type="file" name="image" class="form-control" id="image" value="{{ $profiles['image'] }}" >
                      </div>
                 
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>