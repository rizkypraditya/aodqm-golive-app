<?php

namespace App\Livewire\Master\Mitra;

use App\Models\Mitra;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Create extends Component
{
    #[Title('Tambah Mitra')]

    public $nama;
    public $email;
    public $noPonsel;
    public $alamat;
    public $jenisKelamin;

    public $username;
    public $password;

    public $statusAkun;

    public $datMitra;

    public function validateData()
    {
        $this->validate([
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:2', 'unique:mitra,email'],
            'noPonsel' => ['required', 'string', 'min:2'],
            'alamat' => ['required', 'string', 'min:2'],
            'jenisKelamin' => ['required', 'string', 'min:2', 'max:255', Rule::in(config('const.gender'))],
        ]);

        if ($this->statusAkun == 'buat akun') {
            $this->validate([
                'username' => ['required', 'string', 'min:2', 'max:255'],
                'password' => ['required', 'string', 'min:2', 'max:255', Password::default()],
            ]);
        }
    }

    public function save()
    {
        $this->validateData();

        try {
            DB::beginTransaction();

            $mitra = Mitra::create([
                'name' => $this->nama,
                'email' => $this->email,
                'phone' => $this->noPonsel,
                'address' => $this->alamat,
                'gender' => $this->jenisKelamin,
            ]);

            if ($this->statusAkun = 'buat akun') {
                $user = User::create([
                    'username' => $this->username,
                    'password' => $this->password,
                    'email' => $this->email,
                    'roles' => 'mitra',
                    'email_verified_at' => now(),
                ]);

                $mitra->update([
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data mitra gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data mitra berhasil ditambah.",
        ]);

        return redirect()->route('master.mitra.index');
    }

    public function render()
    {
        return view('livewire.master.mitra.create');
    }
}
