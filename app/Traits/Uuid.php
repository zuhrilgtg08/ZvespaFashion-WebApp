<?php 

namespace App\Traits;
use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid as Generator;

trait Uuid {
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            try {
                $model->uuid = Generator::uuid4()->toString(); 
            } catch(UnsupportedOperationException $ex) {
                abort(500, $ex->getMessage());
            }
        });
    }
}