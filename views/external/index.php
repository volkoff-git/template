

<div class="card">
	<div class="card-body border-bottom py-3">
		<div class="d-flex">
			<div class=" text-secondary"> <!--ms-auto-->

				<div class="ms-2 d-inline-block">
					<input placeholder="Поиск по фамилии или id:" type="text" class="form-control form-control-sm" aria-label="Search invoice">
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-vcenter table-mobile-md card-table">
			<thead>
			<tr>
				<th>id</th>
				<th>Состояние</th>
				<th>Время</th>
			</tr>
			</thead>
			<tbody>
			<? foreach ($params['leads'] as $lead): ?>
				<tr style="cursor: pointer" onclick="External.open_lead(<?=$lead['id'];?>)">
					<td data-label="id">
						<div class="d-flex py-1 align-items-center">
							<div class="flex-fill">
								<div class="font-weight-medium">id: <?=$lead['id'];?></div>
								<div class=" text-secondary font-weight-medium">Имя: <?=$lead['name']??'Не указано';?></div>

							</div>
						</div>
					</td>
					<td data-label="Состояние">
						<div>Стадия: <?=$lead['stage_text'];?></div>
						<div class="text-secondary">Последне событие: <?=$lead['event_text'];?></div>
					</td>
					<td data-label="Время">
						<div class="text-secondary"><span class="text-info">Создан:</span> <?=$lead['created_at'];?></div>
						<div class="text-secondary"><span class="text-info">В работу:</span> <?=$lead['show_at'];?></div>
					</td>
				</tr>
			<? endforeach; ?>



			</tbody>
		</table>
	</div>
</div>