<?php

namespace App\Livewire\Master\Mitra;

use App\Models\Mitra;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

class Edit extends Component
{
    #[Title('Sunting Mitra')]

    public $nama;
    public $email;
    public $noPonsel;
    public $alamat;
    public $jenisKelamin;

    public $username;
    public $password;

    public $statusAkun;

    public $mitraId;
    public $userId;

    public function validateData()
    {
        $this->validate([
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:2', 'unique:mitra,email,' . $this->mitraId],
            'noPonsel' => ['required', 'string', 'min:2'],
            'alamat' => ['required', 'string', 'min:2'],
            'jenisKelamin' => ['required', 'string', 'min:2', 'max:255', Rule::in(config('const.gender'))],
        ]);

        if ($this->statusAkun == 'buat akun') {
            $this->validate([
                'username' => ['required', 'string', 'min:2', 'max:255'],
                'password' => ['nullable', 'string', 'min:2', 'max:255', Password::default()],
            ]);
        }

        if (!$this->userId) {
            $this->validate([
                'password' => ['required', 'string', 'min:2', 'max:255', Password::default()],
            ]);
        }
    }

    public function edit()
    {
        $this->validateData();

        $mitra = Mitra::findOrFail($this->mitraId);

        if ($this->userId) {
            $user = User::whereId($this->userId)->first();
        }

        try {
            DB::beginTransaction();

            $mitra->update([
                'name' => $this->nama,
                'email' => $this->email,
                'phone' => $this->noPonsel,
                'address' => $this->alamat,
                'gender' => $this->jenisKelamin,
            ]);

            if ($this->statusAkun = 'buat akun') {

                if ($this->userId) {
                    $user->update([
                        'username' => $this->username,
                        'email' => $this->email,
                        'roles' => 'mitra',
                        'email_verified_at' => now(),
                    ]);

                    if ($this->password) {
                        $user->update([
                            'password' => $this->password
                        ]);
                    }
                } else {
                    $user = User::create([
                        'username' => $this->username,
                        'password' => $this->password,
                        'email' => $this->email,
                        'roles' => 'mitra',
                        'email_verified_at' => now(),
                    ]);
                }

                $mitra->update([
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data mitra gagal disunting.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data mitra berhasil disunting.",
        ]);

        return redirect()->route('master.mitra.index');
    }

    public function mount($id)
    {
        $mitra = Mitra::findOrFail($id);
        $user = User::whereId($mitra->user_id)->first();

        $this->mitraId = $mitra->id;

        if ($user) {
            $this->userId = $user->id;
            $this->username = $user->username;
            $this->statusAkun = 'buat akun';
        }

        $this->nama = $mitra->name;
        $this->email = $mitra->email;
        $this->noPonsel = $mitra->phone;
        $this->alamat = $mitra->address;
        $this->jenisKelamin = $mitra->gender;
    }


    public function render()
    {
        return view('livewire.master.mitra.edit');
    }
}
