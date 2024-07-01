<?
$a_cl = 'list-group-item list-group-item-action d-flex align-items-center';
?>

<div class="card">
	<div class="row g-0">
		<div class="col-12 col-md-3 border-end">
			<div class="card-body">
				<div class="list-group list-group-transparent" id="links-wrapper">
					<a id="default_tab" href="#"  onclick="Admin.select_tab(event, 'userList')" class="<?=$a_cl;?>">Пользователи</a>
					<a href="#"  onclick="Admin.select_tab(event, 'foo')" class="<?=$a_cl;?>">foo</a>
					<a href="#"  onclick="Admin.select_tab(event, 'bar')" class="<?=$a_cl;?>">bar</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9 d-flex flex-column">
			<div class="card-body" id="admin_subpage_container"></div>
		</div>
	</div>
</div>


