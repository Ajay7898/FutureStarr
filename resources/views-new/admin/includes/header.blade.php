<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Future Starr Admin | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Overpass" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/croppie.css')}}">
  <style type="text/css">

    .invalid-feedback {
       display: block !important;
    }

    .active{
      margin-top:0px !important;
    }

  </style>
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
  @yield('admin_page_head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- <div id="preloader"></div> -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
          Howdy, FutureStarr Customer Service &nbsp;&nbsp; <img src="{{ asset('assets/admin/dist/img/Rectangle 4.png')}}" alt="Admin Logo">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
         </form>
       </a>
     </li>
   </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link logo">

    <img src="{{ asset('assets/admin/dist/img/futurelogo.png') }}" alt="Admin Logo" class="img-responsive center-block">
    <span class=""></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li style="padding-left: 10px;" class="nav-item">
            <a style="font-size:14px !important;padding: 0.5rem 0.5rem;" href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard'  ? 'active' : '' }}">
             
              <p> DASHBOARD </p>
            </a>
          </li>
		  
		  <li style="background:black !important;padding-left: 10px;" class="nav-item has-treeview">
            <a style="font-size:14px;padding: 0.5rem 0.5rem;" href="#" class="nav-link bg-fu">
             
              <p>
                OPERATOR CONTROLS
                <i class="fas fa-caret-down right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a href="approve_disapprove.html" class="nav-link">
                 
                  <p></p>
                </a>
              </li>
             
            </ul>
          </li>

          <li style="border-bottom:1px solid #484545;" class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.pages'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.starr-search.categories'  ? 'menu-open' : '' }} || || {{ Route::currentRouteName() == 'admin.starr-search.edit'  ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link bg-fu {{ Route::currentRouteName() == 'admin.pages'  ? 'active' : '' }} " >
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pages
                <i class="fas fa-caret-right right"></i>  
              </p>
            </a>

            <ul class="nav nav-treeview">
              
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.pages') }}" class="nav-link {{ Route::currentRouteName() == 'admin.pages'  ? 'active' : '' }}">
                  <p>Approve/Disapprove Product</p>
                </a>
              </li>

              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.starr-search.categories') }}" class="nav-link {{ Route::currentRouteName() == 'admin.starr-search.categories'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'admin.starr-search.edit'  ? 'active' : '' }}">
                  <p>Starr Search</p>
                </a>
              </li>

            </ul>
          </li>

          <li style="border-bottom:1px solid #484545;" class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.blog'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.blog.create'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.blog.edit'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.create-tag'  ? 'menu-open' : '' }} ||  {{ Route::currentRouteName() == 'admin.tags'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.blog.comment'  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-copy"></i>
              <p>  Post <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview {{ Route::currentRouteName() == 'admin.blog'}} || { Route::currentRouteName() == 'admin.blog.edit'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.blog.comment'  ? 'active' : '' }}">
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.blog') }}" class="nav-link {{ Route::currentRouteName() == 'admin.blog'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'admin.blog.edit'  ? 'active' : '' }} ">
                  <p>Total Blog Post</p>
                </a> 
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.blog.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.blog.create'  ? 'active' : '' }}">
                  <p>Post New Blog</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.tags') }}" class="nav-link {{ Route::currentRouteName() == 'admin.tags'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'admin.create-tag'  ? 'active' : '' }}">
                  <p>Tags</p>
                </a>
              </li>

               <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.blog.comment') }}" class="nav-link  {{ Route::currentRouteName() == 'admin.blog.comment'  ? 'active' : '' }}">
                  <p>Blog Comments</p>
                </a>
              </li>

            </ul>
          </li>

          <li style="border-bottom:1px solid #484545;" class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.users'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.monthly-signup'  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-copy"></i>
              <p> Users <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.users') }}" class="nav-link {{ Route::currentRouteName() == 'admin.users'  ? 'active' : '' }}">
                  <p>All Users</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.monthly-signup') }}" class="nav-link {{ Route::currentRouteName() == 'admin.monthly-signup'  ? 'active' : '' }}">
                  <p>Monthly Signups</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="users_monthly_signup.html" class="nav-link">
                  <p>Monthly Visitors</p>
                </a>
              </li>

              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.change-password') }}" class="nav-link {{ Route::currentRouteName() == 'admin.change-password'  ? 'active' : '' }}">
                  <p>Change Password</p>
                </a>
              </li>

              <li class="nav-item ml-4 pl-2">
                <a href="users_monthly_signup.html" class="nav-link">
                  <p>User Acess</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.emails'  ? 'menu-open' : '' }} || {{ Route::currentRouteName() == 'admin.compose-email'  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Email
                <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.emails') }}" class="nav-link {{ Route::currentRouteName() == 'admin.emails'  ? 'active' : '' }}">

                  <p>Monthly Emails</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.compose-email') }}" class="nav-link {{ Route::currentRouteName() == 'admin.compose-email'  ? 'active' : '' }}">
                  <p>Compose Email</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="users_monthly_signup.html" class="nav-link">
                  <p>Monthly Visitors</p>
                </a>
              </li>
            </ul>
          </li>

          <li style="border-bottom:1px solid #484545;" class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.seo'  ? 'menu-open' : '' }} ||  {{ Route::currentRouteName() == 'admin.seo.setting'  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                SEO
                <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.seo') }}" class="nav-link {{ Route::currentRouteName() == 'admin.seo'  ? 'active' : '' }}">
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.seo.setting') }}" class="nav-link {{ Route::currentRouteName() == 'admin.seo.setting'  ? 'active' : '' }}">
                  <p>Settings</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.chat.support'  ? 'menu-open' : '' }} ||  {{ Route::currentRouteName() == 'admin.guest.chat.support'  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Support Chat
                <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a target="_blank" href="{{ route('admin.chat.support') }}" class="nav-link {{ Route::currentRouteName() == 'admin.chat.support'  ? 'active' : '' }}">
                  <p>User Chats</p>
                </a>
              </li>
              <li class="nav-item ml-4 pl-2">
                <a target="_blank" href="{{ route('admin.guest.chat.support') }}" class="nav-link {{ Route::currentRouteName() == 'admin.guest.chat.support'  ? 'active' : '' }}">
                  <p>Guest Chats</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.site.config'  ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link bg-fu">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Site Config
                <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item ml-4 pl-2">
                <a href="{{ route('admin.site.config') }}" class="nav-link {{ Route::currentRouteName() == 'admin.site.config'  ? 'active' : '' }}">
                  <p>Settings</p>
                </a>
              </li>
            </ul>
          </li>
		  
		  <li style="background:black !important;padding-left: 10px;" class="nav-item has-treeview">
            <a style="font-size:14px;padding: 0.5rem 0.5rem;" href="#" class="nav-link bg-fu">
             
              <p>
                DEVELOPER CONTROLS
                <i class="fas fa-caret-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4 pl-2">
                <a href="approve_disapprove.html" class="nav-link">
                 
                  <p></p>
                </a>
              </li>
             
            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
