<?php

namespace App\Livewire\Master\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Title('Tambah Pengguna')]

    public $username;
    public $email;
    public $password;
    public $avatar;
    public $roles;

    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:255'],
            'roles' => ['required', 'string', 'min:2', 'max:255', Rule::in(config('const.roles'))],
            'email' => ['required', 'string', 'min:2', 'unique:users,email'],
            'password' => ['required', 'string', Password::default()],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password,
                'roles' => $this->roles,
            ]);

            if ($this->avatar) {
                $user->update([
                    'avatar' => $this->avatar->store('avatars', 'public'),
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data user gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data user berhasil ditambah.",
        ]);

        return redirect()->route('master.user.index');
    }

    public function render()
    {
        return view('livewire.master.user.create');
    }
}
