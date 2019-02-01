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

        Craft::$app->view->hook('visor', function(array &$context) {
            return Visor::$plugin->visorService->render($context["entry"]);
        });
    }
}
