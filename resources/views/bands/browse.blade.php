@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2 class="mb-4">All Bands</h2>

  @if($bands->isEmpty())
    <p class="text-muted">No bands found.</p>
  @else
    <div class="list-group">
      @foreach($bands as $band)
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <a href="{{ route('bands.show', $band) }}" class="h5 text-decoration-none">
              {{ $band->name }}
            </a>
            <br>
            <small class="text-muted">By: {{ $band->owner->name }}</small>
          </div>
          <a href="{{ route('bands.show', $band) }}" class="btn btn-sm btn-outline-primary">View</a>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
