<?php
/**
 * @var Ask $model
 */
use yii\helpers\Html;
use app\components\Y;
use app\components\BaseController;
?>
<div>
<hr />
<?= Y::t('how_to_say_in_language_the_following_sentence', [
    'fromLanguage' => $model->getFromLanguageStr(BaseController::getUserLaguageId()),
    'toLanguage' => $model->getToLanguageStr(BaseController::getUserLaguageId()),
])?>
<div class="ask">
  <strong><?= Html::encode($model->ask_content) ?></strong>
</div>
</div>