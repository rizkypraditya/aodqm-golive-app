<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Download extends Component
{
    public $statusReport;
    public $namaMitra;
    public $reportId;
    public $mitraId;

    public function mount($id)
    {
        $report = Report::findOrFail($id);

        if ($report) {
            $this->statusReport = $report->status;
            $this->namaMitra = $report->mitra->name;
            $this->reportId = $report->id;
            $this->mitraId = $report->mitra->id;
        }
    }

    public function downloadXml()
    {
        $report = Report::findOrFail($this->reportId);

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

    public function downloadXlx()
    {
        $report = Report::findOrFail($this->reportId);

        if (Storage::disk('local')->exists($report->file_report_2)) {
            return Storage::download($report->file_report_2, Date('Y-m-d') . '_' . $report->project_title . '_2');
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "file laporan tidak terdapat.",
            ]);
        }
    }

    public function downloadPdf()
    {
        $report = Report::findOrFail($this->reportId);

        if (Storage::disk('local')->exists($report->file_report_3)) {
            return Storage::download($report->file_report_3, Date('Y-m-d') . '_' . $report->project_title . '_3');
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "file laporan tidak terdapat.",
            ]);
        }
    }

    public function downloadJpg()
    {
        $report = Report::findOrFail($this->reportId);

        if (Storage::disk('local')->exists($report->file_report_4)) {
            return Storage::download($report->file_report_4, Date('Y-m-d') . '_' . $report->project_title . '_4');
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "file laporan tidak terdapat.",
            ]);
        }
    }

    public function render()
    {
        return view('livewire.report.download');
    }
}
