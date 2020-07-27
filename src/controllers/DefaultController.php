<?php

namespace trendyminds\visor\controllers;

use trendyminds\visor\Visor;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use craft\web\View;

/**
 * @author    TrendyMinds
 * @package   Visor
 * @since     3.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['access'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionAccess()
    {
        // If the user is a guest, return nothing
        if (Craft::$app->user->isGuest) {
            return $this->asRaw("");
        }

        // If the identity is not defined, return nothing
        if (!Craft::$app->user->identity) {
            return $this->asRaw("");
        }

        // If the user is logged in and cannot access the control panel, return nothing
        if (!Craft::$app->user->identity->can('accessCp')) {
            return $this->asRaw("");
        }

        // Grab the referring page and create a URI by removing the protocol and domain
        $uri = Craft::$app->request->referrer;
        $uri = preg_replace("/^.*" . Craft::$app->request->serverName . "\//", "", $uri);

        // Remove query strings
        $uri = preg_replace("/\?.*$/", "", $uri);

        // Attempt to get the element this URL is related to
        $element = Craft::$app->elements->getElementByUri($uri);

        // Send the value to the template to be returned as raw HTML
        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->view->renderTemplate('visor/visor', [ "entry" => $element ]);
        Craft::$app->view->setTemplateMode($oldMode);

        return $this->asRaw($html);

        // return $this->asJson([
        //     "data" => (object) [
        //         "referrer" => $uri,
        //         "siteName" => Craft::$app->config->general->siteName,
        //         "title" => $element ? $element->title : "",
        //         "cpEditUrl" => $element ? $element->getCpEditUrl() : "",
        //         "allEntries" => UrlHelper::cpUrl() . "/entries",
        //         "controlPanel" => UrlHelper::cpUrl(),
        //         "signOut" => "/" . Craft::$app->config->general->logoutPath
        //     ]
        // ]);
    }
}
