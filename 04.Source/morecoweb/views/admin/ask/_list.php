<?php
/**
 * @var Ask $model
 * @param Ask $model
 */
use app\models\Ask;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<hr />
<div class="ask">
    <?= Html::a(Html::encode($model->ask_content), ['edit', 'id' => $model->id]) ?><br />
    <?= Html::encode($mapLanguage[$model->from_language_id]->name) ?><br />
	<?= Html::encode($model->getAnswerStatusStr()) ?><br />
</div>