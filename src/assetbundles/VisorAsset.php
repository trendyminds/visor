<?php
namespace trendyminds\visor\assetbundles;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class VisorAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    public function init()
    {
        $this->sourcePath = "@trendyminds/visor/resources";
        $this->css = ['visor.css'];
        $this->js = ['visor.js'];

        parent::init();
    }
}
