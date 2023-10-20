<?php

namespace app\components\traits;

use Yii;

trait ControllerDate
{
    private function dates()
    {
        $quarter = floor(date('m') / 3);
        if ($quarter == 0) {
            $quarter = 3;
        }
        $dates = Yii::$app->request->get('dates');
        if (!empty($dates)) {
            $dates = explode(' - ', $dates, 2);
        } else {
            $dates = [
                date('Y-m-d'),
                date('Y-m-d')
            ];
        }
        return [
            'today' => [
                mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                mktime(23, 59, 59, date('m'), date('d'), date('Y')),
            ],
            'yesterday' => [
                mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')),
                mktime(23, 59, 59, date('m'), date('d') - 1, date('Y')),
            ],
            '7days' => [
                mktime(0, 0, 0, date('m'), date('d') - 6, date('Y')),
                mktime(23, 59, 59, date('m'), date('d'), date('Y')),
            ],
            'month' => [
                mktime(0, 0, 0, date('m'), 1, date('Y')),
                mktime(23, 59, 59, date('m'), date('d'), date('Y')),
            ],
            '1month' => [
                mktime(0, 0, 0, date('m') - 1, 1, date('Y')),
                mktime(23, 59, 59, date('m'), 0, date('Y')),
            ],
            '3months' => [
                mktime(0, 0, 0, date('m') - $quarter - 3, 1, date('Y')),
                mktime(23, 59, 59, date('m') - $quarter, 0, date('Y')),
            ],
            'year' => [
                mktime(0, 0, 0, 1, 1, date('Y')),
                mktime(23, 59, 59, 12, 31, date('Y')),
            ],
            'last_year' => [
                mktime(0, 0, 0, date('m')+1, 1, date('Y') -1),
                mktime(23, 59, 59, date('m') + 1, 0, date('Y')),
            ],
            'custom' => [
                strtotime($dates[0]),
                strtotime($dates[1] ?? $dates[0]) + 3600 * 24 - 1,
            ],
        ];
    }
}