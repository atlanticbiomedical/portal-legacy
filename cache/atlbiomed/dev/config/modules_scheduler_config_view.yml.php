<?php
// auto-generated by sfViewConfigHandler
// date: 2012/09/22 21:24:45
$context  = $this->getContext();
$response = $context->getResponse();

if ($this->actionName.$this->viewName == 'techMapSuccess')
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'indexSuccess')
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'sendEmailSuccess')
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'techMapSuccess')
{
  $this->setDecoratorTemplate('techMap'.$this->getExtension());
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
  $response->addJavascript('/sf/prototype/js/prototype');
}
else if ($templateName.$this->viewName == 'indexSuccess')
{
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
  $response->addStylesheet('/css/email.css', '', array ());
  $response->addJavascript('/js/scheduler');
}
else if ($templateName.$this->viewName == 'sendEmailSuccess')
{
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
  $response->addStylesheet('/css/email.css', '', array ());
  $response->addJavascript('/js/scheduler');
}
else
{
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
}

