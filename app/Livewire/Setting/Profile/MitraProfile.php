<?php

namespace App\Livewire\Setting\Profile;

use App\Models\Mitra;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class MitraProfile extends Component
{
    #[Title('Pengaturan Profil Mitra')]

    public $nama;
    public $email;
    public $noPonsel;
    public $alamat;
    public $jenisKelamin;

    public $userId;
    public $mitraId;

    public function rules()
    {
        return [
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:2', 'max:255', 'mitra,email,' . $this->mitraId],
            'noPonsel' => ['required', 'string', 'min:2'],
            'alamat' => ['required', 'string', 'min:2'],
            'jenisKelamin' => ['required', 'string', 'min:2', 'max:255', Rule::in(config('const.gender'))],
        ];
    }

    public function edit()
    {
        $this->validate();

        $mitra = Mitra::findOrFail($this->mitraId);

        try {
            DB::beginTransaction();

            $mitra->update([
                'name' => $this->nama,
                'email' => $this->email,
                'phone' => $this->noPonsel,
                'address' => $this->alamat,
                'gender' => $this->jenisKelamin,
            ]);

            DB::commit();
        } catch (Exception $e) {
            logger()->error(
                '[setting] ' .
                    auth()->user()->username .
                    ' gagal menyimpan profil mitra',
                [$e->getMessage()]
            );
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Profil mitra berhasil disimpan.',
        ]);

        return redirect()->back();
    }

    public function mount($user_id)
    {
        $this->userId = $user_id;

        $mitra = Mitra::where('user_id', $user_id)->first();

        if ($mitra) {
            $this->mitraId = $mitra->id;
            $this->nama = $mitra->name;
            $this->email = $mitra->email;
            $this->noPonsel = $mitra->phone;
            $this->alamat = $mitra->address;
            $this->jenisKelamin = $mitra->gender;
        }
    }

    public function render()
    {
        return view('livewire.setting.profile.mitra-profile');
    }
}
