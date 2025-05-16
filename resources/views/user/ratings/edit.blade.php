@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Rating for {{ $rating->destination->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.ratings.update', $rating) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" required>
                                <option value="">Select Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $rating->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            @error('rating')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea name="feedback" id="feedback" rows="5" class="form-control @error('feedback') is-invalid @enderror" required>{{ old('feedback', $rating->feedback) }}</textarea>
                            @error('feedback')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Rating</button>
                            <a href="{{ route('user.ratings.show', $rating) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 