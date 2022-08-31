<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="mb-3 w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{ route('dashboard') }}">
                    <img class="img-fluid" src="{{ asset('assets/images/visidata/logo-full.png') }}" alt=""
                        style="height: 40px;">
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        {{-- <div class="left-header col horizontal-wrapper ps-0">

    </div> --}}
        <div class="nav-right col-9 pull-right right-header p-0" style="margin-left: 250px;">
            <ul class="nav-menus">
                <div class="time" style="margin-right: 25px;text-align: right">

                    <span class="hms"></span>
                    <span class="ampm"></span>
                    <br>
                    <span class="date"></span>
                </div>
                <script>
                    function updateTime() {
                        var dateInfo = new Date();
                        /* time */
                        var hr,
                            _min = (dateInfo.getMinutes() < 10) ? "0" + dateInfo.getMinutes() : dateInfo.getMinutes(),
                            sec = (dateInfo.getSeconds() < 10) ? "0" + dateInfo.getSeconds() : dateInfo.getSeconds(),
                            ampm = (dateInfo.getHours() >= 12) ? "PM" : "AM";
                        // replace 0 with 12 at midnight, subtract 12 from hour if 13–23
                        if (dateInfo.getHours() == 0) {
                            hr = 12;
                        } else if (dateInfo.getHours() > 12) {
                            hr = dateInfo.getHours() - 12;
                        } else {
                            hr = dateInfo.getHours();
                        }
                        var currentTime = hr + ":" + _min + ":" + sec;
                        // print time
                        document.getElementsByClassName("hms")[0].innerHTML = currentTime;
                        document.getElementsByClassName("ampm")[0].innerHTML = ampm;
                        /* date */
                        var dow = [
                                "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"
                            
                            ],
                            month = [
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                              
                            ],
                            day = dateInfo.getDate();
                        // store date
                        var currentDate = dow[dateInfo.getDay()] + ", " + day + " " + month[dateInfo.getMonth()]  ;
                        document.getElementsByClassName("date")[0].innerHTML = currentDate;
                    };
                    // print time and date once, then update them every second
                    updateTime();
                    setInterval(function() {
                        updateTime()
                    }, 1000);
                </script>

                {{-- <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li> --}}
                <li class="profile-nav onhover-dropdown p-0 me-0" >
                    <div class="media profile-media" style="width: 90px">
                        <img class="b-r-12" style="width:55px; height:55px" src="{{ asset('assets/images/visidata/profile.png') }}" alt="">
                        <div class="media-body">
                       
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div" >
                        <li><a href="{{ route('profile.index', Auth()->user()->id) }}"><i
                                    data-feather="user"></i><span>View Profile</span></a></li>
                        @if (Auth()->user()->role_id == 1)
                            <li><a href="{{ route('user.index') }}"><i data-feather="users"></i><span>User
                                        Management</span></a></li>
                            <li><a href="{{ route('menu.index') }}"><i data-feather="menu"></i><span>Menu
                                    </span></a>
                            </li>
                            <li><a href="{{ route('role.index') }}"><i data-feather="git-pull-request"></i><span>User
                                        Role </span></a></li>
                            <li><a href="{{ route('log.index') }}"><i data-feather="settings"></i><span>Log Data
                                    </span></a></li>
                        @endif
                        <li><a id="changepass"><i data-feather="lock"></i><span>Ubah Password </span></a></li>
                        {{-- data-bs-toggle="modal" data-original-title="test" data-bs-target="#changepass" --}}
                        <form id="logout_form" action="{{ route('core.logout') }}" method="POST">
                            @csrf
                            <li>
                                <a href="#" onclick="onlogoutclicked()">
                                    <span>Logout</span>
                                </a>
                            </li>
                        </form>
                        <script>
                            function onlogoutclicked() {
                                $('#logout_form').submit()
                            }
                        </script>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
