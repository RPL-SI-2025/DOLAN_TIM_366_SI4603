<x-layout-admin>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rating untuk: {{ $destination->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.destination.index') }}" class="btn btn-default">Kembali ke Daftar Destinasi</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ratings as $rating)
                                <tr>
                                    <td>{{ $rating->id }}</td>
                                    <td>{{ $rating->user->name }}</td>
                                    <td>{{ $rating->rating }}/5</td>
                                    <td>{{ Str::limit($rating->feedback, 50) }}</td>
                                    <td>{{ $rating->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada rating untuk destinasi ini.</td>
                                </tr>
                                @endforelse
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