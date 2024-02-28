<div>
    <x-slot name="title">Beranda</x-slot>

    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    <x-slot name="pageTitle">Beranda</x-slot>

    <div class="row">

        <div class="col-12 col-md-4 col-lg-3">

            <div class="card mt-2 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Jumlah Laporan</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlLaporan }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-3 flex">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>Jumlah Revisi</div>

                        <div class="ms-auto lh-1">
                            <span class="badge bg-blue-lt">Total</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-baseline mt-3">
                        <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlRevisi }}</div>
                    </div>
                </div>
            </div>

            @unless (auth()->user()->roles == 'mitra')
                <div class="card mt-3 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Jumlah Pengguna</div>

                            <div class="ms-auto lh-1">
                                <span class="badge bg-blue-lt">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlUser }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Jumlah Mitra</div>

                            <div class="ms-auto lh-1">
                                <span class="badge bg-blue-lt">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $this->jmlMitra }}</div>
                        </div>
                    </div>
                </div>
            @endunless
        </div>

        <div class="col-12 col-md-8 col-lg-9 d-flex">

            <div class="card h-100 mt-2 w-100" wire:ignore>
                <div class="card-body">
                    <h3 class="card-title">Data Laporan & Revisi Dalam 10 Hari Terakhir</h3>

                    <div data-report="{{ json_encode($report['data']) }}"
                        data-revision="{{ json_encode($revision['data']) }}" date="{{ json_encode($report['date']) }}"
                        id="chart-mentions" class="chart-lg">
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@push('scripts')
    <script>
        const item = document.getElementById('chart-mentions');
        window.ApexCharts && (new ApexCharts(item, {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 380,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
                stacked: true,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Data Laporan",
                data: JSON.parse(item.getAttribute('data-report'))
            }, {
                name: "Data Revisi",
                data: JSON.parse(item.getAttribute('data-revision'))
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: JSON.parse(item.getAttribute('date')),
            colors: ["#1d4ed8", "#4ade80"],
            legend: {
                show: false,
            },
        })).render();
    </script>
@endpush

</div>
