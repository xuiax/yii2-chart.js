<?php

namespace xuiax\chartjs;

use yii\web\AssetBundle;

class ChartAsset extends AssetBundle
{
    public $sourcePath = '@bower/chart.js';

    public $css = [];

    public $js = [
        'dist/Chart.js'
    ];

    public function init()
    {
        parent::init();
    }
}