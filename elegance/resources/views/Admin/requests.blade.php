@extends('Admin.adminHome')
@section('adminContent')
     <div class="row justify-content-center">
         <h1 class="firstHead" style="color:white;">Pending Orders</h1>
     </div>
     <div class="row justify-content-center">
         <div class="col-lg-10">
             @if(count($orders["pending"]) == 0)
                 <hr style="border-color:white !important;"/>
                 <h3 class="firstHead" style="color:lightblue">No pending orders</h3>
                 <hr style="border-color:white !important;"/>
             @else
             <table class="table table-striped" style="background-color:#343a40;padding:2%;">
                 <thead>
                 <tr>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">#</th>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">product</th>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">quantity</th>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">total</th>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">Ordered By</th>
                     <th scope="col" class="myfonts" style="color:white;font-size:20px;">Action</th>

                 </tr>
                 </thead>
                 <tbody>
                     @foreach($orders["pending"] as $order)
                         <tr>
                             <th scope="row" style="color:white;" class="liteLinks">{{$order->id}}</th>
                             <td style="color:white;" class="liteLinks">{{$order->product->productName}}</td>
                             <td style="color:white;" class="liteLinks">{{$order->quantity}}</td>
                             <td style="color:white;" class="liteLinks">{{$order->total}}</td>
                             <td style="color:white;" class="liteLinks">{{$order->user_profile[0]->user->username}}</td>

                             <td>
                                 <a href="{{route('adminOrderAction', ['id'=>$order->id, 'action'=>'approved'])}}" class="btn btn-orange">Accept</a>
                                 <a href="{{route('adminOrderAction', ['id'=>$order->id, 'action'=>'decline'])}}" class="btn btn-purple">Decline</a>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
             @endif
         </div>
     </div>
     <script>
         let pageId = document.getElementById('pending');
         pageId.className += " active";
     </script>
@endsection
