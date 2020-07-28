<?php
namespace trendyminds\visor\assetbundles;

use Craft;
use craft\web\AssetBundle;

class VisorAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================
    public function init()
    {
        $this->sourcePath = "@trendyminds/visor/resources";
        $this->js = ["visor.js"];

        parent::init();
    }
}
