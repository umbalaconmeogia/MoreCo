<?php
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\models\Ask;

$dataProvider = new ActiveDataProvider([
    'query' => Ask::find(),
//     'pagination' => [
//         'pageSize' => 20,
//     ],
]);
$content = ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_listAllAsks',
]);
echo $this->render('/common/_tabs', ['tabId' => 'listAll', 'content' => $content]);
?>