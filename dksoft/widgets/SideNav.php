<?php
namespace dksoft\widgets;

use yii\base\Widget;

class SideNav extends Widget
{
    public $items;
    public $header = '';

    const PREV_TAG = "<nav class='dk_sidenav'>\n<div class='hamburger hamburger--arrow'>\n<div class='hamburger-box'>\n<div class='hamburger-inner'></div>\n</div>\n</div>\n<div class='shadow'>\n</div>\n<ul class='nav nav-pills nav-stacked'>";
    const POST_TAG = "</ul></nav>";
    const RIGHT_ICON = "<span class='indicator glyphicon glyphicon-chevron-right'></span>";
    const ICON_CLASS = "icon glyphicon glyphicon-";
    const LINK_CLASS = "class = 'dropdown_toggle'";

    private $headerH3Template = "<li class='header'><h3>{label}</h3></li>";
    private $headerH4Template = "<li class='header'><span class='indicator glyphicon glyphicon-chevron-left'></span><h4>{label}</h4></li>";
    private $spanTemplate = "<span class='{class}'></span>";
    private $itemTemplate = "<li>\n<a {class} href='{url}'>{icon}{label}{right_icon}</a>\n{inner_items}\n</li>";
    private $submenuTemplate = "\n<ul class='nav nav-pills nav-stacked dropdown_menu'>\n{items}\n</ul>\n";

    public function init()
    {
        SideNavAsset::register($this->getView());
    }

    public function run()
    {
        return self::PREV_TAG . $this->renderItems($this->items, $this->header, true) . self::POST_TAG;
    }

    private function renderItems($items, $header, $is_main = false)
    {
        $lines = $this->renderHeader($header, $is_main);
        foreach ($items as $item) {
            $inner_items = '';
            if (isset($item['items']))
                $inner_items = strtr($this->submenuTemplate, [
                    '{items}' => $this->renderItems($item['items'], $item['label'])
                ]);
            $lines .= $this->renderItem($item, $inner_items);
        }
        return $lines;
    }

    private function renderItem($item, $inner_items)
    {
        if (isset($item['icon']))
            $icon = strtr($this->spanTemplate, [
                '{class}' => self::ICON_CLASS.$item['icon']
            ]);
        else
            $icon = '';

        if (isset($item['items']))
            return strtr($this->itemTemplate, [
                '{url}' => $item['url'],
                '{icon}' => $icon,
                '{label}' => $item['label'],
                '{class}' => self::LINK_CLASS,
                '{right_icon}' => self::RIGHT_ICON,
                '{inner_items}' => $inner_items
            ]);
        else
            return strtr($this->itemTemplate, [
                '{url}' => $item['url'],
                '{icon}' => $icon,
                '{label}' => $item['label'],
                '{class}' => '',
                '{right_icon}' => '',
                '{inner_items}' => $inner_items
            ]);
    }

    private function renderHeader($header, $is_main = false){
        return strtr($is_main ? $this->headerH3Template : $this->headerH4Template, ['{label}' => $header]);
    }
}