<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <h1>
        <img height="50px" src="<?=\Yii::$app->request->BaseUrl?>/img/room.png"/>
        <span style="vertical-align: middle;">Rooms: <?= Html::encode($this->title) ?></span></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>