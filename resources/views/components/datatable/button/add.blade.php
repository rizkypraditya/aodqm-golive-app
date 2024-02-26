<a href="{{ $route }}" class="btn {{ isset($color) ? $color : 'btn-red' }} d-none d-sm-inline-block">
    <i class="las la-plus me-1"></i>
    {{ $name }}
</a>

<a href="{{ $route }}" class="btn {{ isset($color) ? $color : 'btn-red' }} d-sm-none btn-icon">
    <i class="las la-plus"></i>
</a>
