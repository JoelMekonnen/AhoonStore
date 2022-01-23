@extends('Admin.adminHome')
@section('adminContent')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <h1 class="firstHead" style="color:white;">Existing Categories</h1>
            </div>
            <hr style="border-color:white;"/>
            <div class="row" style="margin-top:30px;">
                  @foreach($cats as $cat)
                      <div class="col-lg-2">
                          <div class="card" style="background-color:#28293d;">
                              <div class="card-body">
                                  <div class="row justify-content-center">
                                      <h5 style="color:white;margin-top:7px;">{{$cat->catName}}</h5>
                                      <a class="nav-link" style="color:white;"><i class="fa-solid fa-highlighter"></i></a>
                                      <a class="nav-link" style="color:white;"><i class="fa-solid fa-delete-left"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                @endforeach
            </div>
            <hr style="border-color:white;"/>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin-top:30px; background-color:#28293d;">
                <div class="card-header">
                    <h3 class="card-title liteLinks">Create cateogry</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('catUpload')}}">
                        {{csrf_field()}}
                        <div class="form-group row" style="padding-left:3%;padding-right:3%;">
                            <label for="catName" class="col-lg-4 liteLinks">category Name</label>
                            <input type="text" name="catName" required id="catName" class="form-control dark col-lg-6"/>
                        </div>
                        <hr style="border-color:white;">
                        <div class="form-group row" style="padding-left:3%;padding-right:3%;">
                            <label for="prodDesc" class="col-lg-4 liteLinks">category description</label>
                            <textarea name="catDesc" required id="catDesc" class="form-control col-lg-8" rows="7">
                           </textarea>
                        </div>
                        <hr style="border-color:white;">
                        <div class="form-group">
                            <input type="submit" class="btn btn-orange" name="btnCreate" value="create"/>
                        </div>
                    </form>
                </div>
    </div>
    <script>
        let pageId = document.getElementById('categoryLink');
        pageId.className += " active";
    </script>
@endsection
