<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="container h-full content-topbar flex-sb-m">
                <div class="left-top-bar">
                    {{ __('Welcome To Coza Store') }}
                </div>

                <div class="h-full right-top-bar flex-w">

                    <a href="{{ route('profile.show') }}" target="_blank" class="flex-c-m trans-04 p-lr-25">
                        {{ __('Account Settings') }}
                    </a>

                    <ul class="flex flex-row">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="flex-c-m trans-04 p-lr-25">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    @auth
                    <a href="{{ route('profile.show') }}" target="_blank" class="flex-c-m trans-04 p-lr-25">
                        {{ auth()->user()->fullName }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-link">{{ __('Logout') }}</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                        {{ __('Login') }}
                    </a>

                    <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                        {{ __('Register') }}
                    </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Navbar --}}
        <div class="wrap-menu-desktop how-shadow1">
            <nav class="container limiter-menu-desktop">

                <!-- Logo desktop -->
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('client/images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ url()->current() == route('home') ?  'active-menu' : ''}}">
                            <a href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="{{ url()->current() == route('products.index') ?  'active-menu' : ''}}">
                            <a href="{{ route('products.index') }}">{{ __('Shop') }}</a>
                        </li>

                        <li class="{{ url()->current() == route('cart_items.index') ?  'active-menu' : ''}}">
                            <a href="{{ route('cart_items.index') }}">{{ __('Shopping Cart') }}</a>
                        </li>

                        <li class="{{ url()->current() == route('blog') ?  'active-menu' : ''}}">
                            <a href="{{ route('blog') }}">{{ __('Blog') }}</a>
                        </li>

                        <li class="{{ url()->current() == route('about') ?  'active-menu' : ''}}">
                            <a href="{{ route('about') }}">{{ __('About') }}</a>
                        </li>

                        <li class="{{ url()->current() == route('contact.index') ?  'active-menu' : ''}}">
                            <a href="{{ route('contact.index') }}">{{ __('Contact') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">

                    {{-- Search Icon --}}
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    {{-- CartItems Icon --}}
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ $cartItemsCount }}">
                        <a href="{{ route('cart_items.index') }}"><i class="zmdi zmdi-shopping-cart"></i></a>
                    </div>

                    <livewire:whishlist-icon >
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="{{ asset('client/images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    {{ __('Welcome To Coza Store') }}
                </div>
            </li>

            <li>
                <div class="h-full right-top-bar flex-w">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        {{ __('Help & FAQs') }}
                    </a>

                    <a href="{{ route('profile.show') }}" target="_blank" class="flex-c-m p-lr-10 trans-04">
                       {{ __(' My Account') }}
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    @auth
                    <a href="{{ route('profile.show') }}" target="_blank" class="flex-c-m trans-04 p-lr-25">
                        {{ auth()->user()->fullName }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-link">{{ __('Logout') }}</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                        {{ __('Login') }}
                    </a>

                    <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                        {{ __('Register') }}
                    </a>
                    @endauth
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>

            <li>
                <a href="{{ route('products.index') }}">{{ __('Shop') }}</a>
            </li>

            <li>
                <a href="{{ route('cart_items.index') }}">{{ __('Shopping Carts') }}</a>
            </li>

            <li>
                <a href="{{ route('blog') }}">{{ __('Blog') }}</a>
            </li>

            <li>
                <a href="{{ route('about') }}">{{ __('About') }}</a>
            </li>

            <li>
                <a href="{{ route('contact.index') }}">{{ __('Contact') }}</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('client/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" method="GET" action="{{ route('search') }}">
                @csrf
                <button class="flex-c-m trans-04" type="submits">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
