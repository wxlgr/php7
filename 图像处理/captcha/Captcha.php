<?php
class Captcha
{
  protected $width;
  protected $height;
  protected $res;
  protected $len;
  protected  string $code='';
  public function __construct(int $width = 100, int $height = 30, int $len = 5)
  {
    $this->width = $width;
    $this->height = $height;
    $this->len = $len;
  }
  public function render():?string
  {
    $res = imagecreatetruecolor($this->width, $this->height);
    $this->res = $res;
    imagefill($res, 0, 0, imagecolorallocate($res, 200, 200, 200));
    $this->text();

    $this->pix();
    $this->line();

    $this->show();
    // 返回生成的大写验证码
    return $this->code;
  }

  // 输出
  protected function show()
  {
    header("Content-Type: image/png");

    imagepng($this->res);
  }
  // 绘制验证码
  protected function text()
  {
    $size = 20;
    $text = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $font = realpath('font.otf',);
    $w = $this->width / ($this->len); //长度分成n份

    for ($i = 0; $i < $this->len; $i++) {
      $randindex = mt_rand(0, mb_strlen($text, "utf-8") - 1);
      $char =  strtoupper($text[$randindex]);

      // 累加得到code
      $this->code.= $char;

      $angle =  mt_rand(-20, 20);
      $box = imagettfbbox($size, $angle, $font,  $char);
      /*
       坐标x,y
        67  45
        01  23 
      */
      $textwidth = $box[2] - $box[0];
      $textheight = $box[1] - $box[7];

      // x,y 是文字左下角左边
      // 每块长度居中,每块中心点  ($i * $w) + $w / 2
      $x = ($i * $w) + $w / 2 - $textwidth / 2;

      $y = $this->height / 2 + $textheight / 2;
      imagettftext($this->res, $size, $angle, $x, $y, $this->textcolor(), $font, $char);
    }
  }

  // 绘制干扰点
  protected function pix()
  {
    for ($i = 0; $i < 300; $i++) {

      imagesetpixel($this->res, mt_rand(0, $this->width), mt_rand(0, $this->height), $this->color());
    }
  }

  //画干扰线
  protected function line()
  {
    for ($i = 0; $i < 6; $i++) {
      // 设置粗细
      imagesetthickness($this->res, mt_rand(1, 2));

      imageline(
        $this->res,
        rand(0, $this->width),
        rand(0, $this->height),
        rand(0, $this->width),
        rand(0, $this->height),
        $this->color()
      );
    }
  }

  // 随机颜色
  protected function color()
  {
    return imagecolorallocate($this->res, rand(0, 255), rand(0, 255), rand(0, 255));
  }
  protected function textcolor()
  {
    return imagecolorallocate($this->res, rand(0, 50), rand(0, 50), rand(0, 50));
  }
}
