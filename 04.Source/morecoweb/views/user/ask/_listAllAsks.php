<?php
/**
 * @var Language $model
 */
use yii\helpers\Html;
?>
<hr />
<div class="ask">
    Code <?= Html::encode($model->code) ?><br />
    <?php foreach ($model->dictLanguageNames as $dictLanguageName) {
      echo $dictLanguageName->name . ', ';
    }?>
</div>