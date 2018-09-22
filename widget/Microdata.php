<?php

namespace app\widgets;

use Yii;
use app\models\Tickets;
use app\models\Currency;
use app\models\Location;
use yii\helpers\Url;

class Microdata
{
    public function init()
    {
        parent::init();

        $registration = Url::to(['site/view', 'alias' => 'reg'], true);
        $currency = Currency::findById(Yii::$app->show->valute_id);
        $tickets = Tickets::findAvailable(true);

        $ticketsAll = [];
        foreach ($tickets as $key => $ticket)
        {
            if ($ticket->promo == '')
            {
                $ticketsAll[] =
                '{
                    "@type":"Offer",
                    "name":"' . addslashes($ticket->name) . '",
                    "price":"' . $ticket->price . '",
                    "priceCurrency":"' . $currency . '",
                    "validFrom":"' . date("Y-m-d\TH:i", strtotime($ticket->sale_start)) . '",
                    "url":"' . $registration . '",
                    "availability":"http://schema.org/PreOrder"
                }';
            }
        }

        $this->data['icons'] = [
            'facebook' => 'fa fa-facebook',
            'vkontakte' => 'fa fa-vk',
            'twitter' => 'fa fa-twitter',
            'pinterest' => 'fa fa-pinterest',
            'linkedin' => 'fa fa-linkedin',
            'odnoklasniki' => 'fa fa-odnoklasniki',
            'googleplus' => 'fa fa-google-plus',
            'instagram' => 'fa fa-instagram',
            'youtube' => 'fa fa-youtube',
            'telegram' => 'fa fa-telegram',
        ];
        
        $this->data['registration'] = $registration;
        $this->data['currency'] = $currency;
        $this->data['country'] = Location::findById(Yii::$app->show->location_id);
        $this->data['phone'] = Location::findById(Yii::$app->show->location_id);
        $this->data['type'] = ShowsType::find()->andWhere(['id' => Yii::$app->show->type_id])->one();
        $this->data['ticketsAll'] = $ticketsAll;
    }

    /**
     * вывод
     */
    public function run()
    {
        $this->data['links'] = $this->links;

        return parent::run();
    }
}