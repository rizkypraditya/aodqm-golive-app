<div>
    <x-slot name="title">Revisi Laporan</x-slot>

    <x-slot name="pagePretitle">Revisi Data Laporan Mitra.</x-slot>

    <x-slot name="pageTitle">Revisi Laporan</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('report.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Revisi data laporan
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <x-form.textarea wire:model="catatan" name="catatan" label="Catatan Revisi"
                        placeholder="masukkan catatan revisi" type="text" />
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
