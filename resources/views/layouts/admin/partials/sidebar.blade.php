
<header class="main-nav">
    <div class="sidebar-user text-center">
        <!-- <a class="setting-primary" href="javascript:void(0)">
            <i data-feather="settings"></i>
        </a> -->
        <img class="img-90 rounded-circle"
            onerror="onErrorImage(this)" 
            src="{{asset('uploads/' . Auth::user()->profile) }}" alt="" />
        <a href="user-profile"> <h6 class="mt-3 f-14 f-w-600">{{Auth::user()->name}}</h6></a>
        <p class="mb-0 font-roboto">@if(Auth::user()->role == 1)
                                                {{''}}	
                                                @elseif(Auth::user()->type ==1)
														allevatore
													@elseif(Auth::user()->type ==2)
														appassionato
													@endif</p>
        <!-- <ul>
            <li>
                <span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
            </li>
            <li>
                <span>2 year</span>
                <p>Experince</p>
            </li>
            <li>
                <span><span class="counter">95.2</span>k</span>
                <p>Follower</p>
            </li>
        </ul> -->
    </div>
    <nav>
    <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    
                    @if(Auth::user()->role==1)
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('user') }}" href="javascript:void(0)"><i data-feather="users"></i><span>User</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('user') }};">
                            <li><a href="{{ route('user.create') }}" class="{{routeActive('user.create')}}">Add User</a></li>
                            <li><a href="{{ route('user.index') }}" class="{{routeActive('user.index')}}">User List</a></li>
                       
                        </ul>
                    </li>
                    @endif
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('parrot') }}" href="javascript:void(0)"><i data-feather="users"></i><span>Parrot</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('parrot') }};">
                            <li><a href="{{ route('parrot.create') }}" class="{{routeActive('parrot.create')}}">Add parrot</a></li>
                            <li><a href="{{ route('user.index') }}" class="{{routeActive('user.index')}}">My parrots</a></li>
                       
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ routeActive('profile.show') }}" href="{{ route('profile.show') }}"><i data-feather="users"></i><span>My Profile</span></a>
                        
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
