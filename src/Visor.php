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

use trendyminds\visor\services\VisorService as VisorServiceService;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

/**
 * Class Visor
 *
 * @author    TrendyMinds
 * @package   Visor
 * @since     2.0.0
 *
 * @property  VisorServiceService $visorService
 */
class Visor extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Visor
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '2.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'visor',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );

        // Register our site routes
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                // If the user isn't logged in, return and move on.
                if (Craft::$app->getUser()->getIsGuest())
                {
                    return false;
                }

                Craft::$app->view->hook('visor', function (array &$context) {
                    // Set the title to something in case we're not in an entry
                    $entry = (object) [
                        "title" => Craft::$app->getConfig()->general->siteName
                    ];

                    // If we are in an entry context, use it in place of our dummy object
                    if (isset($context["entry"]))
                    {
                        $entry = $context["entry"];
                    }

                    return Visor::$plugin->visorService->render($entry);
                });
            }
        );
    }
}
