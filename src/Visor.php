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
use craft\web\UrlManager;

use yii\base\Event;
use yii\base\InvalidConfigException;

use trendyminds\visor\assetbundles\VisorAsset;

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

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function () {
                // When the Visor hook is used, register the asset bundle for the JS functionality
                Craft::$app->view->hook('visor', function () {
                    try {
                        Craft::$app->getView()->registerAssetBundle(VisorAsset::class);
                    } catch (InvalidConfigException $e) {
                        Craft::error('Could not register the Visor asset bundle.');
                    }
                });
            }
        );
    }
}
