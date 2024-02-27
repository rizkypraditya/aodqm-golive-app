<div>
    <x-slot name="title">Master Mitra</x-slot>

    <x-slot name="pagePretitle">Melihat Daftar Mitra.</x-slot>

    <x-slot name="pageTitle">Master Mitra</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Mitra" :route="route('master.mitra.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div>
                <x-datatable.search placeholder="Cari nama mitra..." />
            </div>
        </div>

        <div class="col-auto ms-auto d-flex">
            <x-datatable.items-per-page />

            <x-datatable.bulk.dropdown>
                <div class="dropdown-menu dropdown-menu-end">
                    <button data-bs-toggle="modal" data-bs-target="#delete-confirmation" class="dropdown-item"
                        type="button">
                        <i class="las la-trash me-3"></i>

                        <span>Hapus</span>
                    </button>
                </div>
            </x-datatable.bulk.dropdown>
        </div>
    </div>

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <div class="table-responsive mb-0">
            <table class="table card-table table-bordered datatable">
                <thead>
                    <tr>
                        <th class="w-1">
                            <x-datatable.bulk.check wire:model.lazy="selectPage" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Mitra" wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Jenis Kelamin" wire:click="sortBy('gender')"
                                :direction="$sorts['gender'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Email" wire:click="sortBy('email')" :direction="$sorts['email'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Nomor Ponsel" wire:click="sortBy('phone')"
                                :direction="$sorts['phone'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Alamat" wire:click="sortBy('address')" :direction="$sorts['address'] ?? null" />
                        </th>

                        <th>Akun</th>

                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($selectPage)
                        <tr>
                            <td colspan="10" class="bg-red-lt">
                                @if (!$selectAll)
                                    <div class="text-red">
                                        <span>Anda telah memilih <strong>{{ $this->rows->total() }}</strong> mitra,
                                            apakah
                                            Anda mau memilih semua <strong>{{ $this->rows->total() }}</strong>
                                            mitra?</span>

                                        <button wire:click="selectedAll" class="btn ms-2">Pilih Semua</button>
                                    </div>
                                @else
                                    <span class="text-pink">Anda sekarang memilih semua
                                        <strong>{{ count($this->selected) }}</strong> mitra.
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endif

                    @forelse ($this->rows as $row)
                        <tr wire:key="row-{{ $row->id }}">
                            <td>
                                <x-datatable.bulk.check wire:model.lazy="selected" value="{{ $row->id }}" />
                            </td>

                            <td>{{ $row->name ?? '-' }}</td>

                            <td>{{ $row->gender ?? '-' }}</td>

                            <td>{{ $row->email ?? '-' }}</td>

                            <td>{{ $row->phone ?? '-' }}</td>

                            <td>{{ $row->address ?? '-' }}</td>

                            <td>
                                <span class="badge bg-{{ $row->akun->email ? 'green' : 'red' }}-lt">
                                    {{ $row->akun->email ? 'Dengan Akun' : 'Tampa Akun' }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div class="ms-auto">
                                        <a class="btn btn-sm" href="{{ route('master.mitra.edit', $row->id) }}">
                                            Sunting
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-datatable.empty colspan="10" />
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $this->rows->links() }}
    </div>
</div>
