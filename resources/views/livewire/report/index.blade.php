<div>
    <x-slot name="title">Laporan</x-slot>

    <x-slot name="pagePretitle">Melihat Daftar Laporan.</x-slot>

    <x-slot name="pageTitle">Laporan</x-slot>

    <x-slot name="button">
        <x-datatable.button.add name="Tambah Laporan" :route="route('report.create')" />
    </x-slot>

    <x-alert />

    <x-modal.delete-confirmation />

    <div class="row mb-3 align-items-center justify-content-between">
        <div class="col-12 col-lg-5 d-flex">
            <div class="w-100">
                <x-datatable.search placeholder="Cari nama laporan..." />
            </div>

            <div class="w-50 ms-2">
                <x-datatable.filter.button target="report" />
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

    <x-datatable.filter.card id="report">
        <div class="row">
            <div class="col-4">
                <x-form.select wire:model.lazy="filters.status" name="filters.status" label="Status">
                    <option selected value=""> - Pilih - </option>

                    @foreach (config('const.status_report') as $status)
                        <option wire:key="row-{{ $status }}" value="{{ $status }}">{{ ucwords($status) }}
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
                        <th class="w-1">
                            <x-datatable.bulk.check wire:model.lazy="selectPage" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Judul Projek" wire:click="sortBy('project_title')"
                                :direction="$sorts['project_title'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Tanggal" wire:click="sortBy('created_at')"
                                :direction="$sorts['created_at'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Status" wire:click="sortBy('status')" :direction="$sorts['status'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Diubah Oleh" wire:click="sortBy('mitra_id')"
                                :direction="$sorts['mitra_id'] ?? null" />
                        </th>

                        <th>
                            <x-datatable.column-sort name="Laporan" wire:click="sortBy('file_report')"
                                :direction="$sorts['file_report'] ?? null" />
                        </th>

                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($selectPage)
                        <tr>
                            <td colspan="10" class="bg-azure-lt">
                                @if (!$selectAll)
                                    <div class="text-blue">
                                        <span>Anda telah memilih <strong>{{ $this->rows->total() }}</strong> laporan,
                                            apakah
                                            Anda mau memilih semua <strong>{{ $this->rows->total() }}</strong>
                                            laporan?</span>

                                        <button wire:click="selectedAll" class="btn ms-2">Pilih Semua</button>
                                    </div>
                                @else
                                    <span class="text-pink">Anda sekarang memilih semua
                                        <strong>{{ count($this->selected) }}</strong> laporan.
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

                            <td>{{ $row->project_title ?? '-' }}</td>

                            <td>{{ $row->created_at ?? '-' }}</td>

                            <td>
                                @if ($row->status == 'disetujui')
                                    <span class="badge bg-green-lt">{{ $row->status }}</span>
                                @elseif ($row->status == 'dikirim')
                                    <span class="badge bg-orange-lt">{{ $row->status }}</span>
                                @else
                                    <span class="badge bg-red-lt">{{ $row->status }}</span>
                                @endif
                            </td>

                            <td>{{ $row->mitra->name ?? '-' }}</td>

                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a class="btn btn-sm" href="{{ route('report.edit', $row->id) }}">
                                            Sunting
                                        </a>
                                        <button class="btn btn-sm bg-red-lt" wire:click='downloadFile({{ $row->id }})'>
                                            Download File
                                        </button>
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
