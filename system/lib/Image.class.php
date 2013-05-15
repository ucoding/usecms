<?php
//生成图像缩略图和生成验证码
class Image
{
    //生成图像验证码
    static public function buildImageVerify($width = 48, $height = 22, $randval = NULL, $verifyName = 'verify')
    {
        if (!isset($_SESSION)) {
            session_start(); //如果没有开启，session，则开启session
        }
        $randval = empty($randval) ? ("" . rand(1000, 9999)) : $randval;
        $_SESSION[$verifyName] = $randval;
        $length = 4;
        $width = ($length * 10 + 10) > $width ? $length * 10 + 10 : $width;
        $im = imagecreate($width, $height);
        $r = array(225, 255, 255, 223);
        $g = array(225, 236, 237, 255);
        $b = array(225, 236, 166, 125);
        $key = mt_rand(0, 3);

        $backColor = imagecolorallocate($im, $r[$key], $g[$key], $b[$key]); //背景色（随机）
        $borderColor = imagecolorallocate($im, 100, 100, 100); //边框色
        $pointColor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)); //点颜色

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width - 1, $height - 1, $borderColor);
        $stringColor = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        // 干扰
        for ($i = 0; $i < 10; $i++) {
            $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagearc($im, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $fontcolor);
        }
        for ($i = 0; $i < 25; $i++) {
            $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pointColor);
        }
        for ($i = 0; $i < $length; $i++) {
            imagestring($im, 5, $i * 10 + 5, mt_rand(1, 8), $randval{$i}, $stringColor);
        }
        self::output($im, 'png');
    }

    //生成缩略图
    static public function thumb($image, $thumbname, $domain = 'public', $maxWidth = 200, $maxHeight = 50, $interlace = true)
    {
        // 获取原图信息
        $info = self::getImageInfo($image);
        if ($info !== false) {
            $srcWidth = $info['width'];
            $srcHeight = $info['height'];
            $type = strtolower($info['type']);
            $interlace = $interlace ? 1 : 0;
            unset($info);
            $pox = 0;
            $poy = 0;
            $width = $saeWidth = $srcWidth;
            $height = $saeHeight = $srcHeight;
            $bWidth = $srcWidth;
            $bHeight = $srcHeight;
            $scalei = min($maxWidth / $srcWidth, $maxHeight / $srcHeight); // 最大缩放比例
            $scalex = max($maxWidth / $srcWidth, $maxHeight / $srcHeight); // 最小缩放比例

            if ($scalei < 1) { // 原图有一边大于缩略设置时
                if ($scalex >= 1) { //原图有一边小于缩略设置对应边时
                    $width = (int)($srcWidth * $scalei);
                    $height = (int)($srcHeight * $scalei);
                } else { //原图长宽都大于缩略设置时
                    $width = $maxWidth;
                    $height = $maxHeight;
                    $bWidth = $maxWidth / $scalex;
                    $bHeight = $maxHeight / $scalex;
                    $pox = ((int)($srcWidth - $bWidth)) / 2;
                    $poy = ((int)($srcHeight - $bHeight)) / 2;
                }
                $saeWidth = (int)($srcWidth * $scalei);
                $saeHeight = (int)($srcHeight * $scalei);
            }

            //sae平台上图片处理
            if (class_exists('SaeStorage')) {
                $saeStorage = new SaeStorage();
                $saeImage = new SaeImage();
                $saeImage->setData(file_get_contents($image));
                $saeImage->resize($saeWidth, $saeHeight);
                $thumbname = str_replace(array('../', './'), '', $thumbname);
                return $saeStorage->write($domain, $thumbname, $saeImage->exec());
            }

            // 载入原图
            $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
            $srcImg = $createFun($image);

            //创建缩略图
            if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
                $thumbImg = imagecreatetruecolor($width, $height);
            } else {
                $thumbImg = imagecreate($width, $height);
            }
            // 复制图片
            if (function_exists("ImageCopyResampled")) {
                imagecopyresampled($thumbImg, $srcImg, 0, 0, $pox, $poy, $width, $height, $bWidth, $bHeight);
            } else {
                imagecopyresized($thumbImg, $srcImg, 0, 0, $pox, $poy, $width, $height, $bWidth, $bHeight);
            }
            if ('gif' == $type || 'png' == $type) {
                $background_color = imagecolorallocate($thumbImg, 0, 255, 0); //  指派一个绿色
                imagecolortransparent($thumbImg, $background_color); //  设置为透明色，若注释掉该行则输出绿色的图
            }
            // 对jpeg图形设置隔行扫描
            if ('jpg' == $type || 'jpeg' == $type) {
                imageinterlace($thumbImg, $interlace);
            }
            $dir = dirname($thumbname);
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            // 生成图片
            $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
            if ('jpg' == $type || 'jpeg' == $type) {
                $imageFun($thumbImg, $thumbname, 100);
            } else {
                $imageFun($thumbImg, $thumbname);
            }
            imagedestroy($thumbImg);
            imagedestroy($srcImg);
            return $thumbname;
        }
        return false;
    }

    static protected function getImageInfo($img)
    {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }

    static protected function output($im, $type = 'png', $filename = '')
    {
        header("Content-type: image/" . $type);
        $ImageFun = 'image' . $type;
        if (empty($filename)) {
            $ImageFun($im);
        } else {
            $ImageFun($im, $filename);
        }
        imagedestroy($im);
        exit;
    }
}

?>