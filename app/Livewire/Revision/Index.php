<?php

namespace App\Livewire\Revision;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Revision;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    #[Title('Revisi Laporan')]

    public $filters = [
        'search' => '',
        'admin' => '',
        'start_date' => '',
        'end_date' => '',
    ];

    public function deleteSelected()
    {
        $revision = Revision::whereIn('id', $this->selected)->get();
        $deleteCount = $revision->count();

        if (auth()->user()->roles == 'mitra') {
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "hanya admin yang bisa menghapus",
            ]);
        } else {
            foreach ($revision as $data) {
                $data->delete();
            }
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data revisi laporan berhasil dihapus.",
        ]);

        return redirect()->route('revision.index');
    }

    #[Computed()]
    public function rows()
    {
        $query = Revision::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['start_date'], function ($query, $start_date) {
                $query->where('created_at', '>=', $start_date);
            })
            ->when($this->filters['end_date'], function ($query, $end_date) {
                $query->where('created_at', '<=', $end_date);
            })
            ->when($this->filters['admin'], fn ($query, $admin) => $query->where('admin_id', $admin))
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('note_revison', 'LIKE', "%$search%")
                    ->orWhere('created_at', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%")
                    ->orWhereHas('report', function ($query) use ($search) {
                        $query->where('project_title', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('admin', function ($query) use ($search) {
                        $query->where('username', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('mitra', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
            });

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function allData()
    {
        return Revision::all();
    }

    #[Computed()]
    public function admin()
    {
        return User::all(['id', 'username']);
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
        return view('livewire.revision.index');
    }
}
