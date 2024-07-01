
<div class="container container-tight py-4">

	<div class="card card-md">
		<div class="card-body">
			<h2 class="h2 text-center mb-4">Авторизация</h2>
			<form action="./" method="get" autocomplete="off" novalidate>
				<div class="mb-3">
					<label class="form-label">Логин</label>
					<input id="auth_login" type="email" class="form-control" placeholder="Предоставляется менеджером" autocomplete="off">
				</div>
				<div class="mb-2">
					<label class="form-label">Пароль</label>
					<div class="input-group input-group-flat">
						<input id="auth_password" type="password" class="form-control"  placeholder="Ваш пароль"  autocomplete="off">
					</div>
				</div>
				<div class="form-footer">
					<button onclick="Auth.login(event)" type="submit" class="btn btn-primary w-100">Войти</button>
				</div>
			</form>
		</div>



	</div>

</div>


