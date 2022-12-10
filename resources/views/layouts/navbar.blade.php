<nav class="navbar navbar-expand-lg navbar-light navbar-color ">
    <div class="container">

        @if (Auth::user()->role == 'admin')
            <a class="navbar-brand" href="/">
            @elseif(Auth::user()->role == 'manager')
                <a class="navbar-brand" href="/manager">
                @else
                    <a class="navbar-brand" href="/teknisi">
        @endif
        <img src="{{ asset('img/logo.png') }}" alt="Logo" width="110" height="40">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(1) == '' ? 'active' : '' }}"
                            aria-current="page" href="/">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(1) == 'listklaim' ? 'active' : '' }}"
                            href="/listklaim">List Klaim</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(1) == 'produk' ? 'active' : '' }}"
                            href="/produk">Produk</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link fw-semibold dropdown-toggle {{ request()->segment(1) == 'distributor' || request()->segment(1) == 'customer' ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pelanggan
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <a class="nav-link fw-semibold {{ request()->segment(1) == 'distributor' ? 'active' : '' }}"
                                    href="/distributor">Distributor</a>
                            </li>

                            <li class="dropdown-item">
                                <a class="nav-link fw-semibold {{ request()->segment(1) == 'customer' ? 'active' : '' }}"
                                    href="/customer">Pengguna</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fw-semibold dropdown-toggle {{ request()->segment(1) == 'kerusakan' || request()->segment(1) == 'hasil-klaim' ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Konfigurasi
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <a class="nav-link fw-semibold {{ request()->segment(1) == 'kerusakan' ? 'active' : '' }}"
                                    href="/kerusakan">Kerusakan</a>
                            </li>

                            <li class="dropdown-item">
                                <a class="nav-link fw-semibold {{ request()->segment(1) == 'hasil-klaim' ? 'active' : '' }}"
                                    href="/hasil-klaim">Keterangan Hasil</a>
                            </li>
                        </ul>
                    </li>
                @elseif(Auth::user()->role == 'manager')
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(2) == '' ? 'active' : '' }}"
                            aria-current="page" href="/manager">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(2) == 'to-approve' ? 'active' : '' }}"
                            href="/manager/to-approve">To Approve</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->segment(2) == 'listklaim' ? 'active' : '' }}"
                            href="/manager/listklaim">List Klaim</a>
                    </li>
                @endif
            </ul>

            <div class="d-flex">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <span class="d-md-block dropdown-toggle ps-2 text-dark fw-semibold">{{ Auth::user()->nama }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
</nav>
