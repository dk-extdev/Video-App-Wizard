<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{{ isset(Auth::guard('admin')->user()->name) ? Auth::guard('admin')->user()->name : Auth::guard('admin')->user()->email }}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!--form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <li class="treeview {{ Request::is('admin/createcustomer') || Request::is('admin/viewcustomer') ? 'menu-open active' : '' }}">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Customer</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/createcustomer') ? 'active' : '' }}"><a href="{{ route('admin_create_customer') }}"><i class="fa fa-circle-o"></i> Add New Customer</a></li>
          <li class="{{ Request::is('admin/viewcustomer') ? 'active' : '' }}"><a href="{{ route('admin_view_customer') }}"><i class="fa fa-circle-o"></i> View Customer</a></li>
        </ul>
      </li>
      <li class="{{ Request::is('admin/news') ? 'active' : '' }}">
        <a href="{{ route('admin_news') }}"><i class="fa fa-newspaper-o"></i> <span>News & Update</span></a>
      </li>
      <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
        <a href="{{ route('admin_category') }}"><i class="fa fa-tag"></i> <span>Category</span></a>
      </li>
      <li class="treeview {{ Request::is('admin/createtemplate') || Request::is('admin/viewtemplate') ? 'menu-open active' : '' }}">
        <a href="#">
          <i class="fa fa-file-archive-o"></i>
          <span>Template</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/createtemplate') ? 'active' : '' }}"><a href="{{ route('admin_create_template') }}"><i class="fa fa-circle-o"></i> Add New Template</a></li>
          <li class="{{ Request::is('admin/viewtemplate') ? 'active' : '' }}"><a href="{{ route('admin_view_template') }}"><i class="fa fa-circle-o"></i> View Template</a></li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/createtemplatevideos') || Request::is('admin/viewtemplatevideos') ? 'menu-open active' : '' }}">
        <a href="#">
          <i class="fa fa-file-archive-o"></i>
          <span>TemplateVideos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/createtemplatevideos') ? 'active' : '' }}"><a href="{{ route('admin_create_templatevideos') }}"><i class="fa fa-circle-o"></i> Add New Template Videos</a></li>
          <li class="{{ Request::is('admin/viewtemplatevideos') ? 'active' : '' }}"><a href="{{ route('admin_view_templatevideos') }}"><i class="fa fa-circle-o"></i> View Template Videos</a></li>
        </ul>
      </li>
      <li class="{{ Request::is('admin/emailtemplate') ? 'active' : '' }}">
        <a href="{{ route('admin_emailtemplate') }}"><i class="fa fa-envelope"></i> <span>Email Template</span></a>
      </li>
      <li class="{{ Request::is('admin/setting') ? 'active' : '' }}">
        <a href="{{ route('admin_setting') }}"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>