<?php
namespace app\models;

use Yii;


class Currency
{
    public static function tableName()
    {
        return 'valute_'.Yii::$app->language;
    }

    public static function findById($id)
    {
        return self::find()->andWhere([
            'id' => $id,
        ])->one();
    }
}