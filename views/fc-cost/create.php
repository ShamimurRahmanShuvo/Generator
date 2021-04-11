<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FcCost */

$this->title = 'Create Fc Cost';
$this->params['breadcrumbs'][] = ['label' => 'Fc Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fc-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
