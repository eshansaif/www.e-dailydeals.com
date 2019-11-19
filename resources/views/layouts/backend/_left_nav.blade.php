<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="index-2.html"><img src="{{asset('assets/backend/images/logo.png')}}" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="index-2.html"><img src="{{asset('assets/backend/images/logo_icon.png')}}" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="{{asset('assets/backend/images/photos/user-avatar.png')}}" class="media-object">
                <div class="media-body">
                    <h4><a href="#">John Doe</a></h4>
                    <span>"Hello There..."</span>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class=" "><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                {{--<ul class="sub-menu-list">
                    <li><a href="index_alt.html"> Dashboard 1</a></li>

                </ul>--}}
            </li>
            @if(\Illuminate\Support\Facades\Session::get(adminDetails)['type']=="Admin")
            <li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>Admin</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('admin.create') }}"> Add Admin</a></li>
                    <li><a href="{{ route('admin.index') }}"> View Admins</a></li>

                </ul>
            </li>
            @endif

            <li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>Customers</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('admin.customer.view') }}"> View Customers</a></li>

                </ul>
            </li>

            @if(\Illuminate\Support\Facades\Session::get(adminDetails)['categories_access']==1)
            <li class="menu-list"><a href="#"><i class="fa fa-list-alt"></i> <span>Categories</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('category.create') }}"> Add Categories</a></li>
                    <li><a href="{{ route('category.index') }}"> View Category List</a></li>

                </ul>
            </li>

            <li class="menu-list"><a href="#"><i class="fa fa-list-alt"></i> <span>Sub-Categories</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('sub_category.create') }}"> Add Sub-Categories</a></li>
                    <li><a href="{{ route('sub_category.index') }}"> View Sub-Category List</a></li>

                </ul>
            </li>
            @endif

            <li class="menu-list"><a href="#"><i class="fa fa fa-bitbucket"></i> <span>Brands</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('brand.create') }}"> Add Brands</a></li>
                    <li><a href="{{ route('brand.index') }}"> View Brand List</a></li>

                </ul>
            </li>
            @if(\Illuminate\Support\Facades\Session::get(adminDetails)['products_access']==1)
            <li class="menu-list"><a href="#"><i class="fa fa-product-hunt"></i> <span>Products</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('product.create') }}"> Add Product</a></li>
                    <li><a href="{{ route('product.index') }}"> View Product List</a></li>

                </ul>
            </li>
            @endif
            @if(\Illuminate\Support\Facades\Session::get(adminDetails)['type']=="Admin")
            <li class="menu-list"><a href="#"><i class="fa fa-percent"></i> <span>Coupons</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('coupon.create') }}"> Add Coupon</a></li>
                    <li><a href="{{ route('coupon.index') }}"> View Coupons</a></li>

                </ul>
            </li>
            @endif

            <li class="menu-list"><a href="#"><i class="fa fa-first-order"></i> <span>Customer Orders</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('order.index') }}"> View Orders</a></li>

                </ul>
            </li>

            <li class="menu-list"><a href="#"><i class="fa fa-hand-stop-o"></i> <span>Newsletter Subscriber</span></a>
                <ul class="sub-menu-list">
                    <li><a href="{{ route('subscriber.index') }}"> View Subscriber</a></li>

                </ul>
            </li>

            <li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>Blog</span></a>
                <ul class="sub-menu-list">
                    {{--<li><a href="{{ route('admin.create') }}">Add Posts</a></li>--}}
                    <li><a href="{{ route('post.index') }}"> View Post</a></li>

                </ul>
            </li>



            <li class="menu-list"><a href="#"><i class="fa fa-laptop"></i> <span>Settings</span></a>
                <ul class="sub-menu-list">
                    <li><a href="blank_page.html"> Blank Page</a></li>
                    <li><a href="boxed_view.html"> Boxed Page</a></li>
                    <li><a href="leftmenu_collapsed_view.html"> Sidebar Collapsed</a></li>
                    <li><a href="horizontal_menu.html"> Horizontal Menu</a></li>

                </ul>
            </li>

            <li><a href="login.html"><i class="fa fa-sign-in"></i> <span>Login Page</span></a></li>

        </ul>
        <!--sidebar nav end-->

    </div>
</div>
    