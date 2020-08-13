<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<?php

$this->title = 'Countries';
if (!empty($this->title)) {
    $this->params['breadcrumbs'][] = $this->title;
}

?>

<h1>Countries</h1>

    <ul>
        <?php foreach ($countries as $country): ?>
            <li>
                <?= Html::encode("$country->code - $country->name")?>:
                <?= $country->population?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
