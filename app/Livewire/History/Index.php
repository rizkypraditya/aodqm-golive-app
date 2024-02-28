<?php

namespace App\Livewire\History;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    #[Title('History')]

    public $filters = [
        'search' => '',
        'status' => '',
        'start_date' => '',
        'end_date' => '',
    ];

    public function deleteSelected()
    {
        $report = Report::whereIn('id', $this->selected)->get();
        $deleteCount = $report->count();

        foreach ($report as $data) {
            if ($data->file_report) {
                Storage::disk('local')->delete($data->file_report);
            }

            $data->delete();
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data laporan berhasil dihapus.",
        ]);

        return redirect()->route('report.index');
    }

    #[Computed()]
    public function rows()
    {
        $query = Report::query()
            ->where('status', 'disetujui')
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['start_date'], function ($query, $start_date) {
                $query->where('created_at', '>=', $start_date);
            })
            ->when($this->filters['end_date'], function ($query, $end_date) {
                $query->where('created_at', '<=', $end_date);
            })
            ->when($this->filters['status'], fn ($query, $status) => $query->where('status', $status))
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('project_title', 'LIKE', "%$search%")
                    ->orWhere('created_at', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%")
                    ->orWhereHas('mitra', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
            });

        return $this->applyPagination($query);
    }

    public function unAproveReport($id)
    {
        $report = Report::find($id);

        if ($report) {
            $report->status = 'dikirim';
            $report->save();

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "status laporan batal disetujui.",
            ]);

            return redirect()->back();
        }
    }

    #[Computed()]
    public function allData()
    {
        return Report::all();
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
        return view('livewire.history.index');
    }
}
