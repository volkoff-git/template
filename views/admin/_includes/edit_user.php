<div class="modal-header">

	<?  ?>
    <h5 class="modal-title">Редактирование пользователя <?=$params['login']; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


	<div class="row">
		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Имя</label>
				<input type="text" class="form-control" value="<?=$params['name']; ?>">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Логин</label>
				<input type="text" class="form-control" value="<?=$params['login']; ?>">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Пароль</label>
				<input type="text" class="form-control">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Роль</label>
				<select class="form-select" >
					<option selected value="user">Пользователь</option>
					<option value="manager">Менеджер</option>
				</select>
			</div>
		</div>

	</div>


</div>
<div class="modal-footer">
    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
</div>