<?php
/**
 * @var $tabId
 * @var $content
 */
use yii\bootstrap\Tabs;

$tabItems = [
  'ask' => [
      'label' => 'Ask',
      'url' => ['ask'],
  ],
  'listMine' => [
      'label' => 'My questions',
      'url' => ['list-mine'],
  ],
  'listAll' => [
      'label' => 'All questions',
      'url' => ['list-all'],
  ],
];

// TODO: only add this tab for admin
$tabItems['adminAsk'] = [
  'label' => 'Manage questions',
  'url' => ['admin/ask/list'],
];

if (isset($tabItems[$tabId])) {
  $tabItems[$tabId]['active'] = TRUE;
  $tabItems[$tabId]['content'] = $content;
}

echo Tabs::widget([
    'items' => $tabItems
]);