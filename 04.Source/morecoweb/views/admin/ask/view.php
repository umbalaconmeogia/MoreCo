<?php
use yii\helpers\Html;
use app\controller\admin\AskController;
?>

<hr />
<div class="ask">
<?= Html::encode($ask->ask_content)?> <br/>
<?= Html::a('Back to List', 'list') ?>
</div>