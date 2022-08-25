

        @include('includes.navbar')
        <div class="container">
        <form method="POST" action="{{route('profile.store')}}" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="mb-3">
                      <label for="bio" class="form-label">Bio</label>
                      <input type="text" class="form-control" name="bio">
                    </div>
                    <div class="mb-3">
                      <label for="gender" class="form-label">Gender</label>
                      <input type="text" class="form-control" name="gender">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" name="website">
                      </div>
                      <div class="mb-3">
                        <label for="image" class="form-label">Avatar</label>
                        <input type="file" name="image" class="form-control" id="image" >
                      </div>
                 
                    <button type="submit" class="btn btn-primary">Add</button>
                  </form>
                </div>