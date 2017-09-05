<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MLM</b> Management System </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i>  Buat Nota <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @foreach($sidebar_menus as $submenu)
                    <li><a href="{{ URL::to('admin/invoice/' . $submenu->url_slug . '/add') }}"><i class="fa fa-file-text-o "></i>{{ $submenu->nama_mlm }}</a></li>
                    <li class="divider"></li>
                @endforeach
              </ul>
            </li>
            <li><a href="{{ route('shippingAddress') }}" id="cetak_alamat"><i class="fa fa-print"></i>  Cetak Alamat</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('indexMemberAll') }}"><i class="fa fa-users"></i>  Semua Member</a></li>
            <li><a href="{{ route('indexInvoiceAll') }}"><i class="fa fa-shopping-cart"></i>  Semua Penjualan</a>
            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-sign-out"></i>  Logout</a></li>
        </ul>
      </div>
        
    </nav>
</header>
