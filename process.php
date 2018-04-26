<?php
if(isset($_POST["submit"]))
{
	if(!empty($_FILES["fileToUpload"])&&!empty($_POST["text"]))
	{
		switch(strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION)))//get file extension
				{
						case "png":
							header("Content-type:image/png");
							$image=imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
							break;
						case "jpg":
							header("Content-type:image/jpeg");
							$image=imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
							break;
						case "jpeg":
							header("Content-type:image/jpeg");
							$image=imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
							break;
						case "gif":
							header("Content-type:image/gif");
							$im = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
							break;
						default:
							trigger_error("Invalid Image file format");//non listed image format
							exit();
							break;
				}
		
		$fontpath="font.TTF";//path of fonttype or fontface
		if(!empty($_POST['x']))
		{
			$x=$_POST['x'];
		}else
		{
			$x=10;
		}
		if(!empty($_POST['y']))
		{
			$y=$_POST['y'];
		}else
		{
			$y=100;
		}
		if(!empty($_POST['fontsize']))
		{
			$fontsize=$_POST['fontsize'];
		}else
		{
			$fontsize=15;
		}
		if(!empty($_POST['angle']))
		{
			$angle=$_POST['angle'];
		}else
		{
			$angle=0;
		}
		if(!empty($_POST['text']))
		{
			$text=$_POST['text'];
		}else
		{
			$text="Default Text";
		}
		if(!empty($_POST['color']))
		{
			$im_color=$_POST['color'];
			switch($im_color)
			{
					case "Red":
						$im_color=imagecolorallocate($image,255,0,0);
						break;
					case "Green":
						$im_color=imagecolorallocate($image,0,255,0);
						break;
					case "Blue":
						$im_color=imagecolorallocate($image,0,0,255);
						break;
					default:
						$im_color=imagecolorallocate($image,255,0,0);
						break;
			}
		}
		else
		{
			$im_color=imagecolorallocate($image,255,0,0);
		}
		
		
		imagettftext($image,$fontsize,$angle,$x,$y,$im_color,$fontpath,$_POST["text"]);///to append text to image or create output images
		
		switch(strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION)))//to display output
				{
						case "png":
							imagepng($image);
							break;
						case "jpg":
							imagejpeg($image);
							break;
						case "jpeg":
							imagejpeg($image);
							break;
						case "gif":
							imagegif($image);
							break;
						default:
							trigger_error("Invalid Image file format");
							exit();
							break;
				}
		imagedestroy($image);
	}else
	{
			echo "please fill all the fiels";
	}
}
?>
