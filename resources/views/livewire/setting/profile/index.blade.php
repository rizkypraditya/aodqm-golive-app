<div>
    <x-slot name="title">Pengaturan Profil</x-slot>

    <x-slot name="pageTitle">Pengaturan Profil</x-slot>

    <x-slot name="pagePretitle">Pengaturan</x-slot>

    <x-alert />

    <div class="row row-cards">
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 avatar-rounded"
                        style="background-image: url({{ auth()->user()->avatarUrl() ? auth()->user()->avatarUrl() : asset('storage/' . auth()->user()->avatar) }})"></span>

                    <h3 class="m-0 mb-1">{{ auth()->user()->name }}
                    </h3>

                    <div class="text-muted">{{ auth()->user()->email ?? '-' }}</div>

                    <div class="mt-3">
                        <span class="badge bg-green-lt">{{ auth()->user()->roles ?? '-' }}</span>
                    </div>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('setting.profile.index') }}" class="btn btn-card py-3 btn-square">Profil</a>
                    <a href="{{ route('setting.account.index') }}" class="btn btn-card py-3 btn-square">Akun</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-8">
            @if (auth()->user()->roles == 'teacher' && auth()->user()->teacher)
                @livewire('setting.profile.teacher-profile', ['user_id' => auth()->user()->id])
            @elseif (auth()->user()->roles == 'student' && auth()->user()->student)
                @livewire('setting.profile.student-profile', ['user_id' => auth()->user()->id])
            @else
                <div class="card">
                    <div class="card-body py-5 text-center">
                        <i class="las la-praying-hands" style="font-size: 40px"></i>
                        <h2 class="m-0 mb-1 pt-3 font-weight-bold">Maaf</h2>
                        <div class="text-muted pb-3">Sunting profil tidak tersedia untuk akun Anda.</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
