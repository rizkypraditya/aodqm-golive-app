<div class="d-none d-lg-flex">
    <div class="nav-item dropdown d-none d-md-flex me-3">

        @include('partials.svg.notification')

        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->roles == 'mitra')
                        <h3 class="card-title">Notifikasi Revisi Anda</h3>
                    @else
                        <h3 class="card-title">Notifikasi Laporan Anda</h3>
                    @endif
                </div>

                @livewire('notification.card')

            </div>
        </div>
    </div>
</div>
