<?php
// auto-generated by sfValidatorConfigHandler
// date: 2012/06/11 14:38:28

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  $validators = array();
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $validators = array();
  $validatorManager->registerName('username', 1, 'Please enter a username.', null, null, false);
  $validatorManager->registerName('password', 1, 'Please enter a password.', null, null, false);
  $context->getRequest()->setAttribute('fillin', array (
), 'symfony/filter');
}
