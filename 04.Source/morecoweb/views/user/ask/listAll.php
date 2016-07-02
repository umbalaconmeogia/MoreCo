<?php
/**
 * @var ActiveQuery $query
 */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\components\BaseController;

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_listAskItems',
]);
?>