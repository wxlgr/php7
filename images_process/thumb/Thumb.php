<?php

class Thumb
{
  public function make(string $file,string $saveTo='', int $width, int $height,int $type=1)
  {
    $this->checkImage($file);
    // 画布
    $res = imagecreatetruecolor($width, $height);
    $this->res = $res;
    // 图片
    $image = $this->resource($file);

    $info = $this->size($width, $height, imagesx($image), imagesy($image), $type);


    // 裁切贴图
    imagecopyresampled($res, $image, 0, 0, 0, 0,  $info['rw'], $info['rh'], $info['iw'], $info['ih']);
    
    // 输出展示
    $this->show();
    // 保存
    return  $this->saveImageFn($file)($this->res,$saveTo);
  }
  // 输出
  protected function show()
  {
    header("content-type:image/jpeg");
    imagepng($this->res);
  }

  // 获得保存图片的方法
  protected function saveImageFn($image):string
  {
    $functions = [1 => 'imagegif', 'imagejpeg', 'imagepng'];
    $info = getimagesize($image);
    return $functions[$info[2]];
  }
  // 获得裁切尺寸
  protected function size($rw, $rh, $iw, $ih, int $type): array
  {
    $info = [
      'rw' => $rw,
      'rh' => $rh,
      'iw' => $iw,
      'ih' => $ih
    ];

    switch ($type) {
      case 1: // 宽度固定,高度自适应
        $info['rh'] = $rw / $iw * $ih;
        break;
      case 2: // 高度固定，宽度自适应
        $info['rw'] = $rh / $ih * $iw;
        break;
      case 3: // 以画布尺寸为准
      default:
        if ($iw / $rw > $ih / $rh) {
          $info['iw'] = $ih / $rh * $iw;
        } else {
          $info['ih'] =  $iw / $rw * $ih;
        }
        break;
    }

    return $info;
  }

  // 检查图片合法性
  protected function checkImage($image)
  {
    if (!file_exists($image) || !getimagesize($image)) {
      throw new Exception('file does not exist or it is not image file');
    }
  }
  // 获取图片资源
  protected function resource($image)
  {
    $functions = [1 => 'imagecreatefromgif', 'imagecreatefromjpeg', 'imagecreatefrompng'];
    $info = getimagesize($image);
    return $functions[$info[2]]($image);
  }
}
