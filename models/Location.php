<?php
namespace app\models;

use Yii;


class Location extends BaseModel
{
    public static function tableName()
    {
        return 'location_'.Yii::$app->language;
    }

    public static function findById($id)
    {
        return self::find()->andWhere([
            'id' => $id,
        ])->one();
    }
}