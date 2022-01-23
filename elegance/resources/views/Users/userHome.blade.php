@extends('Users.userBase')
@section('userContent')
         <div class="row">
             <div class="col-lg-2">

             </div>
             <div class="col-lg-8">
                  <div class="row justify-content-center" style="margin-top:2%;">
                      <div class="col-lg-6">
                          <form class="">
                              <div class="form-group">
                                  <div class="input-group">
                                      <input type="text" class="form-control searchStyle" placeholder="search products" style="margin-top:10px;">
                                      <div class="input-group-append">
                                          <button class="btn btn-orange" type="button">
                                              <i class="fa fa-search"></i>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>

                  </div>
                 <div class="row justify-content-center">
                     @foreach($cats as $cat)
                         <div class="col-lg-12">
                             <div class="row">
                                 <div class="col-lg-12">
                                     <h1 class="firstHead" style="color:white;">{{$cat->catName}}</h1>
                                 </div>
                       @foreach($prods as $prod)
                           @if($prod->category->catName == $cat->catName)
                             <div class="col-lg-4">
                                 <div class="card" style="background-color:#28293d;height:600px">
                                     <img src="{{asset('storage/product/'.$prod->prodImage)}}" alt="phones" class="card-img-top" style="height:400px"/>
                                     <div class="card-body">
                                         <div class="row justify-content-center">
                                             <h3 class="myfonts" style="color:#f16724;">{{$prod->productName}}</h3><br/>
                                         </div>
                                         <div class="row justify-content-center">
                                             <p style="color:white; font-size:20px;"> {{$prod->price}} birr</p>
                                         </div>
                                         <div class="row justify-content-center">
                                             <a href="{{route('getProdOrder', ['id'=>$prod->id])}}" class="btn btn-orange">buy</a>
                                             <a href="#" class="btn btn-purple">watchlist</a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                                     @endif
                           @endforeach
                             </div>
                         </div>
                      @endforeach
                 </div>
             </div>
             <div class="col-lg-2">

             </div>
         </div>
@endsection
