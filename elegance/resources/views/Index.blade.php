@extends('Misc.base')
@section('body')
    @guest
     <div class="container-fluid firstContainer">
         <div class="row justify-content-center">
               <div class="col-lg-8">
                   <div class="row justify-content-center">
                       <h1 class="firstHead" style="background-color:#28293d;display:inline;color:#f16724;text-align:center; padding:3%;border-radius:20px;">Welcome to ahoon store</h1>
                   </div>
               </div>
         </div>
     </div>
     <div class="container">
          <div class="row justify-content-center" style="height:auto;margin-top:50px;">
              <div class="col-lg-6">
                  <div class="card" style="height:100%;background-color:#28293d;padding:3%;">
                      <img class="img-fluid card-img-top" src="{{asset('assets/Images/headphones.png')}}" alt="laptops"/>
                      <div class="card-body">
                          <div class="row justify-content-center">
                            <h3 class="myfonts" style="color:#f16724;">The best Headphones</h3>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="row">
                      <div class="col-lg-12" style="height:400px !important;">
                          <div class="card" style="background-color:#28293d;">
                              <img src="{{asset('assets/Images/laptops.png')}}" alt="laptops"/>
                              <div class="card-body">
                                  <div class="row justify-content-center">
                                      <h3 class="myfonts" style="color:#f16724;">laptops</h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-12" style="height:400px !important;margin-top:60px;">
                          <div class="card" style="background-color:#28293d;">
                              <img src="{{asset('assets/Images/phones.jpeg')}}" alt="phones" style="height:300px !important; width:50%; margin-left:60px;"/>
                              <div class="card-body">
                                  <div class="row justify-content-center">
                                      <h3 class="myfonts" style="color:#f16724;">phones</h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
     </div>
     <div class="container" style="margin-top:30px;">
         <div class="row justify-content-center" style="height:60vh;margin-top:50px;">
             <div class="col-lg-6">
                 <div class="row">
                     <div class="col-lg-12" style="height:400px !important;">
                         <div class="card" style="background-color:#28293d;">
                             <img src="{{asset('assets/Images/ipad.png')}}" alt="laptops" height="350px" width="300px" style="margin-left:50px;"/>
                             <div class="card-body">
                                 <div class="row justify-content-center">
                                     <h3 class="myfonts" style="color:#f16724;">laptops</h3>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-12" style="height:400px !important;margin-top:60px;">
                         <div class="card" style="background-color:#28293d;">
                             <img src="{{asset('assets/Images/airpods.png')}}" alt="phones"/>
                             <div class="card-body">
                                 <div class="row justify-content-center">
                                     <h3 class="myfonts" style="color:#f16724;">phones</h3>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="card" style="height:100%;background-color:#28293d;padding:3%;">
                     <img class="img-fluid card-img-top" src="{{asset('assets/Images/macbook.png')}}" alt="laptops"/>
                     <div class="card-body">
                         <div class="row justify-content-center">
                             <h3 class="myfonts" style="color:#f16724;">Get your macbook</h3>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
{{--     <div class="container-fluid" style="height:auto; background-color:#efefef;">--}}
{{--         <div class="row justify-content-center" >--}}
{{--             @foreach($products as $prod)--}}
{{--                 <div class="col-lg-4" style="margin-top:100px;">--}}
{{--                     <div class="card" style="width:450px;margin-left:70px;">--}}
{{--                         <img src="{{asset('storage/product/'.$prod->prodImage)}}" class="card-img-top" width="300px" height="300px" alt="prodImages"/>--}}
{{--                         <div class="card-body">--}}
{{--                             <h3 class="h3 myfonts" style="text-align:center;">{{$prod->productName}}</h3>--}}
{{--                             <div class="row justify-content-center">--}}
{{--                                 <h5 class="myFonts">{{"$".$prod->price}}</h5>--}}
{{--                             </div>--}}
{{--                         </div>--}}
{{--                         <div class="row">--}}
{{--                             <div class="col-lg-4" style="margin-left:30px;">--}}
{{--                                                                      <div class="badge badge-primary"><p style="font-size:20px;">{{$prod->price}}</p></div>--}}
{{--                             </div>--}}
{{--                         </div>--}}
{{--                         <div class="row justify-content-center card-tools">--}}
{{--                             <a href="#" class="nav-link">--}}
{{--                                 <i class="fa-thin fa-cart-shopping-fast fa-2x" style="display:inline;"></i>--}}
{{--                             </a>--}}
{{--                             <a href="#" class="nav-link">--}}
{{--                                 <i class="fa-thin fa-tag fa-2x"></i>--}}
{{--                             </a>--}}
{{--                             <a href="#" class="nav-link">--}}
{{--                                 <i class="fa-thin fa-list-dropdown fa-2x"></i>--}}
{{--                             </a>--}}


{{--                         </div>--}}
{{--                     </div>--}}
{{--                 </div>--}}
{{--             @endforeach--}}
         </div>
     </div>
    @endguest
    @auth
        @if (Auth::user()->isAdmin)
                @yield('adminBody')
        @else
                @yield('userBody')
        @endif
    @endauth
@endsection
