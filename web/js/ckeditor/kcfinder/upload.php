<?php

/** This file is part of KCFinder project
  *
  *      @desc Upload calling script
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */
$imagePath = __DIR__.'/upload/images/';
if ($files = glob($imagePath . '*')) {
    foreach ($files as $file) {
        $time_file_save = 60 * 60 * 24;
        if (filectime($file) + $time_file_save < time() && is_file($file))
            unlink($file);
    }
}

require "core/bootstrap.php";
$uploader = "kcfinder\\uploader";  // To execute core/bootstrap.php on older
$uploader = new $uploader();       // PHP versions (even PHP 4)
$uploader->upload();

?>