
    <nav class="sb-sidenav accordion" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="admin" id="dashboard" title="Bảng điều khiển">
                    <div class="sb-nav-link-icon"> <i class="fas fa-tachometer-alt"></i> </div>
                    <span>Bảng điều khiển</span>
                </a>
                <a class="nav-link" href="admin/account" title="Quản lý admin">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-user-lock"></i> </div>
                    <span>Quản lý admin</span>
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#permission" title="Quản lý quyền">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-users-gear"></i> </div>
                    <span>Quản lý quyền</span>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse collapseIcon" id="permission" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admin/permission">Nhóm quyền</a>
                        <a class="nav-link" href="admin/permission/role">Quản lý quyền</a>
                        <a class="nav-link" href="admin/permission/model">Vai trò & người dùng</a>
                    </nav>
                </div>
                <a class="nav-link" href="admin/product" title="Quản lý sản phẩm">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-box-open"></i></div>
                    <span>Quản lý sản phẩm</span>
                </a>
                <a class="nav-link" href="admin/group-product" title="Quản lý danh mục SP">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-table-list"></i> </div>
                    <span>Quản lý danh mục SP</span>
                </a>
                <a class="nav-link" href="admin/group-tag" title="Quản lý danh mục thẻ">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-tags"></i> </div>
                    <span>Quản lý danh mục thẻ</span>
                </a>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setups" title="Cấu hình">
                    <div class="sb-nav-link-icon"> <i class="fa-solid fa-gears"></i> </div>
                    <span>Cấu hình</span>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse collapseIcon" id="setups" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admin/set_home">Cài đặt trang chủ</a>
                        @for ($i = 0; $i < 5; $i++)
                            <a class="nav-link" href="admin/set_home{{ $i }}">Cài đặt trang chủ {{ $i }}</a>
                        @endfor
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{ auth()->guard('admin')->user()->name }}</div>
            {{ auth()->guard('admin')->user()->email }}
        </div>
    </nav>

