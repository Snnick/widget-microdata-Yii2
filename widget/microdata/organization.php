<?php
use yii\helpers\Url;
?>

<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "location":{
    "@type":"Place",
        "address": {
            "@type": "PostalAddress",
                "addressCountry":"<?= Yii::$app->params['microMarkingOrg']['addressCountry']?>",
                "addressLocality": "<?= $country ?>"
                    }
                },
    "brand":"<?= addslashes(Yii::$app->show->name) ?>",
    "logo":"<?= Yii::$app->show->imagePath ?>",
    "telephone":"<?=$phone ?>",
    "name":"<?= addslashes(Yii::$app->show->name) ?>",
    "url":"<?= Url::to('/', true)?>",
    "sameAs":["<?=implode('", "', $links)?>"],
    "department": [{
    "@context": "http://schema.org",
    "@type": "Organization",
    "location": {
    "@type":"Place",
    "address": {
    "@type": "PostalAddress",
    "addressLocality": "<?= $country ?>",
    "streetAddress": "<?= strip_tags(addslashes(Yii::$app->show->address)) ?>",
    "postalCode": "<?= Yii::$app->params['microMarkingOrg']['postalCode']?>"
    },
    "geo": {
           "@type": "GeoCoordinates",
                "latitude": "<?= Yii::$app->show->google_maps_latitude ?>",
                "longitude": "<?= Yii::$app->show->google_maps_longitude ?>"
           }
          },
          "telephone": "<?=$phone ?>"
       }]
    }
</script>