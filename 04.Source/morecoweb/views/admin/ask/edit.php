<?php
use app\components\BaseController;
use app\components\Y;
use app\controllers\admin\AskController;
use app\models\Ask;
use app\models\DictSentenceTranslation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var Ask $ask
 */
?>
<div class="page-header">
  <h1><?= Y::t('admin_edit_asks') ?></h1>
</div>
<div>
<label><?= Y::t('label_question') ?>:</label><br/>
<?= Y::t('how_to_say_in_language_the_following_sentence', [
	    'fromLanguage' => $ask->getFromLanguageStr(BaseController::getUserLaguageId()),
	    'toLanguage' => $ask->getToLanguageStr(BaseController::getUserLaguageId()),
])?>
</div>
<div class="ask">
	<?php $form = ActiveForm::begin([
        'id' => 'edit-form',
        'action' => ['answer-ask', 'id' => $ask->id],
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]) ?>
        <?= Html::encode($ask->ask_content) ?><br>
    
    	<br/><label><?= Y::t('label_answer') ?>:</label><br/>
        
        <?= $form->field($fromDictSentenceTrans, '[0]translated_sentence')
        			->textInput()
        			->label(Y::t('from_language', [
						'fromLanguage' => $ask
						->getFromLanguageStr(BaseController::getUserLaguageId())])) 
        ?>
        <?= Html::activeHiddenInput($fromDictSentenceTrans, '[0]dict_language_id') ?>
        <?= $form->field($toDictSentenceTrans, '[1]translated_sentence')
        			->textInput()
        			->label(Y::t('to_language', [
						'toLanguage' => $ask
						->getToLanguageStr(BaseController::getUserLaguageId())])) ?>
        <?= Html::activeHiddenInput($toDictSentenceTrans, '[1]dict_language_id') ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'Submit']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>