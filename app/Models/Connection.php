<?php

namespace App\Models;

use App\QueryBuilders\ConnectionBuilder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Connection extends Pivot
{
    public function newEloquentBuilder($query): ConnectionBuilder
    {
        return new ConnectionBuilder($query);
    }
}
