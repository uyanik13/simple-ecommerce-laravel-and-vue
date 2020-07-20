<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push(config('app.name'), route('home'));
});

Breadcrumbs::for('products.show', function ($trail, \App\Models\Product $product) {
    $trail->parent('home');
    $trail->push($product->category->title, route('categories.show', $product->category));
    $trail->push($product->title, route('products.show', $product));
});

Breadcrumbs::for('categories.show', function ($trail, \App\Models\Category $category) {
    if($category->isChild()) {
        $trail->parent('categories.show', $category->parent);
    } else {
        $trail->parent('home');
    }

    $trail->push($category->title, route('categories.show', $category));
});