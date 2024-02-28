<?php

namespace App\Livewire\Revision;

use App\Models\Report;
use App\Models\Revision;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    #[Title('Sunting Revisi Laporan')]

    public $deskripsi;
    public $lokasi;
    public $fileLaporan;
    public $fileLaporanTwo;
    public $fileLaporanThree;
    public $fileLaporanFour;
    public $judulProyek;

    public $reportId;
    public $revisionId;

    public $url = [
        'file_1' => '',
        'file_2' => '',
        'file_3' => '',
        'file_4' => '',
    ];

    public function rules()
    {
        return [
            'deskripsi' => ['required', 'string', 'min:2'],
            'judulProyek' => ['required', 'string', 'min:2', 'max:255'],
            'fileLaporan' => ['nullable', 'file', 'min:2'],
            'fileLaporanTwo' => ['nullable', 'file', 'min:2', 'mimes: xls,xlsx'],
            'fileLaporanThree' => ['nullable', 'file', 'min:2'],
            'fileLaporanFour' => ['nullable', 'file', 'min:2', 'mimes: jpg,jpeg'],
        ];
    }

    public function edit()
    {
        $this->validate();

        if (auth()->user()->roles == 'mitra') {
            $mitra = auth()->user()->mitra;
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "Laporan hanya bisa disunting oleh mitra",
            ]);

            return back();
        }

        $report = Report::findOrFail($this->reportId);
        $revision = Revision::findOrFail($this->revisionId);

        try {
            DB::beginTransaction();

            if ($mitra) {
                $report->update([
                    'mitra_id' => $mitra->id,
                    'description' => $this->deskripsi,
                    'project_title' => $this->judulProyek,
                    'status' => 'dikirim',
                ]);

                $revision->status = 'dikirim';
                $revision->save();

                if ($this->fileLaporan) {
                    if (Storage::disk('local')->exists($report->file_report)) {
                        Storage::disk('local')->delete($report->file_report);
                    }

                    File::delete(public_path('storage/' . $report->fileLaporan));

                    $this->fileLaporan->store('file-laporan');

                    $report->update([
                        'file_report' => $this->fileLaporan->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanTwo) {
                    if (Storage::disk('local')->exists($report->file_report_2)) {
                        Storage::disk('local')->delete($report->file_report_2);
                    }

                    File::delete(public_path('storage/' . $report->fileLaporanTwo));

                    $this->fileLaporanTwo->store('file-laporan');

                    $report->update([
                        'file_report_2' => $this->fileLaporanTwo->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanThree) {
                    if (Storage::disk('local')->exists($report->file_report_3)) {
                        Storage::disk('local')->delete($report->file_report_3);
                    }

                    File::delete(public_path('storage/' . $report->fileLaporanThree));

                    $this->fileLaporanThree->store('file-laporan');

                    $report->update([
                        'file_report_3' => $this->fileLaporanThree->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanFour) {
                    if (Storage::disk('local')->exists($report->file_report_4)) {
                        Storage::disk('local')->delete($report->file_report_4);
                    }

                    File::delete(public_path('storage/' . $report->fileLaporanFour));

                    $this->fileLaporanFour->store('file-laporan');

                    $report->update([
                        'file_report_4' => $this->fileLaporanFour->store('file-laporan', 'public'),
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data laporan revisi gagal dikirim.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data laporan revisi berhasil dikirim.",
        ]);

        return redirect()->route('revision.index');
    }

    public function mount($id)
    {
        $revision = Revision::findOrFail($id);
        $report = Report::findOrFail($revision->report_id);

        if ($report) {
            $this->revisionId = $revision->id;
            $this->reportId = $report->id;
            $this->deskripsi = $report->description;
            $this->judulProyek = $report->project_title;

            $this->url['file_1'] = $report->file_report;
            $this->url['file_2'] = $report->file_report_2;
            $this->url['file_3'] = $report->file_report_3;
            $this->url['file_4'] = $report->file_report_4;
        }
    }


    public function render()
    {
        return view('livewire.revision.edit');
    }
}
