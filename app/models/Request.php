<?php

namespace App\Models;

class Request extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requests';

    public function bundle()
    {
        return $this->belongsTo('App\Models\Bundle');
    }
}
