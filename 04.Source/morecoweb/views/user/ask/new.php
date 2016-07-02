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
// $howToSayHtml = $form->field($ask, 'ask_content')->textInput()->label(false);
echo Y::t('how_to_say_in_language_the_following_sentence', [
//     'askContent' => $howToSayHtml,
    'fromLanguage' => $ask->getFromLanguageStr(BaseController::getUserLaguageId()),
    'toLanguage' => $selectLanguageHtml,
]);

echo '<br /><br />' . $form->field($ask, 'ask_content')->textInput()->label(false);
?>
<br /><br />
<div><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></div>
<?php ActiveForm::end() ?>