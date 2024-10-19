<?php namespace App\Repository\Apis;

abstract class Api {

    /*
     * Transforms a collection of lessons
     * @param $lessons
     * @return array
     */
    public function apiCollection(array $items){

        return array_map([$this, 'api'], $items);

    }

    public abstract function api($item);

}