<?php

namespace App\Livewire\Report;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Report;
use Illuminate\Support\Facades\File;
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

    #[Title('Laporan')]

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
            if ($data->location) {
                File::delete(public_path('storage/' . $data->location));
            }

            if (Storage::disk('local')->exists($report->file_report)) {
                Storage::disk('local')->delete($report->file_report);
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

    public function downloadFile($idReport)
    {
        $report = Report::find($idReport);

        if (Storage::disk('local')->exists($report->file_report)) {
            return Storage::download($report->file_report, Date('Y-m-d') . '_' . $report->project_title);
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "file laporan tidak terdapat.",
            ]);
        }
    }

    public function render()
    {
        return view('livewire.report.index');
    }
}
