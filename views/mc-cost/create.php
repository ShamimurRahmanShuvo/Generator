<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\McCost */

$this->title = 'Create Mc Cost';
$this->params['breadcrumbs'][] = ['label' => 'Mc Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mc-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
