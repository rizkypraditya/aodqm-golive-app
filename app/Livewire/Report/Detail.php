<?php

namespace App\Livewire\Report;

use Livewire\Attributes\Title;
use Livewire\Component;

class Detail extends Component
{
    #[Title('Detail Laporan')]

    public function render()
    {
        return view('livewire.report.detail');
    }
}
