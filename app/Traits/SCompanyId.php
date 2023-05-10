<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CompanyId
{
    public static function getCompanyId()
    {
        $model = new self;
        $id = DB::select("SHOW TABLE STATUS LIKE '" . $model->getTable() . "'");
        $next_id = $id[0]->Auto_increment;
        return $next_id;
    }
}
