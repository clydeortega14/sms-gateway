 <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/dashboard">
                        <!-- Logo icon -->
                        <b><img src="images/new-logo.png" style="height: 50px; width: 68px;" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                         <span ><b class="h-title">SMS-Gateway</b></span> 
                    </a>
                </div>
                <!-- End Logo -->
                <!--Collapse Icon-->
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- User profile and search -->
                     <!-- Profile -->
                    <ul class="navbar-nav my-lg-0">

                        <li class="nav-item dropdown">
                            @if(auth()->user()->information_id == null)
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/new-logo.png" alt="user" class="profile-pic" /></a>
                            @else

                                @if(auth()->user()->informations->image == null)
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/new-logo.png" alt="user" class="profile-pic"/></a>
                                @else
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('storage/uploads/'.auth()->user()->informations->image) }}" alt="user" class="profile-pic" /></a>
                                @endif
                            @endif

                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">

                                    {{-- <li><a href="{{ url('/upload-image') }}"><i class="ti-upload"></i> Upload Image</a></li> --}}
                                    <li><a href="/view-user-profile"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!--End of Profile-->
                </div>
                <!--End Collapse Icon-->
            </nav>
        </div>