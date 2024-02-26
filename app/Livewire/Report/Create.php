<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Title('Tambah Laporan')]

    public $deskripsi;
    public $lokasi;
    public $fileLaporan;
    public $judulProyek;

    public function rules()
    {
        return [
            'deskripsi' => ['required', 'string', 'min:2'],
            'judulProyek' => ['required', 'string', 'min:2', 'max:255'],
            'lokasi' => ['nullable', 'image', 'min:2', 'max:2048'],
            'fileLaporan' => ['required', 'file', 'min:2', 'max:2048'],
        ];
    }

    public function save()
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

        try {
            DB::beginTransaction();

            if ($mitra) {
                $report = Report::create([
                    'mitra_id' => $mitra->id,
                    'description' => $this->deskripsi,
                    'project_title' => $this->judulProyek,
                    'status' => 'dikirim',
                ]);

                if ($this->lokasi) {
                    $report->update([
                        'location' => $this->lokasi->store('lokasi', 'public'),
                    ]);
                }

                if ($this->fileLaporan) {
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


    public function render()
    {
        return view('livewire.report.create');
    }
}
