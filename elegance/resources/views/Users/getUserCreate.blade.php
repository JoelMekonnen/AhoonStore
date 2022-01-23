@extends('Misc.base')
@section('body')
   <div class="row justify-content-center">
         <div class="col-lg-6" style="margin-top:10%;">
             <div class="card" style="background-color:#28293d;">
                 <div class="card-header">
                     <h2 style="color:white;text-align:center;" class="myfonts">Ahoon Store</h2>
                 </div>
                 <div class="card-body">
                      <form method="POST" action="{{route('createUserPost')}}" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <label for="name" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Name</label>
                              <input id="name" type="text" class="form-control col-md-6" name="name" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label for="username" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Username</label>
                              <input id="username" type="text" class="form-control col-md-6" name="username" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label for="email" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Email</label>
                              <input id="email" type="email" class="form-control col-md-6" name="email" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label for="password" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Password</label>
                              <input id="password" type="password" class="form-control col-md-6" name="password" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label for="password-confirm" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Confirm password</label>
                              <input id="password-confirm" type="password" class="form-control col-md-6" name="password-confirm" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label class="form-label col-md-4 liteLinks text-md-right" for="customFile">Profile Picture</label>
                              <input type="file" name="profilePics" class="form-control col-md-6" id="customFile" />
                          </div>
                          <div class="form-group row">
                              <label for="Location" class="col-md-4 col-form-label text-md-right liteLinks">Location</label>
                              <input id="Location" type="text" class="form-control col-md-6" name="location" required autofocus/>
                          </div>
                          <div class="form-group row">
                              <label for="phone_number"  class="col-md-4 col-form-label text-md-right liteLinks">phone number</label>
                              <input id="phone_number" type="text" class="form-control col-md-6" name="phone_number" required autofocus/>
                          </div>
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-orange">
                                      Sign up
                                  </button>
                              </div>
                          </div>
                      </form>
                 </div>
             </div>
         </div>
   </div>
@endsection
