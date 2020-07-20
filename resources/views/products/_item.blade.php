<div class="col-md-4">
    <div class="card mb-4 shadow-sm product-item">
        <div class="product-controls">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-heart"></i></button>
                <button type="button" class="btn btn-sm btn-light"><i class="fas fa-balance-scale"></i></button>
            </div>
        </div>
        @if($product->cover)
            <img src="{{ asset($product->cover) }}" alt="{{ $product->title }}" class="bg-placeholder-img card-img-top">
        @endif
        <div class="card-body">
            <a href="{{ route('products.show', $product) }}" class="card-link">
                {{ $product->title }}
            </a>
            <small class="text-muted">
                {{ $product->category->title }}
            </small>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span class="price">
                    <b>{{ price($product->price) }}</b> $
                </span>

                <button type="button" class="btn btn-sm btn-success">
                    <i class="fas fa-shopping-cart"></i> <span class="buy-text">Купить</span>
                </button>
            </div>
        </div>
    </div>
</div>