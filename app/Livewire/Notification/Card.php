<?php

namespace App\Livewire\Notification;

use App\Models\Report;
use App\Models\Revision;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Card extends Component
{
    #[Computed()]
    public function notification()
    {
        if (auth()->user()->roles == 'mitra') {
            $result = Revision::query()
                ->where('status', 'revisi')
                ->limit(10)
                ->get();
        } else {
            $result = Report::query()
                ->where('status', 'dikirim')
                ->limit(10)
                ->get(['id', 'project_title', 'description']);
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.notification.card');
    }
}
