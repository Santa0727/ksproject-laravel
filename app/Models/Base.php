<?php

namespace App\Models;

class Base
{

    public static function setPageinfo(&$pageinfo, $total) {
        if (empty($pageinfo['page'])) {
            $pageinfo['page'] = 1;
        }
        if (empty($pageinfo['rows'])) {
            $pageinfo['rows'] = 10;
        }
        if (empty($total)) {
            $pageinfo['total'] = 0;
        } else {
            $pageinfo['total'] = $total;
            if (($pageinfo['page'] - 1) * $pageinfo['rows'] + 1 > $total) {
                $pageinfo['page'] = $pageinfo['page'] - 1;
            }
        }
    }

}