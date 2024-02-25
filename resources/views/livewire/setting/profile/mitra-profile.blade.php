<div>
    <x-slot name="title">Pengaturan Profil Guru</x-slot>

    <x-slot name="pageTitle">Pengaturan Profil Guru</x-slot>

    <x-slot name="pagePretitle">Pengaturan Profil Guru</x-slot>

    <div class="row row-cards">
        <div class="col-12">
            <x-alert />

            <form class="card" wire:submit.prevent="edit" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="nama" name="nama" label="Nama" type="text"
                                placeholder="masukkan nama" autofocus />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="email" name="email" label="Email" type="text"
                                placeholder="masukkan email" autofocus />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.input wire:model="phone" name="phone" label="Nomor Ponsel" type="text"
                                placeholder="masukkan nomor ponsel" autofocus />
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.select wire:model.lazy="category" name="category" label="Kategori">
                                <option selected value=""> - Pilih - </option>
                                @foreach (config('const.teacher_category') as $value)
                                    <option wire:key="calling-{{ $value }}" value="{{ $value }}">
                                        {{ ucwords($value) }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.select wire:model.lazy="gender" name="gender" label="Jenis Kelamin">
                                <option selected value=""> - Pilih - </option>
                                @foreach (config('const.gender') as $value)
                                    <option wire:key="calling-{{ $value }}" value="{{ $value }}">
                                        {{ ucwords($value) }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-12 col-lg-6">
                            <x-form.select wire:model.lazy="religion" name="religion" label="Agama">
                                <option selected value=""> - Pilih - </option>
                                @foreach (config('const.religion') as $value)
                                    <option wire:key="calling-{{ $value }}" value="{{ $value }}">
                                        {{ ucwords($value) }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-12">
                            <x-form.textarea wire:model="address" name="address" label="Alamat Siswa"
                                placeholder="masukkan alamat siswa" type="text" />
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
