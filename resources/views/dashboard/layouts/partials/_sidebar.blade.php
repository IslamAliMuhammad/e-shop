<!-- Brand Logo -->
<a href="{{ route('dashboard.home.index') }}" class="brand-link">
    <img src="{{ asset('dashboard/img/logo/c-logo.png') }}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ __('COZA STORE') }}</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image ">
            <img src="{{ auth()->user()->getMedia()->isNotEmpty() ? auth()->user()->getMedia()[0]->getFullUrl('thumb') : asset('images/defaults/user.png') }}"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('profile.show') }}" target="_blank" class="d-block">{{ auth()->user()->full_name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('dashboard.home.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        {{ __('Home') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('profile.show') }}" class="nav-link" target="_blank">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>{{ __('Acount Settings') }}</p>
                </a>
            </li>

            @can('read users')
            <li class="nav-item">
                <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            @endcan

            @can('read categories')
            <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}"
                    class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        {{ __('Categories') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read subcategories')
            <li class="nav-item">
                <a href="{{ route('dashboard.subcategories.index') }}"
                    class="nav-link">
                    <i class="fas fa-stream"></i>
                    <p class="ml-2">
                        {{ __('Subcategories') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read brands')
            <li class="nav-item">
                <a href="{{ route('dashboard.brands.index') }}"
                    class="nav-link">
                    <i class="fas fa-store-alt"></i>
                    <p class="ml-1">
                        {{ __('Brands') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read discounts')
            <li class="nav-item">
                <a href="{{ route('dashboard.discounts.index') }}"
                    class="nav-link">
                    <i class="fas fa-tags"></i>
                    <p class="ml-1">
                        {{ __('Discounts') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read products')
            <li class="nav-item">
                <a href="{{ route('dashboard.products.index') }}"
                    class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p class="ml-1">
                        {{ __('Products') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read orders')
            <li class="nav-item">
                <a href="{{ route('dashboard.orders.index') }}"
                    class="nav-link">
                    <i class="fas fa-cash-register"></i>
                    <p class="ml-1">
                        {{ __('Orders') }}
                    </p>
                </a>
            </li>
            @endcan

            @can('read coupons')
            <li class="nav-item">
                <a href="{{ route('dashboard.coupons.index') }}"
                    class="nav-link">
                    <i class="fas fa-user-tag"></i>
                    <p class="ml-1">
                        {{ __('Coupons') }}
                    </p>
                </a>
            </li>
            @endcan

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
