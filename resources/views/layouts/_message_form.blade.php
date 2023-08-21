@if ($status = session('message'))
    <div class="alert alert-success">{{ $status }}</div>
@endif
