<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>กระดานแสดงผล</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.user')}}">
            <i class="fas fa-users"></i>
            <span><b>ผู้ใช้งาน</b></span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span><b>ช่างเทคนิค</b></span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.newtech')}}">New</a>
                <a class="collapse-item" href="{{route('admin.allTech')}}">Active</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.jobs')}}">
            <i class="fas fa-cog"></i>
            <span><b>จัดการงาน</b></span></a>
    </li>
    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.jobtype')}}">
            <i class="far fa-edit"></i>
            <span><b>แก้ไขประเภทงาน</b></span></a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>