<?php 
include('library/php_qr_code/qrlib.php'); // Include a library for PHP QR code

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

	//its a location where generated QR code can be stored.
	$qr_code_file_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'qr_assets'.DIRECTORY_SEPARATOR;
	$set_qr_code_path = 'qr_assets/';

	// If directory is not created, the create a new directory 
	if(!file_exists($qr_code_file_path)){
    	mkdir($qr_code_file_path);
	}
	
	//Set a file name of each generated QR code
	$filename	=	$qr_code_file_path.time().'.png';
	
/* All the user generated data must be sanitize before the processing */
 if (isset($_REQUEST['level']) && $_REQUEST['level']!='')
    $errorCorrectionLevel = $_REQUEST['level'];

 if (isset($_REQUEST['size']) && $_REQUEST['size']!='')
    $matrixPointSize = $_REQUEST['size'];
	
	$frm_link	=	$_REQUEST['frm_qr'];
	
	// After getting all the data, now pass all the value to generate QR code.
	QRcode::png($frm_link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<div class="container">
		<div class="row justify-content-md-center">
		<div class="ml-2 col-sm-6">
			<?php if(isset($frm_link) and $frm_link!=""){?>
			<div class="alert alert-success">QR created for <strong>[<?php echo $frm_link;?>]</strong></div>
			<div class="text-center"><img src="<?php echo $set_qr_code_path.basename($filename); ?>" /></div>
			<?php } ?>
			<form method="post">
				<div class="form-group">
					<label>Enter QR parameter</label>
					<input type="text" name="frm_qr" id="frm_qr" class="form-control" placeholder="Enter QR parameter" required>
				</div>
				<div class="form-group">
					<label>QR Code Level</label>
					<select name="level" class="form-control">
						<option value="L">L - smallest</option>
						<option value="M" selected>M</option>
						<option value="Q">Q</option>
						<option value="H">H - best</option>
					</select>
				</div>
				<div class="form-group">
					<label>QR Code Size</label>
					<select name="size" class="form-control">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4" selected>4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Upload" class="btn btn-danger">
				</div>
			</form>
		</div>
		</div>
	</div>
	
	
	
	<!--Only these JS files are necessary--> 
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>   
</body>
</html>