<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route('admin_index')}}"
                class="nav-link {{Request::url() === route('admin_index')? "active":""}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin_kategori_get')}}"
                class="nav-link {{strpos(Request::url(), 'kategori') !== false? "active":""}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Item / Produk
                </p>
            </a>
        </li>
    </ul>
</nav>
