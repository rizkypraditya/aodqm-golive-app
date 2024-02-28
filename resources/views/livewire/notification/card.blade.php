<div wire:poll.3s>
    @forelse ($this->notification as $data)
        @if (auth()->user()->roles == 'mitra')
            <div class="list-group list-group-flush list-group-hoverable">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span>
                        </div>
                        <div class="col text-truncate">
                            <a href="{{ route('revision.index') }}"
                                class="text-body d-block">{{ $data->report->project_title }}</a>
                            <div class="d-block text-muted text-truncate mt-n1">
                                {{ $data->report->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="list-group list-group-flush list-group-hoverable">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span>
                        </div>
                        <div class="col text-truncate">
                            <a href="{{ route('report.index') }}" class="text-body d-block">{{ $data->project_title }}</a>
                            <div class="d-block text-muted text-truncate mt-n1">
                                {{ $data->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="list-group list-group-flush list-group-hoverable">
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col text-truncate">
                        <p class="text-body d-block">Data Notifikasi Tidak Ada</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</div>
