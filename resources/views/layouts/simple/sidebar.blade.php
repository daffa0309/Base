    <div class="sidebar-wrapper">
        <div>
            <div class="logo-wrapper">
                <a href="{{route('dashboard')}}">
                    <img class="img-fluid for-light" src="{{asset('assets/images/visidata/logo-full.png')}}" alt="" width="200">
                </a>
                <div class="back-btn">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="toggle-sidebar">
                    <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                </div>
            </div>
            <div class="logo-icon-wrapper">
                <a href="{{route('dashboard')}}">
                    <img class="img-fluid" src="{{asset('assets/images/visidata/logo-only.png')}}" alt="" width="25">
                </a>
            </div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <a href="{{route('dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6 class="lan-1">Navigation </h6>
                                {{-- <p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p> --}}
                            </div>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='dashboard' ? 'active' : '' }}" href="{{route('dashboard')}}">
                                <i data-feather="home"> </i><span>Dashboard</span>
                            </a>
                        </li>

                        {{-- looping menu disini --}}
                        @foreach ($menus as $menu)
                            <?php
                                $exist = acthelper($menu);
                            ?>
                            @if ($menu->childs->count() > 0)
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title {{ $exist != null ? 'active' : '' }}" href="#">
                                        <i data-feather="{{ $menu->icon }}"></i><span>{{$menu->name}}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{ $exist != null ? 'down' : 'right' }}"></i></div>
                                        {{-- {{actmenuone($menu->name) }} --}}
                                    </a>
                                    <ul class="sidebar-submenu" style="display: {{ $exist != null ? 'block' : 'none' }}">
                                        @foreach (App\Models\Menus::with('childs')->where('parent_id', $menu->id)->whereHas('menuroles', function ($q){
                                            $q->where('roles_id', Auth()->user()->role_id);
                                        })->where('hide', 0 )->orderBy('no', 'asc')->get() as $submenu)
                                            @if ($submenu->childs->count() > 0 )
                                                <li>
                                                    <a class="submenu-title {{ $exist != null && $exist[0] == $submenu->id ? 'active' : '' }}" href="#">
                                                        {{ $submenu->name }}
                                                        <div class="according-menu"><i class="fa fa-angle-{{ $exist != null && $exist[0] == $submenu->id ? 'down' : 'right' }}"></i></div>
                                                    </a>
                                                    <ul class="nav-sub-childmenu submenu-content" style="display: {{ $exist != null && $exist[0] == $submenu->id ? 'block' : 'none' }};">
                                                        @foreach (App\Models\Menus::with('childs')->where('parent_id', $submenu->id)->whereHas('menuroles', function ($q){
                                                            $q->where('roles_id', Auth()->user()->role_id);
                                                        })->where('hide', 0 )->orderBy('no', 'asc')->get() as $submenu1)
                                                            @if ($submenu1->childs->count() > 0)
                                                                <p>YES</p>
                                                            @else
                                                                <li class="sidebar-list">
                                                                    <a class="submenu-title {{ $exist != null && $exist[0] == $submenu->id && $exist[1] == $submenu1->id ? 'active' : '' }}" href="{{ url($submenu1->url) }}">
                                                                        {{ $submenu1->name }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="sidebar-list">
                                                    <a class=" submenu-title {{ $exist != null && $exist[0] == $submenu->id ? 'active' : '' }}" href="{{ url($submenu->url) }}">
                                                        {{ $submenu->name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="sidebar-list">
                                    {{-- {{ request()->path() == $menu->url ? 'active' : '' }} --}}
                                    <a class="sidebar-link sidebar-title link-nav {{ $exist != null ? 'active' : '' }}" href="{{ url($menu->url) }}">
                                        <i data-feather="{{ $menu->icon }}"> </i><span>{{ $menu->name }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        {{-- close looping menu disini --}}

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    </div>
