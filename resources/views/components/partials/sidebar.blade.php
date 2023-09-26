<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Arc Trading</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('admin.dashboard')}}">
                        <i class="fa-solid fa-earth-asia fa-spin"></i>
                        Dashboard
                    </a>
                </li>
                @if (Auth::user()->role_as=='2')
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('missions.index')}}">
                        <i class="fa-solid fa-earth-asia fa-spin"></i>
                        Missions
                    </a>
                </li>
                @endif
                <li class="nav-item">

                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        <i class="fa-solid fa-earth-asia fa-spin"></i> Vehicles
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li>
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('vehicles.index')}}">
                                    <i class="fa-solid fa-earth-asia fa-spin"></i>
                                    Assigned Vehicles
                                </a>
                            </li>
                            <li>
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                                    <i class="fa-solid fa-earth-asia fa-spin"></i>
                                    Maintanence reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('requested.index')}}">
                        <i class="fa-solid fa-earth-asia fa-spin"></i>
                        Requisitions
                    </a>
                </li>
            </ul>


        </div>
    </div>
</div>