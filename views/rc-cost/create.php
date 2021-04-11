<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RcCost */

$this->title = 'Create Rc Cost';
$this->params['breadcrumbs'][] = ['label' => 'Rc Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rc-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
