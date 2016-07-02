<?php
/**
 * @var Ask $ask
 */

use app\models\Ask;
use yii\widgets\ActiveForm;
use app\components\Y;
use yii\helpers\Html;
use app\models\DictLanguage;
use app\components\BaseController;
?>
<div class="page-header">
  <h1><?= Y::t('post_question') ?></h1>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'ask-form',
    'action' => ['ask'],
    'options' => ['class' => 'form-horizontal'],
]);?>
<?= $form->errorSummary($ask); ?>
<?php
echo Html::activeHiddenInput($ask, 'from_language_id');

$selectLanguageHtml = Html::activeDropDownList(
    $ask, 'to_language_id', DictLanguage::getAllDictLanguageIdNameArray(BaseController::getUserLaguageId()));
echo Y::t('how_to_say_in_language_the_following_sentence', [
    'fromLanguage' => $ask->getFromLanguageStr(BaseController::getUserLaguageId()),
    'toLanguage' => $selectLanguageHtml,
]);

echo '<br /><br />' . $form->field($ask, 'ask_content')->textInput()->label(false);
?>
<div><?= Html::submitButton(Y::t('submit'), ['class' => 'btn btn-primary']) ?></div>
<?php ActiveForm::end() ?>