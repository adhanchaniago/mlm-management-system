<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('admin/perusahaan') ? 'active' : '' }}"><a href="{{ URL::to('admin/perusahaan') }}"><i class='fa fa-user'></i> <span>Perusahaan MLM</span></a></li>
            {{-- <li><a href="{{ URL::to('admin/' . $menu->url_slug) }}"><i class='fa fa-link'></i> {{ $menu->nama_mlm }}<span>  </span></a></li> --}}
            @foreach($sidebar_menus as $menu)
            <li class="treeview {{ Request::is('admin/*/' . $menu->url_slug . "*") ? 'active' : '' }}">
                <a href="#"><i class="fa fa-circle-o-notch"></i> <span>{{ $menu->nama_mlm }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                    <li class = "{{ Request::is('admin/member/' . $menu->url_slug . "*") ? 'active' : '' }}"><a href="{{ URL::to('admin/member/' . $menu->url_slug) }}"><i class='fa fa-circle-o'></i><span>Data Member</span></a></li>
                    <li class = "{{ Request::is('admin/produk/' . $menu->url_slug . "*") ? 'active' : '' }}"><a href="{{ URL::to('admin/produk/' . $menu->url_slug) }}"><i class="fa fa-circle-thin"></i><span>Data Produk</span></a></li>
                    <li class="treeview {{ Request::is('admin/invoice/' . $menu->url_slug . '*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-circle-thin"></i> <span>Invoice</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('admin/invoice/' . $menu->url_slug . '/add') ? 'active' : '' }}"><a href="{{ URL::to('admin/invoice/' . $menu->url_slug . '/add') }}"><i class="fa fa-dot-circle-o"></i> Buat Nota</a></li>
                            <li class="{{ Request::is('admin/invoice/' . $menu->url_slug ) ? 'active' : '' }}"><a href="{{ URL::to('admin/invoice/' . $menu->url_slug) }}"><i class="fa fa-dot-circle-o"></i> Data Penjualan</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endforeach
            <li class="header">History</li>
            <li class="{{ Request::is('admin/member') ? 'active' : '' }}"><a href="{{ route('indexMemberAll') }}"><i class='fa fa-users'></i> <span>Semua Member</span></a></li>
            <li class="{{ Request::is('admin/invoice') ? 'active' : '' }}"><a href="{{ route('indexInvoiceAll') }}"><i class='fa fa-shopping-cart'></i> <span>Semua Penjualan</span></a></li>
            <li class="{{ Request::is('admin/pengiriman') ? 'active' : '' }}"><a href="{{ route('indexPengiriman') }}"><i class='fa fa-history'></i> <span>Semua Transaksi</span></a></li>
            <li class="{{ Request::is('admin/pembayaran') ? 'active' : '' }}"><a href="{{ route('indexPembayaran') }}"><i class='fa fa-money'></i> <span>Tagihan Pembayaran</span></a></li>
            <li class="{{ Request::is('admin/importExport') ? 'active' : '' }}"><a href="{{ route('indexImportExport') }}"><i class='fa fa-money'></i> <span>Import Export Data</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
