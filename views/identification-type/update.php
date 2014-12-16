<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IdentificationType */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Identification Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->identificationtypeid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="identification-type-update">

    <h1>
        <img height="50px" src="<?=\Yii::$app->request->BaseUrl?>/img/card.png"/>
        <span style="vertical-align: middle;">Identification Types: <?= Html::encode($this->title) ?></span></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>