<?php

namespace app\components;

use Yii;
use yii\helpers\Url;

class Sitemap
{
    public static function generate()
    {
        $file_dat = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
        $file_dat .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\r\n";
        $file_dat .= '<url>' . "\r\n";
        $file_dat .= '<loc>' . Url::base(true) . '</loc>' . "\r\n";
        $file_dat .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\r\n";
        $file_dat .= '<changefreq>monthly</changefreq>' . "\r\n";
        $file_dat .= '<priority>0.8</priority>' . "\r\n";
        $file_dat .= '</url>' . "\r\n";

        $file_dat .= static::addItem('categories/show', '0.6');
        $file_dat .= static::addItem('categories/show', '0.6', static::scanItem('categories', 'id'));
        $file_dat .= static::addItem('goods/show', '0.6', static::scanItem('goods', 'id, date'));
        $file_dat .= static::addItem('articles/showall', '0.5');
        $file_dat .= static::addItem('articles/show', '0.5', static::scanItem('articles', 'id, date'));
        $file_dat .= static::addItem('pages/contacts', '0.4');

        $file_dat .= '</urlset>' . "\r\n";

        file_put_contents('sitemap.xml', $file_dat);
    }

    private static function addItem($path, $priority, $data = false)
    {
        $file_dat = '';
        if (!is_array($data) || empty($data))
            return static::addXml($path, $priority);

        foreach ($data as $value) {
            $url = $path . '?id=' . $value['id'];

            $file_dat .= static::addXml($url, $priority, $value['date'] ?? null);
        }

        return $file_dat;
    }

    private static function addXml($url, $priority, $date = null)
    {
        $file_dat = '<url>' . "\r\n";
        $file_dat .= '<loc>' . Url::base(true) . '/' . $url . '</loc>' . "\r\n";
        $file_dat .= '<lastmod>' . (is_null($date) ? date('Y-m-d') : $date) . '</lastmod>' . "\r\n";
        $file_dat .= '<changefreq>monthly</changefreq>' . "\r\n";
        $file_dat .= '<priority>' . $priority . '</priority>' . "\r\n";
        $file_dat .= '</url>' . "\r\n";
        return $file_dat;
    }

    private static function scanItem($table, $row, $where = '')
    {
        return Yii::$app->db->createCommand("SELECT $row FROM $table $where")->queryAll();
    }
}