<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

abstract class Entity extends Model
{
    public function getYearCreated() {
        $datetime = Carbon::parse($this->year_created);
        return $datetime->toFormattedDateString();
    }

    public function getNiceYearCreated() {
        $datetime = Carbon::parse($this->year_created);
        return $datetime->format('Y-m-d');
    }

}
