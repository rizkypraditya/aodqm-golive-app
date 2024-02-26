<?php

namespace App\Livewire\Master\User;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    #[Title('Daftar Pengguna')]

    public $filters = [
        'search' => '',
    ];

    public function deleteSelected()
    {
        $users = User::whereIn('id', $this->selected)->get();
        $deleteCount = $users->count();

        foreach ($users as $data) {
            if ($data->avatar) {
                File::delete(public_path('storage/' . $this->avatar));
            }
            $data->delete();
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data pengguna berhasil dihapus.",
        ]);

        return redirect()->route('master.user.index');
    }

    #[Computed()]
    public function rows()
    {
        $query = User::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('username', 'LIKE', "%$search%")
                    ->orWhere('roles', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function allData()
    {
        return User::all();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.master.user.index');
    }
}
