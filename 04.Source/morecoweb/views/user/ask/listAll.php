<?php
/**
 * @var ActiveQuery $query
 * @var string $pageHeader
 */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\components\BaseController;
?>
<div class="page-header">
  <h1><?= $pageHeader ?></h1>
</div>
<?php
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