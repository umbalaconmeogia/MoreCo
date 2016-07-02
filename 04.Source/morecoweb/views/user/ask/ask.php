<?php
$content = 'Please select a tab';
echo $this->render('/common/_tabs', ['tabId' => 'ask', 'content' => $content]);
