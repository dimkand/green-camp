<?php

namespace dksoft\widgets;

use yii\base\Widget;

class DropDownMenu extends Widget
{
    public $title;
    public $items;
    public $name = '';
    public $data = false;
    public $tags = false;
    public $not_every = true;
    public $checked = [];
    public $vModel = false;
    private $tags_container = [];

    private $prev_tag = "<div {data}><div class='dropdown drop_down'>\n<button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>{title}<span class='caret'></span></button>\n<ul class='dropdown-menu'>";
    const POST_TAG = "</ul></div>";
    const END_TAG = "</div>";
    const DELETE_ICON = "<span class='glyphicon glyphicon-remove'></span>";
    const PLUS_ICON = "<span class='glyphicon glyphicon-plus'></span>";

    private $divTemplate = "<div {class}>{items}</div>";
    private $linkTemplate = '<a {data-tag} {class} href="#">{label}</a>';
    private $checkboxTemplate = "<input type='checkbox' name='{name}' {data} {checked} value='{value}' {v-model}>";
    private $itemTemplate = "<li {class}>{inner_item}</li>";
    private $submenuTemplate = "\n<ul {class}>\n{items}\n</ul>\n";

    public function init()
    {
        DropDownMenuAsset::register($this->getView());
    }

    public function run()
    {
        $this->prev_tag = strtr($this->prev_tag, [
            '{title}' => $this->title,
            '{data}' => $this->data ? "data-id = $this->data" : ''
        ]);
        return $this->prev_tag . $this->renderItems($this->items) . self::POST_TAG . ($this->tags ? $this->renderTags() : '') . self::END_TAG;
    }

    private function renderItems($items)
    {
        $lines = '';
        foreach ($items as $item) {
            $lines .= $this->renderItem($item);
            if (isset($item['items'])) {
                $lines = substr_replace($lines, self::PLUS_ICON, -5, 0);
                $lines .= strtr($this->submenuTemplate, [
                    '{class}' => "class='inner_ul'",
                    '{items}' => $this->renderItems($item['items'])
                ]);
            }
        }
        return $lines;
    }

    private function renderItem($item)
    {
        $link = strtr($this->linkTemplate, [
            '{data-tag}' => '',
            '{class}' => '',
            '{label}' => $item['label']
        ]);

        if ($this->not_every && ($item['type'] == 1 || $item['type'] == 3)) {
            return strtr($this->itemTemplate, [
                '{class}' => "class='drop_down_li'",
                '{inner_item}' => $link
            ]);
        } else {
            $checkbox = strtr($this->checkboxTemplate, [
                '{name}' => "$this->name[]",
                '{checked}' => $this->setChecked($item),
                '{data}' => 'data-type='.$item['type'],
                '{value}' => $item['id'],
                '{v-model}' => $this->vModel ? "v-model='$this->vModel'" : ''
            ]);
            return strtr($this->itemTemplate, [
                '{class}' => '',
                '{inner_item}' => $checkbox . $link
            ]);
        }
    }

    private function renderTags()
    {
        $items = '';
        if (!empty($this->tags_container)) {
            foreach ($this->tags_container as $item) {
                $items .= strtr($this->linkTemplate, [
                    '{data-tag}' => "data-tag = " . $item['id'],
                    '{class}' => $item['type'] == 4 ? "class = chars_tag" : "class = category_tag",
                    '{label}' => self::DELETE_ICON . $item['label']
                ]);
            }
        }
        return strtr($this->divTemplate, ['{class}' => "class = 'drop_down_tags'", '{items}' => $items]);
    }

    // Сохранение значений флажков checkbox при провале валидации других полей формы
    public function setChecked($item)
    {
        if (isset($_POST[$this->name][$item['id']]) || in_array($item['id'], $this->checked)) {
            $this->tags_container[] = $item;
            return 'checked';
        }
        return '';
    }
}