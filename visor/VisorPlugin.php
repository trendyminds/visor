<?php
/**
 * Visor plugin for Craft CMS
 *
 * A simple admin overlay to get to the relevant areas of the Craft control panel.
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2016 TrendyMinds
 * @link      http://trendyminds.com
 * @package   Visor
 * @since     1.0.0
 */

namespace Craft;

class VisorPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
      if ( craft()->userSession->isLoggedIn() )
      {
        craft()->templates->hook('addVisor', function(&$context) {
          // Setup a new array to be passed into the renderVisor service
          $data = array();

          /**
           * If we're using an `entry` variable in the template, use it for the context.
           * Otherwise, default to the matched element.
           */
          if (isset($context['entry'])) {
            $data['entry'] = $context['entry'];
          } else {
            $data['entry'] = craft()->urlManager->getMatchedElement();
          }

          // Pass the data to the renderVisor service
          return craft()->visor->renderVisor($data);
        });
      }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Visor');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('A simple admin overlay to get to the relevant areas of the Craft CMS control panel.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/trendyminds/visor/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/trendyminds/visor/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.1';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'TrendyMinds';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://trendyminds.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }
}
