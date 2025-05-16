<x-layout-admin>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rating Details</h3>
                        <div class="card-tools">
                            <a href="{{ route('dashboard.ratings.index') }}" class="btn btn-default">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>User Information</h4>
                                <p><strong>Name:</strong> {{ $rating->user->name }}</p>
                                <p><strong>Email:</strong> {{ $rating->user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Destination Information</h4>
                                <p><strong>Name:</strong> {{ $rating->destination->name }}</p>
                                <p><strong>Location:</strong> {{ $rating->destination->location }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Rating & Feedback</h4>
                                <p><strong>Rating:</strong> {{ $rating->rating }}/5</p>
                                <p><strong>Feedback:</strong></p>
                                <div class="p-3 bg-light">
                                    {{ $rating->feedback }}
                                </div>
                                <p class="mt-3"><strong>Submitted:</strong> {{ $rating->created_at->format('d M Y H:i') }}</p>
                                <p><strong>Last Updated:</strong> {{ $rating->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <form action="{{ route('dashboard.ratings.destroy', $rating) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this rating?')">Delete Rating</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin> 