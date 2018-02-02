<!doctype html>
<html>

<head>
	<link rel="stylesheet" href="assets/style.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</head>

<body>
	<div class="container">
		<form method="post" enctype="multipart/form-data">
			<label>Select photo to upload</label>
			<input type="file" name="photo" id="photo">
			<input type="submit" name="submit" value="Upload your photo">
		</form>
		
<?php
//		--------------------photo upload-----------------
	
	if ( isset( $_POST[ "submit" ] ) ) {
		
		$target_dir = ("images");
		$uploadOk = 1;
		$file = basename( $_FILES[ "photo" ][ "name" ] );
		$imageFileType = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );

		// Check if image file is a actual image or fake image
		$check = getimagesize( $_FILES[ "photo" ][ "tmp_name" ] );
		if ( $check !== false ) {

			$uploadOk = 1;
		} else {
			$error = "File is not an image.";
			$uploadOk = 0;
		}

		// Check file size
		if ( $_FILES[ "photo" ][ "size" ] > 500000 ) {
			$error = "Sorry, your file is larger than 5mb.";
			$uploadOk = 0;
		}

		//		 Allow certain file formats
		if ( $imageFileType != "jpg" && $imageFileType != "jpeg") {
			$error = "Sorry, only JPG, JPEG files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
			echo '<label class="error">'.$error.'</label>';
		} else {

			if ( move_uploaded_file( $_FILES[ "photo" ][ "tmp_name" ], $target_dir . '/index.jpg') ) {
					
				header("location:crop.php");

			} else {
				echo "Sorry, there was an error uploading your file.";
				die();
			}
		}
	}
	?>
	</div>



</body>

</html>