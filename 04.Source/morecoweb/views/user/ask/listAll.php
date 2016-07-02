<?php
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\models\Ask;

$dataProvider = new ActiveDataProvider([
    'query' => Ask::find(),
    'pagination' => [
        'pageSize' => 10,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_listAllAsks',
]);
?>