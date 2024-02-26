<div>
    <x-slot name="title">Tambah Laporan</x-slot>

    <x-slot name="pagePretitle">Menambah Daftar Laporan.</x-slot>

    <x-slot name="pageTitle">Tambah Laporan</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('report.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Tambah data laporan
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="judulProyek" name="judulPoryek" label="Judul Proyek"
                        placeholder="masukkan judul proyek" type="text" />
                </div>

                {{-- <div class="col-12 col-lg-6">
                    <x-form.input wire:model="lokasi" name="lokasi" label="File Lokasi"
                        placeholder="masukkan file lokasi" type="file" />
                </div> --}}

                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="fileLaporan" name="fileLaporan" label="File Laporan"
                        placeholder="masukkan file laporan" type="file" />
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <x-form.textarea wire:model="deskripsi" name="deskripsi" label="Deskripsi Pekerjaan"
                        placeholder="masukkan deskripsi" type="text" />
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="save" />
            </div>
        </div>
    </form>
</div>
