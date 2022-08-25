

        @include('includes.navbar')
        <div class="container">
            <form method="POST" action="{{ route('users.update',$users['id']) }}"  >
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $users['name'] }}">
                  </div>
                  
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" value="{{ $users['email'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{ $users['phone'] }}">
                      </div>

                      <button type="submit" class="btn btn-success">Update</button>
                      <br>
                      <br>
                      <a class="btn btn-primary" href="{{ route('change-password') }}">Change Password</a>
                   
                
                  

                  </form>
                </div>