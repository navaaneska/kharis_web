<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait CodeGenerate
{

    public function getCode()
    {
        $q = DB::table('event_transaksies')->select(DB::raw('MAX(RIGHT(order_id,9)) as kd_max'));
        $prx = 'INV-BL-' . date('y') . '-' . date('m') . '-';
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%09s", $tmp);
            }
        } else {
            $kd = $prx . "000000001";
        };

        return $kd;
    }
}
