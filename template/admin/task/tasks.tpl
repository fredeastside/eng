[[ if tasks]]	
	<!-- Таблица заданий -->
<table class="main-table f12">
	<colgroup>
		<col width="230px">
		<col width="230px" >
		<col width="8%" >
		<col width="8%" >
		<col width="8%" >
		<col width="8%" >
		<col>
	</colgroup>

	<tbody><tr class="td-header">
		<td>Анкор</td>
		<td>Сайт</td>
		<td>Всего</td>
		<td>Отработано</td>
		<td>На сайте</td>
		<td>В индексе</td>
		<td>Регистратор</td>
	</tr>
	[[for task in tasks]]
		[[ include  TEMPLATE_PATH ~ "admin/task/task_item.tpl" ]]
	[[endfor]]
	
</tbody></table>
[[else]]
	<br />
	<h1>По данным критериям нет заданий</h1>
[[endif]]