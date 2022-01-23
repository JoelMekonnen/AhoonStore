@extends('Admin.adminHome')
@section('adminContent')
    <div class="row justify-content-center" style="margin-top:5% !important;">
        <h1 class="firstHead" style="color:white;"> Declined Orders</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(count($orders["failed"]) == 0)
                <hr style="border-color:white !important;"/>
                <h3 class="firstHead" style="color:lightblue">No Declined Orders</h3>
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
                        <th scope="col" class="myfonts" style="color:white;font-size:20px;">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders["failed"] as $order)
                        <tr>
                            <th scope="row" style="color:white;" class="liteLinks">{{$order->id}}</th>
                            <td style="color:white;" class="liteLinks">{{$order->product->productName}}</td>
                            <td style="color:white;" class="liteLinks">{{$order->quantity}}</td>
                            <td style="color:white;" class="liteLinks">{{$order->total}}</td>
                            <td style="color:white;" class="liteLinks">{{$order->user_profile[0]->user->username}}</td>
                            <td style="color:red;" class="liteLinks">Declined</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <script>
        let pageId = document.getElementById('decline');
        pageId.className += " active";
    </script>
@endsection
