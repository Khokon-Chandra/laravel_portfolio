    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-th"></i></a> </li> 
                     <li class="nav-item mt-3">ADMIN</li>
					</ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item"><a href="#" class="btn btn-sm btn-danger">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar bg-danger">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>

                        <li> <a href="{{url('/admin')}}" ><span><i class="fas fa-home" aria-hidden="true"></i></span><span class="hide-menu">Home</span></a></li>

                        <li> <a href="{{url('/admin/visitors')}}" ><span> <i class="fas fa-users"></i> </span><span class="hide-menu">Visitor</span></a></li>

                    	<li> <a href="{{url('/admin/services')}}" ><span> <i class="fas fa-desktop"></i> </span><span class="hide-menu">Services</span></a></li>

                    	<li> <a href="{{url('/admin/courses')}}" ><span> <i class="fas fa-university"></i> </span><span class="hide-menu">Courses</span></a></li>

                    	<li> <a href="{{url('/admin/projects')}}" ><span> <i class="fas fa-folder-open"></i> </span><span class="hide-menu">Projects</span></a></li>

                    	<li> <a href="{{url('/admin/blog')}}" ><span> <i class="fas fa-file-word"></i> </span><span class="hide-menu">Post</span></a></li>

                    	<li> <a href="{{url('/admin/reviews')}}" ><span> <i class="fas fa-comments"></i> </span><span class="hide-menu">Reviews</span></a></li>


					</ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">