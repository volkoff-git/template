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
                            <?=$params['title']??$this->module; ?>
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


<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" id="modalTrigger" data-bs-target="#mainModal"></button>

<div class="modal" id="mainModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" id="mainModal_content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div>
</div>

<? require_once '_includes/bottom_scripts.php'; ?>
<?=$params['attach_js'] ?>


</body>
</html>