<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ ($menu == 'dashboard') ? 'active' : ''}}">
                <a href="#menu1" data-toggle="collapse" aria-expanded="{{ ($menu == 'dashboard') ? 'true' : 'false'}}" class="dropdown-toggle collapsed">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="submenu recent-submenu list-unstyled collapse {{ ($submenu == 'dashboard') ? 'show' : ''}}" id="menu1" data-parent="#accordionExample" style="">
                    <li class="{{ ($submenu == 'dashboard') ? 'active' : ''}}">
                        <a href="/dashboard"> Dashboard </a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ ($menu == 'table') ? 'active' : ''}}">
                <a href="#menu2" data-toggle="collapse" aria-expanded="{{ ($menu == 'table') ? 'true' : 'false'}}" class="dropdown-toggle collapsed">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        </svg>
                        <span>Master Data</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="submenu recent-submenu list-unstyled collapse {{ ($menu == 'table') ? 'show' : ''}}" id="menu2" data-parent="#accordionExample" style="">
                    <li class="{{ ($submenu == 'Input Rekap Posyandu') ? 'active' : ''}}">
                        <a href="/posyandu">Input Rekap Posyandu</a>
                    </li>
                    <li class="{{ ($submenu == 'Input Rekap Geografi') ? 'active' : ''}}">
                        <a href="/geografi">Input Rekap Geografi</a>
                    </li>
                    <li class="{{ ($submenu == 'Input Rekap Demografi') ? 'active' : ''}}">
                        <a href="/demografi">Input Rekap Demografi</a>
                    </li>
                    <li class="{{ ($submenu == 'Input Rekap Pembentukan') ? 'active' : ''}}">
                        <a href="/pembentukan">Input Rekap Pembentukan</a>
                    </li>
                    <li class="{{ ($submenu == 'Input Rekap Kepengurusan') ? 'active' : ''}}">
                        <a href="/kepengurusan">Input Rekap Kepengurusan</a>
                    </li>
                    <li class="{{ ($submenu == 'profile') ? 'active' : ''}}">
                        <a href="/profile"> Profil </a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

</div>