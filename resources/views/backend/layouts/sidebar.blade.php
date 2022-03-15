<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(Auth::guard('admin')->user()->avatar)}}" class="img-circle" alt="Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href=""><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i><span>Bảng điều khiển</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.manager.index')}}">
                    <i class="fa fa-user"></i><span>Quản lý Admin</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.banner.index')}}">
                    <i class="fa fa-sliders"></i><span>Quản lý Banner</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.category.index')}}">
                    <i class="fa fa-navicon"></i><span>Quản lý Danh mục</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.article.index')}}">
                    <i class="fa fa-newspaper-o"></i><span>Quản lý Tin tức</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.product.index')}}">
                    <i class="fa fa-list"></i><span>Quản lý Sản phẩm</span>
                </a>
            </li>

            <!-- <li class="">
                <a href="{{route('admin.color.index')}}">
                    <i class="fa fa-folder-open-o"></i><span>Quản lý Màu sắc</span>
                </a>
            </li> -->

            <!-- <li class="">
                <a href="{{route('admin.productColor.index')}}">
                    <i class="fa fa-folder-open-o"></i><span>Quản lý Màu sắc SP</span>
                </a>
            </li> -->

            <!-- <li class="">
                <a href="{{route('admin.size.index')}}">
                    <i class="fa fa-folder-open-o"></i><span>Quản lý Size</span>
                </a>
            </li> -->

            <!-- <li class="">
                <a href="{{route('admin.productSize.index')}}">
                    <i class="fa fa-folder-open-o"></i><span>Quản lý SL Size</span>
                </a>
            </li> -->

            <li class="">
                <a href="{{route('admin.user.index')}}">
                    <i class="fa fa-user-o"></i><span>Quản lý Khách hàng</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.order.index')}}">
                    <i class="fa fa-shopping-cart"></i><span>Quản lý Đơn hàng</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.contact.index')}}">
                    <i class="fa fa-comments-o"></i><span>Quản lý Liên hệ</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('admin.setting.index')}}">
                    <i class="fa  fa-gears"></i> Cấu hình website
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>



