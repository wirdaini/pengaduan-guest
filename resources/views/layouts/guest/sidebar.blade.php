<!-- resources/views/layouts/profile/sidebar.blade.php -->
@php
    $user = auth()->user();
    $warga = $user->warga;
@endphp

<div class="profile-sidebar">
    <!-- User Info -->
    <div class="text-center">
        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                 class="user-avatar"
                 alt="Foto Profil">
        @else
            <div class="user-avatar d-flex align-items-center justify-content-center bg-primary text-white mx-auto fs-3">
                {{ substr($user->name, 0, 1) }}
            </div>
        @endif

        <h5 class="mb-1">{{ $user->name }}</h5>
        <span class="badge bg-primary mb-2">Warga</span>

        @if($warga && $warga->no_ktp)
            <p class="text-muted small mb-0">
                <i class="bi bi-person-badge"></i> {{ $warga->no_ktp }}
            </p>
        @endif
    </div>

    <!-- Navigation -->
    <nav class="profile-nav">
        <ul>
            <li>
                <a href="{{ route('profile.index') }}"
                   class="{{ Request::routeIs('profile.index') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('profile.pengaduan') }}"
                   class="{{ Request::routeIs('profile.pengaduan') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Pengaduan Saya</span>
                    @if($warga)
                        @php
                            $count = App\Models\Pengaduan::where('warga_id', $warga->warga_id)->count();
                        @endphp
                        @if($count > 0)
                            <span class="badge bg-primary ms-auto">{{ $count }}</span>
                        @endif
                    @endif
                </a>
            </li>

            <li>
                <a href="{{ route('profile.penilaian') }}"
                   class="{{ Request::routeIs('profile.penilaian') ? 'active' : '' }}">
                    <i class="bi bi-star"></i>
                    <span>Penilaian Layanan</span>
                </a>
            </li>

            <li>
                <a href="{{ route('profile.settings') }}"
                   class="{{ Request::routeIs('profile.settings') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </li>

            <li class="mt-4 pt-3 border-top">
                <form method="POST" action="{{ route('logout') }}" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>
