<div>
    <x-slot name="title">File Laporan</x-slot>

    <x-slot name="pagePretitle">Melihat Daftar File Laporan.</x-slot>

    <x-slot name="pageTitle">File Laporan</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('report.index')" />
    </x-slot>

    <x-alert />

    <div class="card">
        <div class="card-header">
            File Laporan
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="col">
                        <div class="card-body ps-0">
                            <div class="row">
                                <div class="col mb-3">
                                    <p class="fw-bold">Status Laporan</p>
                                    @if ($this->statusReport == 'disetujui')
                                        <p><span class="badge bg-green-lt">{{ $this->statusReport }}</span></p>
                                    @elseif($this->statusReport == 'dikirim')
                                        <p><span class="badge bg-orange-lt">{{ $this->statusReport }}</span></p>
                                    @else
                                        <p><span class="badge bg-orange-lt">{{ $this->statusReport }}</span></p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <p class="fw-bold">File Laporan</p>
                                    <div class="mt-3 list-inline list-inline mb-0 text-muted d-sm-block d-none">
                                        <div class="list-inline-item">
                                            <a target="_blank" href="{{ asset('storage/' . $this->url['file_1']) }}"
                                                class="btn bg-orange-lt" wire:click='downloadXml'>Download
                                                file .kml</a>
                                        </div>

                                        <div class="list-inline-item">
                                            <a target="_blank" href="{{ asset('storage/' . $this->url['file_2']) }}"
                                                class="btn bg-green-lt" wire:click='downloadXlx'>Download file
                                                .xlx</a>
                                        </div>

                                        <div class="list-inline-item">
                                            <a target="_blank" href="{{ asset('storage/' . $this->url['file_3']) }}"
                                                class="btn bg-blue-lt" wire:click='downloadPdf'>Download file
                                                .pdf</a>
                                        </div>

                                        <div class="list-inline-item">
                                            <a target="_blank" href="{{ asset('storage/' . $this->url['file_4']) }}"
                                                class="btn bg-yellow-lt" wire:click='downloadJpg'>Download
                                                file .jpg</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
