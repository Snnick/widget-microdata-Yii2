<?php
namespace app\models;

use Yii;


class Tickets
{
    public $saleTickets;
    public static function tableName()
    {
        return 'tickets_'.Yii::$app->language;
    }

    public static function getOrdersTickets()
    {
        $tickets = self::tableName();
        $ordersTickets = OrdersTickets::tableName();
        $ordersInfo = OrdersInfo::tableName();

        return self::find()
            ->select(["{$tickets}.id", "{$tickets}.max_count", 'saleTickets' => 'COUNT(ot.id)'])
            ->join("JOIN", "{$ordersTickets} ot", "{$tickets}.id = ot.ticket_id")
            ->join("JOIN", "{$ordersInfo} oi", "ot.order_id = oi.order_id")
            ->andWhere([
                "{$tickets}.status" => self::STATUS_ENABLED,
                'ot.status' => self::STATUS_ENABLED,
                'oi.status' => self::STATUS_ENABLED,
                'show_id' => Yii::$app->show->id,
            ])
            ->groupBy("{$tickets}.id")
            ->all();
    }

    public static function findByEvent()
    {
        return self::find()
            ->andWhere([
                'show_id' => Yii::$app->show->id,
            ])
            ->orderBy(['ord' => SORT_DESC])
            ->all();
    }

    public static function findAvailable($dateFilter = false)
    {
        $query = self::find()
            ->andWhere([
                'show_id' => Yii::$app->show->id,
                'status' => self::STATUS_ENABLED,
            ]);

        if($dateFilter)
        {
            $query->andWhere(['<','sale_start',date('Y-m-d H:i:s', time())]);
            $query->andWhere(['>','sale_finish',date('Y-m-d H:i:s', time())]);
        }

        $query->orderBy(['ord' => SORT_DESC]);
        $result = $query->all();

        return $result;
    }
}