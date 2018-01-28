<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php 
		include_once 'script/common.php';
	 ?>
	<title><?php echo $title; ?></title>
</head>
<body class="full-width full-height">
	

	<video style="display:none;" loop="loop" id="background_music"><source src="<?php echo static_url('video/1.mp3'); ?> "></video>

	<script>

		(function(window){
			var _video = document.getElementById('background_music');
			_video.play();

			window.onresize = function(){
				setBody();
			}

			function  setBody(){
				var width = $(window).width();
				var height = $(window).height();
				$('body').css({
					'width':width,
					'height':height
				});
			}
			setBody();
		}(window));
		


	</script>
</body>
</html>
