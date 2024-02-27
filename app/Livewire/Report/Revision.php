<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Exception;
use App\Models\Revision as RevisionModels;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Revision extends Component
{
    public $catatan;
    public $reportId;

    public function rules()
    {
        return [
            'catatan' => ['required', 'string', 'min:2'],
        ];
    }

    public function save()
    {
        $this->validate();
        $admin = auth()->user();
        $report = Report::find($this->reportId);

        try {
            DB::beginTransaction();

            RevisionModels::updateOrCreate(
                [
                    'admin_id' => $admin->id,
                    'report_id' => $report->id,
                    'mitra_id' => $report->mitra->id,
                ],
                [
                    'status' => 'revisi',
                    'note_revision' => $this->catatan,
                ]
            );

            $report->update([
                'status' => 'revisi',
            ]);

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data laporan gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data laporan berhasil ditambah.",
        ]);

        return redirect()->route('report.index');
    }

    public function mount($id)
    {
        $report = Report::findOrFail($id);

        if ($report) {
            $this->reportId = $report->id;
        }
    }

    public function render()
    {
        return view('livewire.report.revision');
    }
}
