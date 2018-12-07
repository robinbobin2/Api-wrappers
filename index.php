<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('Neutrino.php');
require_once('Numverify.php');

$neutrino = new NeutrinoApiClient;
$numverify = new NumverifyApiClient;
if (isset($_REQUEST['number']) && $_REQUEST['number']!='') {
	if ($_REQUEST['type']=='neutrino') {
		$neutrinoResult = $neutrino->verify($_REQUEST['number']);

	} elseif($_REQUEST['type']=='numverify') {
		$numverifyResult = $numverify->verify($_REQUEST['number']);
	} elseif($_REQUEST['type']=='both') {
		$numverifyResult = $numverify->verify($_REQUEST['number']);
		$neutrinoResult = $neutrino->verify($_REQUEST['number']);

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<style type="text/css">
	.col-lg-12 h2 {
		margin: 50px 0 30px;
	}
</style>
</head>
<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="text-center">Phone number verification</h2>
				</div>
				<div class="col-lg-5">
					<form class="number-verification">
						<div class="form-group">
							<label for="number">Phone number</label>
							<input value="<?php echo isset($_REQUEST['number']) ? $_REQUEST['number'] : ''; ?> " class="form-control" type="text" id="number" name="number" />
						</div>
						<div class="form-group">
							<button type="submit" name="type" value="neutrino" class="btn btn-primary">Neutrino Api</button>
							<button type="submit" name="type" value="numverify" class="btn btn-primary">Numverify Api</button>
							<button type="submit" name="type" value="both" class="btn btn-primary">Both</button>
						</div>
					</form>
				</div>
				<div class="col-lg-6">
					<?php if(isset($neutrinoResult)): ?>
						<table class="table">
							<tr >
								<td colspan="2">
									<?php echo $neutrinoResult['valid'] ? '<p class="alert alert-success">Phone number is valid</p>' : '<p class="alert alert-danger">Phone number is invalid</p>'; ?>
								</td>
							</tr>
							<tr>
								<td>Country </td>
								<td><?php echo $neutrinoResult['country']; ?></td>
							</tr>

							<tr>
								<td>Type </td>
								<td><?php echo $neutrinoResult['type']; ?></td>
							</tr>
							<tr>
								<td>Country Code </td>
								<td><?php echo $neutrinoResult['country-code']; ?></td>
							</tr>
							<tr>
								<td>Location </td>
								<td><?php echo $neutrinoResult['location']; ?></td>
							</tr>
							<tr>
								<td>Local number </td>
								<td><?php echo $neutrinoResult['local-number']; ?></td>
							</tr>
							<tr>
								<td>International Calling Code </td>
								<td><?php echo $neutrinoResult['international-calling-code']; ?></td>
							</tr>
						</table>
					<?php endif; ?>
					<?php if(isset($numverifyResult)): ?>
						<table class="table">
							<tr >
								<td colspan="2">
									<?php echo $numverifyResult['valid'] ? '<p class="alert alert-success">Phone number is valid</p>' : '<p class="alert alert-danger">Phone number is invalid</p>'; ?>
								</td>
							</tr>
							<tr>
								<td>Type </td>
								<td><?php echo $numverifyResult['line_type']; ?></td>
							</tr>

							<tr>
								<td>Country name </td>
								<td><?php echo $numverifyResult['country_name']; ?></td>
							</tr>
							<tr>
								<td>Carrier</td>
								<td><?php echo $numverifyResult['carrier']; ?></td>
							</tr>
							<tr>
								<td>Location </td>
								<td><?php echo $numverifyResult['location']; ?></td>
							</tr>
							<tr>
								<td>Local number </td>
								<td><?php echo $numverifyResult['local_format']; ?></td>
							</tr>
							<tr>
								<td>Country prefix </td>
								<td><?php echo $numverifyResult['country_prefix']; ?></td>
							</tr>
						</table>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>