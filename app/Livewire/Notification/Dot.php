<?php

namespace App\Livewire\Notification;

use App\Models\Report;
use App\Models\Revision;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dot extends Component
{
    #[Computed()]
    public function notification()
    {
        if (auth()->user()->roles == 'mitra') {
            $result = Revision::query()
                ->where('status', 'revisi')
                ->get()
                ->count();
        }else{
            $result = Report::query()
            ->where('status', 'dikirim')
            ->get()
            ->count();
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.notification.dot');
    }
}
