<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Title('Tambah Laporan')]

    public $deskripsi;
    public $fileLaporan;
    public $fileLaporanTwo;
    public $fileLaporanThree;
    public $fileLaporanFour;
    public $judulProyek;

    public function rules()
    {
        return [
            'deskripsi' => ['required', 'string', 'min:2'],
            'judulProyek' => ['required', 'string', 'min:2', 'max:255'],
            'fileLaporan' => ['required', 'file', 'min:2'],
            'fileLaporanTwo' => ['required', 'file', 'min:2'],
            'fileLaporanThree' => ['required', 'file', 'min:2'],
            'fileLaporanFour' => ['required', 'file', 'min:2', 'mimes: jpg,jpeg'],
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
                'detail' => "Laporan hanya bisa ditambah oleh mitra",
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

                if ($this->fileLaporan) {
                    $this->fileLaporan->store('file-laporan');

                    $report->update([
                        'file_report' => $this->fileLaporan->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanTwo) {
                    $this->fileLaporanTwo->store('file-laporan');

                    $report->update([
                        'file_report_2' => $this->fileLaporanTwo->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanThree) {
                    $this->fileLaporanThree->store('file-laporan');

                    $report->update([
                        'file_report_3' => $this->fileLaporanThree->store('file-laporan', 'public'),
                    ]);
                }

                if ($this->fileLaporanFour) {
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
