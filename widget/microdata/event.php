<?php
use yii\helpers\Url;
?>

<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Event",
        "name": "<?=addslashes(Yii::$app->show->name)?>",
        "url": "<?=Url::home(true)?>",
        "description": "<?=addslashes(preg_replace('#[\n\r](<[^>]+>)#', ' ', Yii::$app->show->small));?>",
        "image": "<?=Yii::$app->show->imagePath?>",
        "startDate": "<?=date( "Y-m-d\TH:i", strtotime(Yii::$app->show->date_start))?>",
        "endDate": "<?=date( "Y-m-d\TH:i", strtotime(Yii::$app->show->date_end))?>",
        "performer": {
            "@type": "PerformingGroup",
            "name": "<?=$type?>"
        },
        "location": {
            "@type": "Place",
            "name": "<?=addslashes(Yii::$app->show->place_name)?>",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "<?=addslashes(Yii::$app->show->address)?>",
                "addressLocality": "<?=addslashes(Yii::$app->show->address)?>",
                "addressCountry": "<?=$country?>"
            }
        }
        <?php if(count($ticketsAll) > 0) { ?>,
        "offers": [<?=implode(',', $ticketsAll)?>]
        <?php } ?>
    }
</script>