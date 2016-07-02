<?php
/**
 * @var Ask $model
 */
use yii\helpers\Html;
use app\components\Y;
use app\components\BaseController;
use app\models\Ask;
use app\models\DictSentence;
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
<?php if ($model->answer_status == Ask::ANSWER_STATUS_CLOSED && $model->answer_dict_sentence_id) { ?>
<?= Y::t('reply'); ?>
<div class="ask">
  <strong><?php
    $dictSentence = DictSentence::find()->where(['id' => $model->answer_dict_sentence_id])->one();
    $dictSentenceTranslation = $dictSentence->getDictSentenceTranslation($model->to_language_id);
    echo Html::encode($dictSentenceTranslation->translated_sentence);
  ?></strong>
</div>
<?php } ?>
</div>