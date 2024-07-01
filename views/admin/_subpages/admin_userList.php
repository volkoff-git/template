<h2 class="mb-4">Усправление пользователями</h2>
<h3 class="card-title">Создать нового</h3>

<div class="row g-2">
    <div class="col-md">
        <div class="form-label required">Логин</div>
        <input id="newUser_login" type="text" class="form-control" >
    </div>
    <div class="col-md">
        <div class="form-label required">Парль</div>
        <input id="newUser_password" type="text" class="form-control">
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