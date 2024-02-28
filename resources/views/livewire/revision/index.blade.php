<div>
    <x-slot name="title">Revisi Laporan</x-slot>

    <x-slot name="pagePretitle">Revisi Data Laporan.</x-slot>

    <x-slot name="pageTitle">Revisi Laporan</x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div>
                <x-datatable.search placeholder="Cari nama pengguna..." />
            </div>

            <div class="w-50 ms-2">
                <x-datatable.filter.button target="revision" />
            </div>
        </div>

        @unless (auth()->user()->roles == 'mitra')
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
        @endunless
    </div>

    <x-datatable.filter.card id="revision">
        <div class="row">
            <div class="col-4">
                <x-form.select wire:model.lazy="filters.admin" name="filters.admin" label="Admin">
                    <option selected value=""> - Pilih - </option>

                    @foreach ($this->admin as $user)
                        <option wire:key="row-{{ $user->username }}" value="{{ $user->id }}">
                            {{ ucwords($user->username) }}
                        </option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="col-12 col-lg-4">
                <x-form.input wire:model.lazy="filters.start_date" name="filters.start_date" label="Tanggal Awal"
                    type="date" />
            </div>

            <div class="col-12 col-lg-4">
                <x-form.input wire:model.lazy="filters.end_date" name="filters.end_date" label="Tanggal Akhir"
                    type="date" />
            </div>
        </div>
    </x-datatable.filter.card>

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <div class="table-responsive mb-0">
            <table class="table card-table table-bordered datatable">
                <thead>
                    <tr>
                        @unless (auth()->user()->roles == 'mitra')
                            <th class="w-1">
                                <x-datatable.bulk.check wire:model.lazy="selectPage" />
                            </th>
                        @endunless

                        <th>
                            <x-datatable.column-sort name="Judul Proyek" wire:click="sortBy('project_title')"
                                :direction="$sorts['project_title'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Status Revisi" wire:click="sortBy('status')"
                                :direction="$sorts['status'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Tanggal" wire:click="sortBy('created_at')"
                                :direction="$sorts['created_at'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Pemberi Revisi" wire:click="sortBy('admin_id')"
                                :direction="$sorts['admin_id'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Catatan Revisi" wire:click="sortBy('note_revision')"
                                :direction="$sorts['note_revision'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Pembuat Laporan" wire:click="sortBy('mitra_id')"
                                :direction="$sorts['mitra_id'] ?? null" />
                        </th>

                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($selectPage)
                        @unless (auth()->user->roles == 'mitra')
                            <tr>
                                <td colspan="10" class="bg-red-lt">
                                    @if (!$selectAll)
                                        <div class="text-red">
                                            <span>Anda telah memilih <strong>{{ $this->rows->total() }}</strong> revisi
                                                laporans,
                                                apakah
                                                Anda mau memilih semua <strong>{{ $this->rows->total() }}</strong>
                                                revisi laporan?</span>

                                            <button wire:click="selectedAll" class="btn ms-2">Pilih Semua</button>
                                        </div>
                                    @else
                                        <span class="text-pink">Anda sekarang memilih semua
                                            <strong>{{ count($this->selected) }}</strong> revisi laporan.
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endunless
                    @endif

                    @forelse ($this->rows as $row)
                        <tr wire:key="row-{{ $row->id }}">
                            @unless (auth()->user()->roles == 'mitra')
                                <td>
                                    <x-datatable.bulk.check wire:model.lazy="selected" value="{{ $row->id }}" />
                                </td>
                            @endunless

                            <td>{{ $row->report->project_title ?? '-' }}</td>

                            <td>
                                @if ($row->status == 'disetujui')
                                    <span class="badge bg-green-lt">{{ $row->status }}</span>
                                @elseif ($row->status == 'dikirim')
                                    <span class="badge bg-orange-lt">{{ $row->status }}</span>
                                @else
                                    <span class="badge bg-red-lt">{{ $row->status }}</span>
                                @endif
                            </td>

                            <td style="width: 120px">{{ $row->created_at->format('Y-m-d') ?? '-' }}</td>

                            <td>{{ $row->admin->username ?? '-' }}</td>

                            <td>{{ $row->note_revision ?? '-' }}</td>

                            <td>{{ $row->mitra->name ?? '-' }}</td>

                            <td style="width: 30px">
                                <div class="row gap-2">
                                    @if (auth()->user()->roles == 'mitra')
                                        <div>
                                            <a class="btn btn-sm w-100" href="{{ route('revision.edit', $row->id) }}">
                                                Kirim Revisi
                                            </a>
                                        </div>
                                    @else
                                        <div>
                                            <button class="btn btn-sm bg-green-lt w-100"
                                                wire:click='aproveRevision({{ $row->id }})'>
                                                Setujui Revisi
                                            </button>
                                        </div>
                                    @endif

                                    <div>
                                        <a class="btn btn-sm bg-blue-lt w-100"
                                            href="{{ route('revision.download', $row->id) }}">
                                            Download Laporan Revision
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
