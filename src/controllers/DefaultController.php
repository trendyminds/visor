<?php

namespace trendyminds\visor\controllers;

use trendyminds\visor\Visor;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use craft\web\View;

use craft\base\Element;
use craft\elements\Category;
use craft\elements\Entry;
use Solspace\Calendar\Elements\Event;

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

        // Render a template using our custom variables to determine what a user should and shouldn't see
        $html = Craft::$app->view->renderTemplate('visor/visor', [
            "element" => $this->_parseElement($element),
        ]);

        Craft::$app->view->setTemplateMode($oldMode);

        return $this->asRaw($html);
    }

    /**
     * Parses a given element and determines what, if anything, to show for each property in the Visor template
     *
     * @param Element $element
     *
     * @return void
     */
    private function _parseElement(Element $element = null)
    {
        if ($element === null) {
            return (object) [
                "title" => "",
                "type" => "",
                "cpUrl" => "",
                "editUrl" => "",
                "isUserEditable" => false
            ];
        }

        // Handle entries
        if (get_class($element) === "craft\\elements\\Entry") {
            /** @var Entry */
            $entry = $element;

            $cpUrl = UrlHelper::cpUrl() . "/entries/";

            if ($entry->getSection()->type === "single") {
                $cpUrl .= "singles";
            }

            if ($entry->getSection()->type !== "single") {
                $cpUrl .= $entry->getSection()->handle;
            }

            return (object) [
                "title" => $entry->title,
                "type" => $entry->getSection()->type === "single" ? "Singles" : $entry->getSection()->name,
                "cpUrl" => $cpUrl,
                "editUrl" => $entry->getCpEditUrl(),
                "isUserEditable" => Craft::$app->user->identity->can("editEntries:" . $entry->getSection()->uid)
            ];
        }

        // Handle categories
        if (get_class($element) === "craft\\elements\\Category") {
            /** @var Category */
            $category = $element;

            return (object) [
                "title" => $category->title,
                "type" => $category->group->name,
                "cpUrl" => UrlHelper::cpUrl() . "/categories/" . $category->group->handle,
                "editUrl" => $category->getCpEditUrl(),
                "isUserEditable" => Craft::$app->user->identity->can("editCategories:" . $category->group->uid)
            ];
        }

        // Handle events
        if (get_class($element) === "Solspace\\Calendar\\Elements\\Event") {
            /** @var Event */
            $event = $element;

            return (object) [
                "title" => $event->title,
                "type" => $event->getCalendar()->name,
                "cpUrl" => UrlHelper::cpUrl() . "/calendar/events/",
                "editUrl" => $event->getCpEditUrl(),
                "isUserEditable" => Craft::$app->user->identity->can("calendar-manageEventsFor:" . $event->getCalendar()->id)
            ];
        }

        // Set defaults if we did not properly identify the element type
        return (object) [
            "title" => "",
            "type" => "",
            "cpUrl" => "",
            "editUrl" => "",
            "isUserEditable" => false
        ];
    }
}
