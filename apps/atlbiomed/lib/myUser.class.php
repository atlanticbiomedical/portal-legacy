<?php

class myUser extends sfBasicSecurityUser
{

public function initialize($context, $parameters = null)
  {
    $this->context = $context;

    $this->parameterHolder = new sfParameterHolder();
    $this->parameterHolder->add($parameters);

    $this->attributeHolder = new sfParameterHolder(self::ATTRIBUTE_NAMESPACE);

    // read attributes from storage
    $attributes = $context->getStorage()->read(self::ATTRIBUTE_NAMESPACE);
    if (is_array($attributes))
    {
      foreach ($attributes as $namespace => $values)
      {
        $this->attributeHolder->add($values, $namespace);
      }
    }

    // set the user culture to sf_culture parameter if present in the request
    // otherwise
    //  - use the culture defined in the user session
    //  - use the default culture set in i18n.yml
    if (!($culture = $context->getRequest()->getParameter('sf_culture')))
    {
      if (null === ($culture = $context->getStorage()->read(self::CULTURE_NAMESPACE)))
      {
        $culture = sfConfig::get('sf_i18n_default_culture', 'en');
      }
    }

    $this->setCulture($culture);

    // read data from storage
    $storage = $this->getContext()->getStorage();

    $this->authenticated = $storage->read(self::AUTH_NAMESPACE);
    $this->credentials   = $storage->read(self::CREDENTIAL_NAMESPACE);
    $this->lastRequest   = $storage->read(self::LAST_REQUEST_NAMESPACE);

    if ($this->authenticated == null)
    {
      $this->authenticated = false;
      $this->credentials   = array();
    }
    else
    {
      // Automatic logout logged in user if no request within [sf_timeout] setting
      if (0 != sfConfig::get('sf_timeout') && null !== $this->lastRequest && (time() - $this->lastRequest) > sfConfig::get('sf_timeout'))
      {
        if (sfConfig::get('sf_logging_enabled'))
        {
          $this->getContext()->getLogger()->info('{sfUser} automatic user logout due to timeout');
        }
        $this->setTimedOut();
        $this->setAuthenticated(false);
      }
    }

    $this->lastRequest = time();

  }

}
