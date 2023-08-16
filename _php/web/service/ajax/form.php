<?php

$formId = json_decode($_REQUEST['formId'], true);

$template = $formId['templateid'];
$meta = \kmucms\uipages\PageTemplate::getInputMeta($template);

$traceId = $formId['traceid'];
$path = kmucms\Format::trimexplode('/', $formId['path']);
$db = kmucms\App::getInstance()->getDb();
$row = $db->getRowByCondition('vartrace', "traceid=:traceid", ['traceid' => $traceId]);
$data = json_decode($row['data'] ?? '[]', true);
$current = &$data;
foreach ($path as $step) {
  if (!isset($current[$step])) {
    $new = [];
    $current[$step] = $new;
  }
  $current = &$current[$step];
}
$item = $current;
unset($current);

$form = json_decode($item['form'], true);
$input = $_REQUEST['item'];

$error = '';
$formstr = '';
foreach ($form as $k => $val) {
  if ($val['mandatory'] && (!isset($input[$k]) || (trim($input[$k]) == ''))) {
    echo '"' . $val['label'] . '" ist nicht gesetzt.';
    return;
  }
  if ($val['type'] == 'email' && !filter_var($input[$k], FILTER_VALIDATE_EMAIL)) {
    echo '"' . $val['label'] . '" keine gültige E-Mail eingetragen.';
    return;
  }
  $formstr .= $val['label'] . ":\n" . $input[$k] . "\n\n";
}



if ($error === '') {
  $subject = $item['subject'];
  $email = $item['tomail'];
  if (empty($input['robokumpel'])) {
    kmucms\App::getInstance()->getEmail()->submit($email, $subject, $formstr);
  }
}

