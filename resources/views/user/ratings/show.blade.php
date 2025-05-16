<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rating for {{ $rating->destination->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rating for {{ $rating->destination->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Destination Information</h4>
                            <p><strong>Name:</strong> {{ $rating->destination->name }}</p>
                            <p><strong>Location:</strong> {{ $rating->destination->location }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Rating Information</h4>
                            <p><strong>Rating:</strong> {{ $rating->rating }}/5</p>
                            <p><strong>Submitted:</strong> {{ $rating->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Last Updated:</strong> {{ $rating->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Your Feedback</h4>
                            <div class="p-3 bg-light">
                                {{ $rating->feedback }}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            @if(auth()->id() === $rating->user_id)
                                <a href="{{ route('user.ratings.edit', $rating) }}" class="btn btn-primary">Edit Rating</a>
                            @endif
                            <a href="{{ route('destinations.show', $rating->destination) }}" class="btn btn-secondary">Back to Destination</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html> 