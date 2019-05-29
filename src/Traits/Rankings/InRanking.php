<?php


namespace Belvedere\FormMaker\Traits\Rankings;

use Belvedere\FormMaker\Listeners\RemoveFromRanking;
use Illuminate\Database\Eloquent\Model;

trait InRanking
{
    /**
     * Boot the listener.
     */
    protected static function bootInRanking()
    {
        static::deleted(function (Model $model) {
            event(new RemoveFromRanking($model));
        });
    }
}