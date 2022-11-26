<?php
class Water
{
  public function __construct(string $water, string $pos = 'center top')
  {
    $this->water = $water;
    $this->pos = $pos;
  }
  public function make(string $image, string $filename = null)
  {
    // 检查图片合法性
    $this->checkImage($image);
    $this->checkImage($this->water);

    // 得到图片资源
    $res = $this->resource($image);
    $water = $this->resource($this->water);

    // 设置水印位置
    $position = $this->position($res, $water, $this->pos);
    // 绘制水印
    imagecopy($res, $water, $position['x'], $position['y'], 0, 0, imagesx($water), imagesy($water));
    // 输出展示
    $this->show($res);
    // 保存为文件
    imagepng($res,$filename??'water_'.$image);
  }

  // 根据用户位置描述语句，设置相应坐标位置
  protected function position($res, $water, $pos)
  {
    // x方向三种位置
    $x = [
      'left' => 0,
      'center' => imagesx($res) / 2 - imagesx($water) / 2,
      'right' => imagesx($res) - imagesx($water)
    ];
    // y方向三种位置
    $y = [
      'top' => 0,
      'center' => imagesy($res) / 2 - imagesy($water) / 2,
      'bottom' => imagesy($res) - imagesy($water)
    ];
    $info = ["x" => 0, "y" => 0];

    // 取得x,y方向的描述字符串
    $xposstr = explode(" ", $pos)[0];
    $yposstr = explode(" ", $pos)[1];
    // 设置水印位置
    $info['x'] = $x[$xposstr];
    $info['y'] = $y[$yposstr];
    return $info;
  }

  protected function show($res)
  {
    header('content-type: image/png');
    imagepng($res);
  }

  // 检查图片文件是否存在且可读
  protected function checkImage($image)
  {
    if (getimagesize($image) === false) {
      throw new \Exception("file is not image");
    } elseif (!file_exists($image) || !is_readable($image)) {
      throw new \Exception("Image not found or is not readable");
    }
  }
  protected function resource($image)
  {
    return imagecreatefromstring(file_get_contents($image));
  }
}
