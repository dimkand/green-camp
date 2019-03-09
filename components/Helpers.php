<?php

namespace app\components;

use app\models\Goods;
use \Yii;
use yii\helpers\Url;

class Helpers
{
    public static function printArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        exit();
    }

    public static function getGoodsImg($id, $count, $options = null)
    {
        if(!isset($options['class']))
            $class = 'grid_img widget_img';
        else
            $class = $options['class'];

        $imgs = array();

        if($count == 0){
            $imgs[]['content'] = "<img src='" . Url::base(true) . Yii::$app->params['default_img_path'] . "' class = '$class'>";
            return $imgs;
        }

        for($i = 0; $i < $count; $i++){
            $imgs[]['content'] = "<img src='".Url::base(true).'/'.Goods::$img_path.$id.'/'.'cimg_'.$i.'.jpeg'."' class = '$class'>";
        }
        return $imgs;
    }

    public static function arrDelEmpty($arr)
    {
        if(!is_array($arr))
            return null;
        $i = 0;
        $new_arr = [];
        foreach ($arr as $elem){
            if(empty($elem))
                continue;
            $new_arr[$i] = $elem;
            $i++;
        }
        return $new_arr;
    }

    public static function arrMerge($arr1, $arr2)
    {
        $merged = array();
        for($i = 0; $i < count($arr1); $i++){
            $merged[$i] = $arr1[$i];
            if(empty($arr1[$i]) && !empty($arr2[$i]))
                $merged[$i] = $arr2[$i];
        }
        return $merged;
    }

    public static function editCimgPath($cimg_path)
    {
        $cimg_name = basename($cimg_path);
        $temp_path = substr($cimg_path, 0, - mb_strlen($cimg_name));
        $img_name = substr($cimg_name,1);
        return $temp_path.$img_name;
    }

    public static function parsePhone($phone)
    {
        $country_code = substr($phone, 0, 1);
        $operator_code = substr($phone, 0, 3);
        $part_1 = substr($phone, 3, 3);
        $part_2 = substr($phone, 6, 2);
        $part_3 = substr($phone, 8, 2);
        return '+'.$country_code.'('.$operator_code.') '.$part_1.'-'.$part_2.'-'.$part_3;
    }

    public static function displayHelper($key, $alt = false)
    {
        if($key%2 == 1)
            return $alt ? "style = 'display: none'" : "style = 'display: block'";
        else
            return $alt ? "style = 'display: block'" : "style = 'display: none'";
    }

    public static function substrHelper($str, $max_length)
    {
        if(mb_strlen($str) > $max_length)
            return mb_substr($str, 0, $max_length)."...";

        return $str;
    }
}