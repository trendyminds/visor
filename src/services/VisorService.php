<?php
/**
 * Visor plugin for Craft CMS 3.x
 *
 * A simple admin overlay to get to the relevant areas of the Craft CMS control panel
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\visor\services;

use trendyminds\visor\Visor;

use Craft;
use craft\base\Component;
use craft\web\View;

/**
 * @author    TrendyMinds
 * @package   Visor
 * @since     2.0.0
 */
class VisorService extends Component
{
    /*
     * @return mixed
     */
    public function render($entry)
    {
        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

        $html = Craft::$app->view->renderTemplate('visor/visor', [
            "entry" => $entry
        ]);

        Craft::$app->view->setTemplateMode($oldMode);

        return $html;
    }
}
