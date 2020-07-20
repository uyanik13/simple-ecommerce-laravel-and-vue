<div class="@if($review->parent_id) review-reply @else review @endif">
    <div class="card mb-4 @if($review->parent_id) ml-5 @endif">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                {{ $review->user->full_name }}
            </div>
            <p class="card-text">{{ $review->created_at->diffForHumans() }}</p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $review->text }}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-between align-items-center">
            <div class="review-controls">
                <a href="#" class="btn btn-sm btn-link" data-parent-id="{{ $review->parent_id }}">
                    <i class="fas fa-reply"></i> Reply
                </a>
            </div>
            <div class="review-rating">
                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-thumbs-up"></i></a>
                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i></a>
            </div>
        </div>
    </div>
</div>

@foreach($review->children as $child)
    @include('reivews._review', ['review' => $child])
@endforeach