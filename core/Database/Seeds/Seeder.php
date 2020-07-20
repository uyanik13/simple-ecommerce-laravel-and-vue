<?php

namespace Evention\Database\Seeds;

use \Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    /**
     * @param $class
     * @param array $attributes
     * @param int $count
     * @param bool $truncate
     * @param null $callback
     *
     * @return mixed
     */
    protected function callFactory($class, $attributes = [], $count = 10, $truncate = true, $callback = null)
    {
        if($truncate) {
            $class::truncate();
        }

        $models = factory($class, $count)->create($attributes);

        if(! is_null($callback)) {
            $models->each($callback);
        }

        return $models;
    }

    /**
     * @return $this
     */
    protected function createDefaultUser()
    {
        $this->callFactory(\App\Models\User::class, [
            'email' => 'admin@evention.com',
        ], 1, false);

        return $this;
    }
}