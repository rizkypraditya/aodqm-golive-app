<?php

namespace App\Livewire\Home;

use App\Helpers\HomeChart;
use App\Models\Mitra;
use App\Models\Report;
use App\Models\Revision;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $jmlUser;
    public $jmlMitra;
    public $jmlRevisi;
    public $jmlLaporan;

    public $revision;
    public $report;

    public function mount()
    {

        if (auth()->user()->roles != 'mitra') {
            $this->jmlUser = User::count();
        }

        $this->jmlMitra = Mitra::count();
        $this->jmlRevisi = Revision::count();
        $this->jmlLaporan = Report::count();

        $this->revision = HomeChart::REVISION();
        $this->report = HomeChart::REPORT();
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
