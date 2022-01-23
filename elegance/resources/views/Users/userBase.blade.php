@extends('Index')
@section('userBody')
    <div class="container-fluid">
          <div class="row justify-content-center">
              <div class="col-lg-6" id="btnRow" style="border-bottom-style:solid;border-left-style:solid;border-right-style: solid; border-color:white;border-width:1px;padding-bottom:30px;">
                   <div class="row justify-content-center" style="margin-top:30px;">
                       <a href="#" class="userOpt"> <i  class="fas fa-user fa-2x" style="color:white;"></i> </a>
                       <a href="#" class="userOpt"> <i class="fas fa-rectangle-vertical-history fa-2x" style="color:white;margin-left:60px"></i> </a>
                       <a href="#" class="userOpt"><i class="fa-solid fa-podcast fa-2x" style="color:white;margin-left:60px;"></i> </a>
                       <a href="#" class="userOpt"><i class="fa-solid fa-mobile-button fa-2x" style="color:white;margin-left:60px;"></i> </a>
                   </div>
              </div>
          </div>
          @yield('userContent')
    </div>
@endsection
