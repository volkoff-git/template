<!doctype html>

<html lang="en">
<? require_once '_includes/head.php'; ?>
<body >

<div class="page">

    <? require_once '_includes/navbar_top.php'; ?>
    <? require_once '_includes/navbar_bottom.php'; ?>

	<div class="page-wrapper">

		<div class="page-header d-print-none">
			<div class="container-xl">
				<div class="row g-2 align-items-center">
					<div class="col">
						<h2 class="page-title">
							Empty page
						</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="page-body">
			<div class="container-xl">
                <?=$params['content'] ?>
			</div>
		</div>
		<footer class="footer footer-transparent d-print-none">
			<div class="container-xl">
				<div class="row text-center align-items-center flex-row-reverse">

				</div>
			</div>
		</footer>
	</div>
</div>

<? require_once '_includes/bottom_scripts.php'; ?>
<?=$params['attach_js'] ?>


</body>
</html>