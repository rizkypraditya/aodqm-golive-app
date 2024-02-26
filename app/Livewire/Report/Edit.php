<?php

namespace App\Livewire\Report;

use App\Models\Mitra;
use App\Models\Report;
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

    #[Title('Sunting Laporan')]

    public $deskripsi;
    public $lokasi;
    public $fileLaporan;
    public $judulProyek;

    public $reportId;

    public function rules()
    {
        return [
            'deskripsi' => ['required', 'string', 'min:2'],
            'judulProyek' => ['required', 'string', 'min:2', 'max:255'],
            'lokasi' => ['nullable', 'image', 'min:2', 'max:2048'],
            'fileLaporan' => ['nullable', 'file', 'min:2', 'max:2048'],
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

        try {
            DB::beginTransaction();

            if ($mitra) {
                $report->update([
                    'mitra_id' => $mitra->id,
                    'description' => $this->deskripsi,
                    'project_title' => $this->judulProyek,
                    'status' => 'dikirim',
                ]);

                if ($this->lokasi) {
                    if ($report->location) {
                        File::delete(public_path('storage/' . $report->location));
                    }

                    $report->update([
                        'location' => $this->lokasi->store('lokasi', 'public'),
                    ]);
                }

                if ($this->fileLaporan) {
                    if (Storage::disk('local')->exists($report->file_report)) {
                        Storage::disk('local')->delete($report->file_report);
                    }

                    $report->update([
                        'file_report' => $this->fileLaporan->store('file-laporan'),
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data laporan gagal disunting.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data laporan berhasil disunting.",
        ]);

        return redirect()->route('report.index');
    }

    public function mount($id)
    {
        $report = Report::findOrFail($id);

        if ($report) {
            $this->reportId = $report->id;
            $this->deskripsi = $report->description;
            $this->judulProyek = $report->project_title;
        }
    }

    public function render()
    {
        return view('livewire.report.edit');
    }
}
