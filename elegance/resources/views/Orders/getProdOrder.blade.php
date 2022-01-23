@extends('Index')
@section('userBody')
    <div class="row justify-content-center">
        <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-6" style="background-color:white !important;height:100vh;">
                      <div class="row justify-content-center">
                          <img src="{{asset('storage/product/'.$prods[0]->prodImage)}}" alt="background alt" style="height:400px; margin-top:170px;"/>
                      </div>
                      <div class="row justify-content-center">
                          <h1 class="firstHead" style="color:#f16724;">{{$prods[0]->productName}}</h1>
                      </div>
                      <div class="row justify-content-center">
                          <p class="lead" style="color:black; font-family:'Source Sans Pro', serif !important; font-size:20px;font-weight: bold;">{{$prods[0]->productDesc}}</p>
                      </div>
                      <div class="row justify-content-center">
                          <p class="lead" style="color:black; font-family:'Source Sans Pro', serif !important; font-size:40px;font-weight: bold">$${{$prods[0]->price}} Birr</p>
                      </div>
                  </div>
                  <div class="col-lg-6" style="margin-top:150px;">
                      <div class="card" style="background-color:#28293d;">
                          <div class="card-header">
                              <h2 style="color:white;text-align:center;" class="myfonts">{{$prods[0]->productName}} - <span id="total"></span> Birr</h2>
                          </div>
                          <div class="card-body">
                              <form method="POST" action="{{route('createProdOrder', ['id'=>$prods[0]->id])}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-group row">
                                      <label for="Quantity" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Quantity</label>
                                      <input id="Quantity" type="number" class="form-control col-md-6" name="quantity" required autofocus/>
                                  </div>
                                  <div class="form-group row">
                                      <label for="City" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">City</label>
                                      <input id="City" type="text" class="form-control col-md-6" name="city" required autofocus/>
                                  </div>
                                  <div class="form-group row">
                                      <label for="sub-city" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">Sub-City</label>
                                      <input id="sub-city" type="text" class="form-control col-md-6" name="sub-city" required autofocus/>
                                  </div>
                                  <div class="form-group row">
                                      <label for="houseno" style="color:white;" class="col-md-4 col-form-label text-md-right liteLinks">house number</label>
                                      <input id="houseno" type="text" class="form-control col-md-6" name="house-no" required autofocus/>
                                  </div>
                                  <div class="form-group row mb-0">
                                      <div class="col-md-6 offset-md-4">
                                          <button type="submit" class="btn btn-orange">
                                              Order
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
              </div>
        </div>
    </div>
        <script>
            let total = document.getElementById('total');
            let quant = document.getElementById('Quantity');
            quant.addEventListener('change', (e) => {
                    total.innerText = e.target.value * {{ $prods[0]->price }};
            });

        </script>
@endsection
