<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaintenanceItem */

$this->title = 'Create Maintenance Item';
$this->params['breadcrumbs'][] = ['label' => 'Maintenance Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
