<x-layout-admin>

@section('content')
    <div class="container">
        <h2 class="mb-4">My Badges</h2>

        @if($badges->isEmpty())
            <div class="alert alert-info">
                You don't have any badges yet.
            </div>
        @else
            <div class="row">
                @foreach ($badges as $badge)
                    <div class="col-md-4">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $badge->Name }}</h5>
                                <p class="card-text">{{ $badge->Description }}</p>
                                <p class="card-text text-success">
                                    Discount: {{ $badge->Discount }}%
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout-admin>