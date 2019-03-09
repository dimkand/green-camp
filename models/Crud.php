<?php
namespace app\models;

use app\components\Helpers;
use Yii;

class Crud extends \yii\db\ActiveRecord
{
    // Перемещение файла изображения из временной в постоянную директорию
    public function renameImgFile($tmp_img_path, $saved_name = null, $old_img_path = null, $id = false)
    {
        if(!is_null($old_img_path))
            $img_dir = $old_img_path;
        else
            $img_dir = Yii::$app->params['default_img_path'];

        if(empty($tmp_img_path))
            return $img_dir;

        $half_path = Yii::getAlias('@webroot').'/'.$this::className()::$img_path;
        $img_name = basename($tmp_img_path);

        if(is_null($saved_name))
            $saved_name = $img_name;

        if($id){
            if(!file_exists($half_path.$id))
                mkdir($half_path.$id);
            $saved_file = $half_path.$id.'/'.$saved_name;
        }
        else
            $saved_file = $half_path.$saved_name;

        $temp_file = Yii::getAlias('@webroot').'/js/croppic/temp/'.$img_name;

        if($temp_file == $saved_file)
            return $img_dir;

        if(@rename($temp_file, $saved_file)){
            $img_dir = $this::className()::$img_path.$saved_name;

            if(!is_null($old_img_path) && $id === false)
                $this->deleteImgFile($old_img_path);
        }

        return $img_dir;
    }

    public function batchInsert($data, $id, $row1, $row2)
    {
        if (isset($data)) {
            $values = array();
            foreach ($data as $value) {
                $values[] = [$id, $value];
            }
            Yii::$app->db->createCommand()->batchInsert(self::tableName(), [$row1, $row2], $values)->execute();
        }
    }

    public function deleteImgFile($path = null)
    {
        if(is_null($path)) {
            $table = $this->tableName();
            $path = Yii::$app->db->createCommand("SELECT `img` FROM $table WHERE `id` = '$this->id'")->queryScalar();
        }
        $img_path = Yii::getAlias('@webroot').'/'.$path;
        if(file_exists($img_path) && is_file($img_path) && $img_path != Yii::getAlias('@webroot').'/'.Yii::$app->params['default_img_path'])
            return unlink($img_path);
        return false;
    }
}