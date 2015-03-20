<?php
function getAuthImage($text) {
	$im_x = 160;
	$im_y = 40;
	$im = imagecreatetruecolor($im_x,$im_y);
	$text_c = ImageColorAllocate($im, 100, 100, 100);
	$buttum_c = ImageColorAllocate($im, 255, 255, 255);
	imagefill($im, 16, 13, $buttum_c);

	$font = 't1.ttf';

	for ($i=0;$i<strlen($text);$i++)
	{
		$tmp =substr($text,$i,1);
		$array = array(-1, 1);
		$p = array_rand($array);
		$dy = $array[$p]*mt_rand(0,5);
		$size = 30;
		imagettftext($im, $size, 0, 15+ $i*($size-6), 35 + $dy, $text_c, $font, $tmp);
	}


	$distortion_im = imagecreatetruecolor ($im_x, $im_y);

	imagefill($distortion_im, 16, 13, $buttum_c);
	for ( $i=0; $i<$im_x; $i++) {
		for ( $j=0; $j<$im_y; $j++) {
			$rgb = imagecolorat($im, $i , $j);
			//if( (int)($i+20+sin($j/$im_y*2*M_PI)*10) <= imagesx($distortion_im)&& (int)($i+20+sin($j/$im_y*2*M_PI)*10) >=0 ) {
				imagesetpixel ($distortion_im, (int)($i+ 1.4*sin($j/$im_y*2*M_PI-M_PI*0.2)*4) , $j , $rgb);
		//	}
		}
	}
	//加入干扰象素;
	//$count = 64;//干扰像素的数量
	//for($i=0; $i<$count; $i++){
		//$randcolor = ImageColorallocate($distortion_im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	//	$x = mt_rand()%$im_x;
	//	$y = mt_rand()%$im_y;
	//	imagefilledrectangle($distortion_im, $x , $y , $x + 3, $y + 3, $randcolor);
	//}

	//以PNG格式将图像输出到浏览器或文件;
	ImagePNG($distortion_im);

	//销毁一图像,释放与image关联的内存;
	ImageDestroy($distortion_im);
	ImageDestroy($im);
}

function make_rand($length="32"){//验证码文字生成函数
	$str="ABCEFGHPQRSTYZ";
	$result="";
	for($i=0;$i<$length;$i++){
		$num[$i]=rand(0,13);
		$result.=$str[$num[$i]];
	}
	return $result;
}


//输出调用
$checkcode = $_GET["code"];
//$checkcode = make_rand(4);
getAuthImage($checkcode);
?>
