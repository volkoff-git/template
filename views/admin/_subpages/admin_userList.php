<h2 class="mb-4">Усправление пользователями</h2>
<h3 class="card-title">Создать нового</h3>

<div class="row g-2">
	<div class="col-md">
		<div class="form-label required">Логин</div>
		<input id="newUser_login" type="text" class="form-control" >
	</div>
	<div class="col-md">
		<div class="form-label required">Пароль</div>
		<input id="newUser_password" type="text" class="form-control">
	</div>
	<div class="col-md">
		<div class="form-label required">Имя</div>
		<input id="newUser_name" type="text" class="form-control">
	</div>
	<div class="col-md">
		<div class="form-label">Роль</div>
		<select class="form-select" id="newUser_role">
			<option selected value="user">Пользователь</option>
			<option value="manager">Менеджер</option>
		</select>
	</div>
	<div class="col-md-auto">
		<div class="form-label">&nbsp;</div>
		<a href="#" class="btn btn-primary" onclick="Admin.add_new_user(event)" >Сохранить</a>
	</div>
</div>

<div class="mb-4"></div>

<h3 class="card-title">Список пользователей</h3>
<div class="row g-2">
	<div class="col-12">
		<div class="card">
			<div class="table-responsive">
				<table class="table table-vcenter card-table table-striped">
					<thead>
					<tr>
						<th>id</th>
						<th>Логин</th>
						<th>Имя</th>
						<th>Роль</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
                    <? foreach ($params['users'] as $u): ?>
					<?

						$login = $u['login'];
						if($u['enabled'] != 1)
                        {
                            $login = "<s>$login</s>";
						}
					?>
						<tr>
							<td class="text-secondary"><?=$u['id'];?></td>
							<td><?=$login;?></td>
							<td class="text-secondary"><?=$u['name'];?></td>
							<td class="text-secondary"><?=$u['role'];?></td>
							<td>
								<? if($u['id'] != 1): ?>
									<a onclick="Admin.user_edit(event, <?=$u['id'];?>)" href="#">Изменить</a>
								<? endif; ?>

							</td>
						</tr>

                    <? endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

