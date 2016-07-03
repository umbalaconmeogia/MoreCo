<?php
/**
 * @var Ask $model
 * @param Ask $model
 */
use app\models\Ask;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\BaseController;
use app\components\Y;
?>

<div>
<hr />
	<?= Y::t('how_to_say_in_language_the_following_sentence', [
	    'fromLanguage' => $model->getFromLanguageStr(BaseController::getUserLaguageId()),
	    'toLanguage' => $model->getToLanguageStr(BaseController::getUserLaguageId()),
	])?>
	<div class="ask">
	  <strong><?= Html::a(Html::encode($model->ask_content), ['edit', 'id' => $model->id]) ?></strong>
	</div>
	<div class="ask">
	  <strong><?= Html::encode($mapLanguage[$model->from_language_id]->name) ?></strong>
	</div>
	<div class="ask">
	  <strong><?= Html::encode($model->getAnswerStatusStr()) ?></strong>
	</div>
</div>