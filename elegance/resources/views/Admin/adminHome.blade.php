@extends('Index')
@section('adminBody')
    <div class="row">
         <div class="col-lg-2" style="height:100vh!important;">
             <aside class="main-sidebar sidebar-dark-orange elevation-4">
                 <!-- Sidebar -->
                 <div class="sidebar">
                     <!-- Sidebar user panel (optional) -->
                     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                         <div class="info">
                             <a href="#" class="d-block liteLinks">{{Auth::user()->email}}</a>
                         </div>
                     </div>
                     <!-- Sidebar Menu -->
                     <nav class="mt-2">
                         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                             <li class="nav-item liteLinks menu-open" >
                                 <a href="#" class="nav-link">
                                     <i class="fa-brands fa-product-hunt"></i>
                                     <p>
                                         products
                                         <i class="right fas fa-angle-left"></i>
                                     </p>
                                 </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item liteLinks" >
                                     <a href="{{route('showProds')}}" class="nav-link" id="showProducts">
                                         <i class="fa-solid fa-gauge"></i>
                                         <p>
                                             show products
                                         </p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="fa-solid fa-pen-to-square"></i>
                                         <p style="margin-left:20px;">update products</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="fa-solid fa-delete-left"></i>
                                         <p style="margin-left:20px;">delete products</p>
                                     </a>
                                 </li>
                             </ul>
                             </li>
                             <li class="nav-item liteLinks">
                                 <a href="{{route('adminHome')}}" class="nav-link"  id="createProducts">
                                     <i class="far fa-plus-circle"></i>
                                     <p>create products</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="{{route('createCat')}}" class="nav-link" id="categoryLink">
                                     <i class="fa-solid fa-folder-tree"></i>
                                     <p>categories</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="{{route('getRequest')}}" class="nav-link" id="pending">
                                     <i class="fa-solid fa-bell"></i>
                                     <p>pending requests</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="{{route('getApprovedRequest')}}" class="nav-link" id="approved">
                                     <i class="fa-solid fa-thumbs-up"></i>
                                     <p>approved requests</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="{{route('getDeclinedRequest')}}" class="nav-link" id="decline">
                                     <i class="fa-solid fa-thumbs-down"></i>
                                     <p>declined requests</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="#" class="nav-link" id="showPosts">
                                     <i class="fal fa-newspaper"></i>
                                     <p>show posts</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" id="showPosts">
                                 <a href="#" class="nav-link" id="showPosts">
                                     <i class="fad fa-rss-square"></i>
                                     <p>create posts</p>
                                 </a>
                             </li>
                             <li class="nav-item liteLinks" >
                                 <a href="#" class="nav-link" id="Account">
                                     <i class="fad fa-user-circle"></i>
                                     <p>account</p>
                                 </a>
                             </li>

                         </ul>
                     </nav>
                     <!-- /.sidebar-menu -->
                 </div>
                 <!-- /.sidebar -->
             </aside>
         </div>
        <div class="col-lg-10">
            <section>
                <div class="container-fluid">
                    @yield('adminContent')
                </div>
            </section>
        </div>
    </div>
@endsection
