<div>
    <x-slot name="title">Pengaturan Profil Mitra</x-slot>

    <x-slot name="pageTitle">Pengaturan Profil Mitra</x-slot>

    <x-slot name="pagePretitle">Pengaturan Profil Mitra</x-slot>

    <div class="row row-cards">
        <div class="col-12">
            <x-alert />

            <form class="card" wire:submit.prevent="edit" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="nama" name="nama" label="Nama" placeholder="masukkan nama"
                                type="text" />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="email" name="email" label="Email" placeholder="masukkan email"
                                type="text" />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="noPonsel" name="noPonsel" label="Nomor Ponsel"
                                placeholder="masukkan nomor ponsel" type="text" />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.select wire:model.lazy="jenisKelamin" name="jenisKelamin" label="Jenis Kelamin">
                                <option selected value=""> - Pilih - </option>
                                @foreach (config('const.gender') as $gender)
                                    <option wire:key="row-{{ $gender }}" value="{{ $gender }}">
                                        {{ ucwords($gender) }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-12">
                            <x-form.textarea wire:model="alamat" name="alamat" label="Alamat Lengkap"
                                placeholder="masukkan alamat" type="text" />
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="btn-list justify-content-end">
                        <button type="reset" class="btn">Reset</button>

                        <x-datatable.button.save name="Simpan Perubahan" target="edit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
