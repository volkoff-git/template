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
				<input id="editUser_name" type="text" class="form-control" value="<?=$params['name']; ?>">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Логин</label>
				<input id="editUser_login" type="text" class="form-control" value="<?=$params['login']; ?>">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Пароль</label>
				<input id="editUser_password" type="text" class="form-control">
			</div>
		</div>

		<div class="col-lg-6">
			<div class="mb-3">
				<label class="form-label">Роль</label>
				<select id="editUser_role" class="form-select" >
					<? foreach (LibAccess::$roles as $key => $role): ?>
						<option <? if($params['role'] == $key) echo 'selected'; ?> value="<?=$key; ?>"><?=$role['title'];?></option>
					<? endforeach; ?>
				</select>
			</div>
		</div>

	</div>


</div>
<div class="modal-footer">
    <button type="button" id="close_modal" class="btn me-auto" data-bs-dismiss="modal">Отмена</button>
    <button type="button" onclick="Admin.user_edit_save(event, <?=$params['id']; ?>)"
			class="btn btn-primary">Сохранить</button>
</div>