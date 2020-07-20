@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components._breadcrumb', ['data' => $category])
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    @foreach($category->products as $product)
                        @include('products._item')
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($category->children as $child)
                                <a href="{{ route('categories.show', $child) }}" class="list-group-item">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection