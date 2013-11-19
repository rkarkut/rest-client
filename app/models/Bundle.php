<?php

namespace App\Models;

class Bundle extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bundles';

    public function requests()
    {
        return $this->hasMany('App\Models\Request');
    }

}
