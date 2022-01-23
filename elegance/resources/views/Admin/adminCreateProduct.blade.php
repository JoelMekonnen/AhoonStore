@extends('Admin.adminHome')
@section('adminContent')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="margin-top:30px; background-color:#28293d;">
                <div class="card-header">
                    <h3 class="card-title liteLinks">Upload products</h3>
                </div>
                <div class="card-body">
                   <form method="POST" action="{{route('productCreate')}}" enctype="multipart/form-data">
                       {{csrf_field()}}
                         <div class="form-group row" style="padding-left:3%;padding-right:3%;">
                             <label for="prodName" class="col-lg-4 liteLinks">Product name</label>
                             <input type="text" name="productName" required id="prodName" class="form-control dark col-lg-6"/>
                         </div>
                       <hr style="border-color:white;">
                       <div class="form-group row" style="padding-left:3%;padding-right:3%;">
                           <label for="prodDesc" class="col-lg-4 liteLinks">Product Description</label>
                           <textarea name="productDesc" required id="prodDesc" class="form-control col-lg-8" rows="7">
                           </textarea>
                       </div>
                       <hr style="border-color:white;   ">
                       <div class="form-group row" style="padding-left:3%;padding-right:3%;">
                           <label for="price" class="col-lg-4 liteLinks">price</label>
                           <input type="number" name="price" required id="price" class="form-control col-lg-4"/>
                       </div>
                       <hr style="border-color:white;   ">
                       <div class="form-group">
                           <label for="category" class="liteLinks">Category</label>
                           <select class="form-control-file" id="category" name="catSelect">
                               @foreach($cats as $cat)
                                   <option value="{{$cat->id}}">{{$cat->catName}}</option>
                               @endforeach
                           </select>
                       </div>
                       <hr style="border-color:white;   ">
                           <div class="form-group">
                               <label for="inputFile" class="liteLinks">upload image</label>
                               <input type="file" class="form-control-file" id="inputFile" name="prodPics">
                           </div>
                       <hr style="border-color:white;   ">
                       <div class="form-group">
                           <input type="submit" class="btn btn-orange" name="btnCreate" value="create"/>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let pageId = document.getElementById('createProducts');
         pageId.className += " active";
    </script>
@endsection
