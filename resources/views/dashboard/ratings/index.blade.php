<x-layout-admin>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ratings & Feedback</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Destination</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratings as $rating)
                                <tr>
                                    <td>{{ $rating->id }}</td>
                                    <td>{{ $rating->user->name }}</td>
                                    <td>{{ $rating->destination->name }}</td>
                                    <td>{{ $rating->rating }}/5</td>
                                    <td>{{ Str::limit($rating->feedback, 50) }}</td>
                                    <td>{{ $rating->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.ratings.show', $rating) }}" class="btn btn-info btn-sm">View</a>
                                        <form action="{{ route('dashboard.ratings.destroy', $rating) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $ratings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout-admin> 