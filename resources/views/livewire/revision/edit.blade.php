<div>
    <x-slot name="title">Sunting Revisi Laporan</x-slot>

    <x-slot name="pagePretitle">Menyunting Daftar Revisi Laporan.</x-slot>

    <x-slot name="pageTitle">Sunting Revisi Laporan</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('report.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="edit" autocomplete="off">
        <div class="card-header">
            Sunting data laporan revisi
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="judulProyek" name="judulPoryek" label="Judul Proyek"
                        placeholder="masukkan judul proyek" type="text" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="fileLaporan" name="fileLaporan" label="Upload File KML (only .kml)"
                        placeholder="masukkan file laporan" type="file" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="fileLaporanTwo" name="fileLaporanTwo"
                        label="Upload File MAINCORD (only .xlx)" placeholder="masukkan file laporan" type="file" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="fileLaporanThree" name="fileLaporanThree"
                        label="Upload File ABD (only .pdf)" placeholder="masukkan file laporan" type="file" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.input wire:model="fileLaporanFour" name="fileLaporanFour"
                        label="Upload File Gambar (only .jpg)" placeholder="masukkan file laporan" type="file" />
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

                <x-datatable.button.save target="edit" />
            </div>
        </div>
    </form>
</div>
