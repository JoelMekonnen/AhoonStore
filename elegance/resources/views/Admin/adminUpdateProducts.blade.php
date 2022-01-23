@extends('Admin.adminHome')
@section('adminContent')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="margin-top:100px;">
                <div class="card-header">
                    <h3 class="card-title" style="text-align:center;">Update products</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('putUpdateProds', ['id'=>$prods->id])}}">
                        @csrf
                        <div class="form-group row">
                            <label for="productName"  class="col-lg-4">product Name</label>
                            <input class="form-control col-lg-8"  type="text" value="{{$prods->productName}}" name="productName" id="productName"/>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="productDesc"  class="col-lg-4">Product Description</label>
                            <textarea class="form-control col-lg-8"  name="productDesc" id="productDesc">{{$prods->productDesc}}</textarea>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="price"  class="col-lg-2">price</label>
                            <input type="number" class="form-control col-lg-8" name="price" value="{{$prods->price}}" id="price"/>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <input type="submit" class="btn btn-primary" name="btnUpdate" value="update"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


