<?php

if(! function_exists('isRoute')) {

    /**
     * Helper to determinate if name of route is current route.
     *
     * @param $name
     * @return boolean
     */
    function isRoute($name)
    {
        return $name == Route::currentRouteName();
    }
}

if(! function_exists('price')) {

    /**
     * Helper to format price
     *
     * @param $amount
     * @return string
     */
    function price($amount)
    {
        $price = number_format($amount, 2, '.', ' ');

        return \Illuminate\Support\Str::replaceLast('.00', '', $price);
    }
}