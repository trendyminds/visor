<?php
/**
 * Visor plugin for Craft CMS 3.x
 *
 * A simple admin overlay to get to the relevant areas of the Craft CMS control panel
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\visor;

use Craft;
use craft\base\Plugin;

use yii\base\Event;
use craft\events\TemplateEvent;
use craft\web\View;
use trendyminds\visor\assetbundles\VisorAsset;
use yii\base\InvalidConfigException;

/**
 * Class Visor
 *
 * @author    TrendyMinds
 * @package   Visor
 * @since     3.0.0
 */
class Visor extends Plugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Dynamically insert Visor if this is a site request and the user is signed in
        if (Craft::$app->getRequest()->getIsSiteRequest()) {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    try {
                        Craft::$app->getView()->registerAssetBundle(VisorAsset::class);
                    } catch (InvalidConfigException $e) {
                        Craft::error('Could not register the Visor asset bundle.');
                    }
                }
            );
        }
    }
}
