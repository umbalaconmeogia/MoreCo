<?php
use app\models\Ask;
use app\controllers\admin\AskController;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\DictSentenceTranslation;
use app\components\Y;

/**
 * @var Ask $ask
 */
?>
<hr />
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

        <?= $form->field($fromDictSentenceTrans, '[0]translated_sentence')->textInput()->label(Y::t('From language')) ?><br>
        <?= Html::activeHiddenInput($fromDictSentenceTrans, '[0]dict_language_id') ?>
        <?= $form->field($toDictSentenceTrans, '[1]translated_sentence')->textInput()->label(Y::t('To language')) ?><br>
        <?= Html::activeHiddenInput($toDictSentenceTrans, '[1]dict_language_id') ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'Submit']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>