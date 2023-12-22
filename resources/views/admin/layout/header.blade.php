<nav class="sb-topnav navbar navbar-expand">
    <a class="navbar-brand ps-3" href="/">Start Bootstrap</a>
    <div class="d-flex justify-content-between w-100">

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars fs-5"></i>
        </button>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="min-width: 200px;">
                    <div class="d-flex flex-column justify-content-center align-items-center mt-2">

                        @if (File::exists('storage/' . auth()->guard('admin')->user()->avatar) && auth()->guard('admin')->user()->avatar != null)
                            <img src="storage/{{ auth()->guard('admin')->user()->avatar }}" class="img-table rounded-circle" alt="image" style="width: 60%;">
                        @else
                            <div style="font-size: 40px">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                        @endif
                        <p class="fw-bold">{{ auth()->guard('admin')->user()->name }}</p>
                    </div>
                    <li>
                        <a class="dropdown-item" href="admin/account/password">
                        <i class="fa-solid fa-key"></i> Mật khẩu</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#!"> <i class="fa-solid fa-gear"></i> Settings</a>
                    </li>

                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item" href="admin/logout"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
</div>

</nav>
