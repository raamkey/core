<?php 
namespace App\Helpers;
/**
* 
*/
class Input 
{
  public static $fileObj , $Ext;

  public static function has($type = null) {
      if(is_null($type)){
       $type = $_SERVER['REQUEST_METHOD'];
      }
      switch ($type) {
        case 'POST':
          return (!empty($_POST) ? $_POST : false);
        break;
        case 'GET':
          return (!empty($_GET) ? $_GET : false);
        break;
        default:
          return false;
        break;
      }
  }
  public static function all() {
    $type = $_SERVER['REQUEST_METHOD'];
      if (self::has($type)) {
        return self::has($type);
      }
      return false;
  }

  public static function get($name){
      if (isset($_POST[$name])) {
        return $_POST[$name];
      }else if (isset($_GET[$name])) {
        return $_GET[$name];
      }
      show_error("{$name} field not found");
  }

  public static function hasFile($name){
      return (isset($_FILES)) ? true : false;
  }
  public static function file($name){
      self::$fileObj = $_FILES[$name];
      return new self;
  }
  public static function getFileName(){
      return self::$fileObj['name'];
    }

    public static function getTmpFileName(){
      return self::$fileObj['tmp_name'];
    }

    public static function getFileExt(){
      $fileName = self::getFileName();
      self::$Ext = end((explode(".", $fileName)));
      return self::$Ext;
    }

    public static function move($destinationPath, $fileName = NULL) {
      $tempName = self::getTmpFileName();
     $fileName = (is_null($fileName)) ? self::getFileName() : $fileName.'.'.self::getFileExt();
      $destinationPath = $destinationPath.$fileName;
      if(file_exists($destinationPath)){
          // echo "file exit";
      } else{
          if(self::$fileObj['error'] == UPLOAD_ERR_OK){
            move_uploaded_file($tempName, $destinationPath);
            // self::resize($path , $fileName);
          } else {
          show_error('faild to file upload');
        }
      }
    }
    public static function resize($width, $height, $path, $fileName = null) {
      $type_arr = array("jpg", "png", "gif", "jpeg");
      $type = strtolower(self::getFileExt());
      if (in_array($type, $type_arr)) {
      $tempName = self::getTmpFileName();
      $data = file_get_contents($tempName);
      $fileName = ($fileName == null) ? self::getFileName() : $fileName.'.'.self::getFileExt();
      $src = imagecreatefromstring($data);
        if ($src !== false) {
          $src_width = imagesx($src);
          $src_height = imagesy($src);
          $aspect_ratio = $src_height/$src_width;

          if ($src_width <= $width) {
            $new_w = $src_width;
            $new_h = abs($new_w * $aspect_ratio);
          } else {
            $new_w = $width;
            $new_h = $height;
          }

          $img = imagecreatetruecolor($new_w,$new_h);
          imagealphablending($img, false); 
          imagesavealpha($img, true);
          imagecopyresized($img,$src,0,0,0,0,$new_w,$new_h,$src_width,$src_height);

          if ($type == "jpg") {    
            imagejpeg($img,$path.$fileName); 
          } else if ($type == "png") {
            imagepng($img,$path.$fileName);
          } else if ($type == "gif") {
            imagegif($img,$path.$fileName);
          }
            imagedestroy($img);
        }
      }
      
    }
}