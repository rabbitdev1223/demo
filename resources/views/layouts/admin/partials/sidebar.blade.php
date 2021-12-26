<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)">
            <i data-feather="settings"></i>
        </a>
        <img class="img-90 rounded-circle" id="side_img" src="{{$user_info['profile_photo_path'] ? asset('images/'.$user_info['profile_photo_path']) : asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary"></span></div>
        <a href="user-profile"> <h6 class="mt-3 f-14 f-w-600" id="side_fullname">{{ $user_info['name']}} {{ $user_info['surname'] }}</h6></a>
        <p class="mb-0 font-roboto" id="side_option"> {{ $user_info['option'] }}</p>
        <ul>
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
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/dashboard') }}" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>                  
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/dashboard') }};">
                            <li><a href="{{url('/home')}}" class="{{routeActive('index')}}">Default</a></li>
                            <li><a href="{{url('/home')}}" class="{{routeActive('dashboard-02')}}">Ecommerce</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/widgets') }}" href="javascript:void(0)"><i data-feather="airplay"></i><span>Widgets</span></a>
                        <ul class="nav-submenu menu-content"  style="display: {{ prefixBlock('/widgets') }};">
                            <li><a href="#" class="{{routeActive('general-widget')}}">General</a></li>
                            <li><a href="#" class="{{routeActive('chart-widget')}}">Chart</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Components</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/ui-kits') }}" href="javascript:void(0)"><i data-feather="box"></i><span>Ui Kits</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/ui-kits') }};">
                            <li><a href="#" class="{{routeActive('state-color')}}">State color</a></li>
                            <li><a href="#" class="{{routeActive('typography')}}">Typography</a></li>
                            <li><a href="#" class="{{routeActive('avatars')}}">Avatars</a></li>
                            <li><a href="#" class="{{routeActive('helper-classes')}}">helper classes</a></li>
                            <li><a href="#" class="{{routeActive('grid')}}">Grid</a></li>
                            <li><a href="#" class="{{routeActive('tag-pills')}}">Tag & pills</a></li>
                            <li><a href="#" class="{{routeActive('progress-bar')}}">Progress</a></li>
                            <li><a href="#" class="{{routeActive('modal')}}">Modal</a></li>
                            <li><a href="#" class="{{routeActive('alert')}}">Alert</a></li>
                            <li><a href="#" class="{{routeActive('popover')}}">Popover</a></li>
                            <li><a href="#" class="{{routeActive('tooltip')}}">Tooltip</a></li>
                            <li><a href="#" class="{{routeActive('loader')}}">Spinners</a></li>
                            <li><a href="#" class="{{routeActive('dropdown')}}">Dropdown</a></li>
                            <li><a href="#" class="{{routeActive('according')}}">Accordion</a></li>
                            <li>
                                <a class="submenu-title  {{ in_array(Route::currentRouteName(), ['tab-bootstrap','tab-material']) ? 'active' : '' }}" href="javascript:void(0)">
                                    Tabs<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span>
                                </a>
                                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['tab-bootstrap','tab-material']) ? 'block' : 'none' }};">
                                    <li><a href="#" class="{{routeActive('tab-bootstrap')}}">Bootstrap Tabs</a></li>
                                    <li><a href="#" class="{{routeActive('tab-material')}}">Line Tabs</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="{{routeActive('navs')}}">Navs</a></li>
                            <li><a href="#" class="{{routeActive('box-shadow')}}">Shadow</a></li>
                            <li><a href="#" class="{{routeActive('list')}}">Lists</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/bonus-ui') }}" href="javascript:void(0)"><i data-feather="folder-plus"></i><span>Bonus Ui</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/bonus-ui') }};">
                            <li><a href="#" class="{{routeActive('scrollable')}}">Scrollable</a></li>
                            <li><a href="#" class="{{routeActive('tree')}}">Tree view</a></li>
                            <li><a href="#" class="{{routeActive('bootstrap-notify')}}">Bootstrap Notify</a></li>
                            <li><a href="#" class="{{routeActive('rating')}}">Rating</a></li>
                            <li><a href="#" class="{{routeActive('dropzone')}}">dropzone</a></li>
                            <li><a href="#" class="{{routeActive('tour')}}">Tour</a></li>
                            <li><a href="#" class="{{routeActive('sweet-alert2')}}">SweetAlert2</a></li>
                            <li><a href="#" class="{{routeActive('modal-animated')}}">Animated Modal</a></li>
                            <li><a href="#" class="{{routeActive('owl-carousel')}}">Owl Carousel</a></li>
                            <li><a href="#" class="{{routeActive('ribbons')}}">Ribbons</a></li>
                            <li><a href="#" class="{{routeActive('pagination')}}">Pagination</a></li>
                            <li><a href="#" class="{{routeActive('steps')}}">Steps</a></li>
                            <li><a href="#" class="{{routeActive('breadcrumb')}}">Breadcrumb</a></li>
                            <li><a href="#" class="{{routeActive('range-slider')}}">Range Slider</a></li>
                            <li><a href="#" class="{{routeActive('image-cropper')}}">Image cropper</a></li>
                            <li><a href="#" class="{{routeActive('sticky')}}">Sticky </a></li>
                            <li><a href="#" class="{{routeActive('basic-card')}}">Basic Card</a></li>
                            <li><a href="#" class="{{routeActive('creative-card')}}">Creative Card</a></li>
                            <li><a href="#" class="{{routeActive('tabbed-card')}}">Tabbed Card</a></li>
                            <li><a href="#" class="{{routeActive('dragable-card')}}">Draggable Card</a></li>
                            <li>
                                <a class="submenu-title {{ in_array(Route::currentRouteName(), ['timeline-v-1','timeline-v-2']) ? 'active' : '' }}" href="javascript:void(0)">
                                    Timeline<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span>
                                </a>
                                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['timeline-v-1','timeline-v-2']) ? 'block' : 'none' }};">
                                    <li><a href="#" class="{{routeActive('timeline-v-1')}}">Timeline 1</a></li>
                                    <li><a href="#" class="{{routeActive('timeline-v-2')}}">Timeline 2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
