@extends('Admin.adminHome')
@section('adminContent')
    <div class="row" style="margin-top:40px;">
        @foreach($products as $prods)
        <div class="col-lg-4">
            <div class="card bg-gradient-dark" style="width:350px !important;">
                 <img src="{{asset('storage/product/'.$prods->prodImage)}}" alt="background alt" class="card-img-top" style="height:400px!important;"/>
                 <div class="card-body">
                     <h3 class="myfonts" style="color:#f16724 !important;font-weight: bold;">{{$prods->productName}}</h3>
                     <p>{{$prods->productDesc}}</p>
                     <div class="row justify-content-center">
                          <a href="{{route('getUpdateProds', ['id'=>$prods->id])}}" class="btn btn-primary">update</a>
                         <a href="#" class="btn btn-danger">delete</a>
                     </div>
                 </div>
            </div>
        </div>
    @endforeach
    </div>
    <script>
        let pageId = document.getElementById('showProducts');
        pageId.className += " active";
    </script>
@endsection
