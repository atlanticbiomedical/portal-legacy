<?php
// auto-generated by sfViewConfigHandler
// date: 2012/06/13 17:08:20
$context  = $this->getContext();
$response = $context->getResponse();


  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (!$context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Atlantic Biomedical', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', 'Atlantic Biomedical', false, false);
  $response->addMeta('keywords', 'Atlantic Biomedical, medical, equipment, repair', false, false);
  $response->addMeta('language', 'en', false, false);

  $response->addStylesheet('main', '', array ());
  $response->addStylesheet('client', '', array ());
  $response->addStylesheet('user', '', array ());
  $response->addStylesheet('theme', '', array ());
  $response->addJavascript('workorder');


