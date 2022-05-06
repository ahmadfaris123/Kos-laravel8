<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <!-- User Profile-->
            <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu</span></li>
            <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark" href="/dashboard" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard </span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark" href="/kamar" aria-expanded="false"><i class="bi bi-building"></i><span class="hide-menu">Kamar </span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark" href="/penghuni" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Penghuni </span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark" href="/pembayaran" aria-expanded="false"><i class="bi bi-cash-stack"></i><span class="hide-menu">Pembayaran </span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark" href="/selesai" aria-expanded="false"><i class="bi bi-check-square-fill"></i><span class="hide-menu">Pembayaran Lunas </span></a></li>
            <li class="nav-devider"></li>
            <li class="sidebar-item">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Log Out</span></button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
<!-- Bottom points-->
<div class="sidebar-footer">

</div>