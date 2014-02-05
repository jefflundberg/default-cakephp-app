<!DOCTYPE html>
<html lang="">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="/css/cake.dev.css" rel="stylesheet" media="screen">
		<?php
			echo $this->Html->meta('icon');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		<!-- Bootstrap JavaScript -->
		<script src="/js/base.min.js"></script>
	</body>
</html>