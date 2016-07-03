<?php
use yii\helpers\Html;
use app\controller\admin\AskController;
use app\components\Y;
?>

<div class="page-header">
  <h1><?= Y::t('admin_view_asks') ?></h1>
</div>

<div class="ask">
<?= Html::encode($ask->ask_content)?> <br/>
<?= Html::a('Back to List', ['admin/ask/list']) ?>
</div>