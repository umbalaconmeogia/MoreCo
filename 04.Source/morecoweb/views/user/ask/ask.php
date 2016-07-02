<?php
/**
 * @var Ask $ask
 */

use app\models\Ask;
use yii\widgets\ActiveForm;
use app\components\Y;
use yii\helpers\Html;
use app\models\DictLanguage;
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]);?>
<?php
$selectLanguageHtml = Html::activeDropDownList(
    $ask, 'to_language_id', DictLanguage::getAllDictLanguageIdNameArray($ask->from_language_id));
$howToSayHtml = $form->field($ask, 'ask_content')->textInput()->label(false);
echo Y::t('How to say {askContent} in {selectLanguage} ', [
    'askContent' => $howToSayHtml,
    'selectLanguage' => $selectLanguageHtml,
]);
?>
<?php ActiveForm::end() ?>