<header class="main-header">
    <!-- Logo -->
    <a href="/backend/index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Clothes Store</b> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset(Auth::guard('admin')->user()->avatar)}}" class="user-image" alt="">
                        <span class="hidden-xs">{{Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset(Auth::guard('admin')->user()->avatar)}}" class="img-circle" alt="User Image">

                            <p>
                               {{Auth::guard('admin')->user()->name}}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- <div class="pull-left"> -->
                              <!-- <a href="" class="btn btn-default btn-flat">Thông tin</a> -->
                            <!-- </div>   -->
                            <!-- <div class="pull-right"> -->
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                            <!-- </div> -->
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                
            </ul>
        </div>
    </nav>
</header>
