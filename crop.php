<!dictype html>
<?php

//--------------crope and save image------------------

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
	$targ_w = 676;
	$targ_h = 390;
	$jpeg_quality = 90;

	$src = 'images/index.jpg';
	$img_r = imagecreatefromjpeg( $src );
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled( $dst_r, $img_r, 0, 0, $_POST[ 'x' ], $_POST[ 'y' ],
		$targ_w, $targ_h, $_POST[ 'w' ], $_POST[ 'h' ] );
	if ( imagejpeg( $dst_r, 'images/index.jpg' ) ) {
		echo '<script> alert("saved.."); window.location="index.php"; </script>';
	}
	exit;
}
?>
<!--------------------------------------------------------->
<html>
<head>
	<link rel="stylesheet" href="assets/rcrop.css">
	<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!--***********************************************************************************-->
	<div class="container">
		<img src="images/index.jpg" id="img">
		<form action="#" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x"/>
			<input type="hidden" id="y" name="y"/>
			<input type="hidden" id="w" name="w"/>
			<input type="hidden" id="h" name="h"/>
			<input type="submit" value="Save Image" class="btn btn-large btn-inverse"/>
		</form>
	</div>
<!--***********************************************************************************-->


	<script src="assets/jquery.js"></script>
	<script src="assets/rcrop.min.js"></script>
	<script>
		$( document ).ready( function () {

			var $image = $( '#img' ),
//				$crope = $( '#crope' ),
				inputs = {
					x: $( '#x' ),
					y: $( '#y' ),
					width: $( '#w' ),
					height: $( '#h' )
				},
				fill = function () {
					var values = $image.rcrop( 'getValues' );
					for ( var coord in inputs ) {
						inputs[ coord ].val( values[ coord ] );
					}
				}
			$image.rcrop({
				minSize : [67.6,39],
				preserveAspectRatio : true,
				grid : true
			});

			$image.on( 'rcrop-changed rcrop-ready', fill );

		} );
	</script>
</body>

</html>