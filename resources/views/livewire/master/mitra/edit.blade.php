<div>
    <x-slot name="title">Sunting Mitra</x-slot>

    <x-slot name="pagePretitle">Menyunting Data Mitra.</x-slot>

    <x-slot name="pageTitle">Sunting Mitra</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('master.mitra.index')" />
    </x-slot>

    <x-alert />

    <form class="card" wire:submit.prevent="edit" autocomplete="off">
        <div class="card-header">
            Sunting data Mitra
        </div>

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

                <div class="col-12 col-lg-6">
                    <x-form.textarea wire:model="alamat" name="alamat" label="Alamat Lengkap"
                        placeholder="masukkan alamat" type="text" />
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <x-form.select wire:model.lazy="statusAkun" name="statusAkun" label="Pilih Cara Buat Akun">
                        <option selected value=""> - Pilih - </option>
                        @foreach (config('const.akun') as $akun)
                            <option wire:key="row-{{ $akun }}" value="{{ $akun }}">
                                {{ ucwords($akun) }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
        </div>

        @if ($this->statusAkun == 'buat akun')
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <x-form.input wire:model="username" name="username" label="Username"
                            placeholder="masukkan username" type="text" />
                    </div>

                    <div class="col-12 col-lg-6">
                        <x-form.input wire:model="password" name="password" label="Password" placeholder="**********"
                            type="password" />
                    </div>
                </div>
            </div>
        @endif

        <div class="card-footer">
            <div class="btn-list justify-content-end">
                <button type="reset" class="btn">Reset</button>

                <x-datatable.button.save target="edit" />
            </div>
        </div>
    </form>
</div>
