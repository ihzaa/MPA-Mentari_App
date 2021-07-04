<style>
    :root {
        --color: #ffffff;
        --hover: rgb(236, 236, 236);
        --primarycolor: rgb(16, 173, 244);
    }

    body {
        min-height: 100%;
        padding-top: 80px;
    }

    .navbar {
        background-image: linear-gradient(rgb(16, 173, 244), rgb(73, 185, 233));
        z-index: 5000;
    }

    /* .search {
        width: 25%;
    } */

    .search-group {
        width: 90%;
    }

    .authNav {
        border-left: solid 1px white;
        padding-left: 10px;
    }

    .authButton {
        font-size: 12px !important;
    }

    .authButton:hover {
        color: var(--primarycolor) !important;
    }

    .kategori {
        cursor: pointer;
        margin-right: 30px;
        margin-top: auto;
        margin-bottom: auto;
        font-size: 14px !important;
    }

    .shopping-cart {
        cursor: pointer;
        margin-right: 30px;
        margin-top: auto;
        margin-bottom: auto;
        font-size: 14px !important;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: var(--color);
    }

    /* .shopping-cart:hover {
    border-bottom: 1px solid lightgreen;
} */
    .shopping-cart:hover span {
        color: var(--hover);
    }

    #search {
        border-color: lightgrey;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    #search:focus {
        border-left-color: lightgrey;
        border-top-color: lightgrey;
        border-bottom-color: lightgrey;
        border-right-color: none;
        box-shadow: none !important;
        outline: none !important;
    }

    #searchButton {
        border-color: lightgrey;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
        border-left: 0;
        background-color: var(--color);
    }

    @media only screen and (max-width: 990px) {
        body {
            padding-top: 120px !important;
        }

        .logo {
            width: 190px;
        }

        .search {
            width: 100%;
        }

        .search-group {
            width: 100%;
        }

        .kategori {
            /* margin-left: auto !important;
        margin-right: auto !important;
        margin-top: 20px; */
            margin: auto !important;
            position: relative;
        }

        .shopping-cart {
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .shopping-cart span {
            font-size: 18px;
        }

        .authNav {
            border-left: 0;
            margin-left: auto;
            margin-right: auto;
            padding-left: 0;
            font-size: 18px;
        }

        .userNav {
            border-left: 0;
            margin: auto !important;
            padding-left: 0;
            font-size: 18px;
        }

        .col-7 {
            flex-basis: 80% !important;
            max-width: 80% !important;
        }
    }

</style>

<nav class="navbar navbar-expand-lg px-5 fixed-top navbar-dark bg-info">
    <a class="navbar-brand font-semibold" href="#">
        <img class="logo" src="default/Logo-mentari.png" alt="Logo" />
    </a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-collapse"
        aria-controls="nav-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- @if (str_contains(Route::currentRouteName(), 'home') || str_contains(Route::currentRouteName(), 'promo')) --}}
    <form method="POST" action="">
        <div class="search">
            <div class="search-group input-group mx-auto">
                <input id="search" class="form-control form-control-lg" placeholder="Search">
                <div class="input-group-append">
                    <button id="searchButton" type="button" class="btn btn-light">
                        <i class="fas fa-search" style="color:var(--primarycolor);width: 20px; height: 20px">
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    {{-- @endif --}}
    <!-- </b-nav-form> -->

    <div class="collapse navbar-collapse" id="nav-collapse">
        <ul class="navbar-nav ml-auto mr-4">
            <li class="shopping-cart nav-item">
                <a class="nav-link" href="#">
                    <span>
                        <strong>Home</strong>
                    </span>
                </a>
            </li>
            <li class="shopping-cart nav-item">
                <a class="nav-link" href="#">
                    <span>
                        <strong>Promo</strong>
                    </span>
                </a>
            </li>
            {{-- @if (str_contains(Route::currentRouteName(), 'home')) --}}
            <li class="kategori shopping-cart nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span>
                        <strong>Kategori</strong>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#">
                            Semua Produk
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item disabled">
                            {{-- v-if="categoriesCount == 0"> --}}
                            Tidak ditemukan
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            {{-- {{ category . name }} --}}isi kategori
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @endif --}}
            <li class="shopping-cart nav-item">
                <a class="nav-link" href="#">
                    <span>
                        <strong>
                            Keranjang
                        </strong>
                    </span>
                    <span class="icon">
                        <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                        </i>
                    </span>
                    <span class="tag my-auto">0</span>
                </a>
            </li>
            @if (!Auth::guard('user')->check())
                <li class="authNav nav-item" if="check">
                    <div class="nav-link align-item-center">
                        <a href="{{ route('user.register.get') }}"
                            class="btn btn-outline-light authButton ml-1">Daftar</a>
                        <a class="btn btn-outline-light authButton ml-1">Masuk</a>
                    </div>
                </li>
            @else
                <li class="userNav shopping-cart nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <strong>{{ Auth::guard('user')->name }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <li>
                            <a href="#" class="dropdown-item">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.logout') }}" class="dropdown-item">
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
