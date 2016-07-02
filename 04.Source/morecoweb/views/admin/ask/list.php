<?php
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\models\Ask;
use app\models\DictLanguage;
use app\models\DictLanguageName;

$mapLanguage = DictLanguageName::findAll(['in_language_id' => 1]);
$mapLanguage = DictLanguageName::hashModels($mapLanguage, 'dict_language_id');

$dataProvider = new ActiveDataProvider([
    'query' => Ask::find()->orderBy(['answer_status' => SORT_ASC]),
    'pagination' => [
        'pageSize' => 10,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
	'viewParams' => ['mapLanguage' => $mapLanguage],
]);
?>