<?php

namespace xuiax\chartjs;

use xuiax\chartjs\ChartAsset;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class Chart extends Widget
{
    const TYPE_LINE = 'line';
    const TYPE_BAR = 'bar';
    const TYPE_RADAR = 'radar';
    const TYPE_POLAR_AREA = 'polarArea';
    const TYPE_PIE = 'pie';
    const TYPE_DOUGHNUT = 'doughnut';
    const TYPE_BUBBLE = 'bubble';

    public $title;
    public $type;
    public $data = [];
    public $options = [];
    public $template_data = [];

    public function init()
    {
        parent::init();
        $this->template_data = [
            'tag' => $this->template_data['tag'] ?? 'span',
            'options' => $this->template_data['options'] ?? ['class' => 'col-sm-12'],
        ];
        $this->type = $this->type ? $this->type : 'line';
        $this->data = Json::encode($this->data);
        $this->options = Json::encode($this->options);
    }

    public function run()
    {
        $this->registerScript();
        $template = isset($this->title) ? Html::tag('h3', $this->title) : '';
        echo $template . Html::tag($this->template_data['tag'],
            Html::tag('canvas', '', ['id' => $this->id]), $this->template_data['options']);
    }

    public function registerScript()
    {
        $view = $this->getView();
        ChartAsset::register($view);

        $js = <<<JS
            var ctx = $("#$this->id");
            var myChart = new Chart(ctx, {
                type: '$this->type',
                data: $this->data,
                options: $this->options
            });
JS;
        $view->registerJs($js);
    }
}