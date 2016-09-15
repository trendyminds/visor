<?php
/**
 * Visor plugin for Craft CMS
 *
 * Visor Service
 *
 * @author    TrendyMinds
 * @copyright Copyright (c) 2016 TrendyMinds
 * @link      http://trendyminds.com
 * @package   Visor
 * @since     1.0.0
 */

namespace Craft;

class VisorService extends BaseApplicationComponent
{
  public function renderVisor($data = array())
  {
      // Temporarily redirect template path to plugin path
      $oldTemplatesPath = craft()->templates->getTemplatesPath();
      $newTemplatesPath = craft()->path->getPluginsPath() . 'visor/templates/';
      craft()->templates->setTemplatesPath($newTemplatesPath);

      // Render Visor and pipe in the $data array
      $barHtml = craft()->templates->render('_overlay', $data);

      print($barHtml);

      // Return templates path to original location
      craft()->templates->setTemplatesPath($oldTemplatesPath);

      // Insert CSS and JS files
      craft()->templates->includeJsResource('visor/js/visor.js');
      craft()->templates->includeCssResource('visor/css/visor.css');
  }
}
