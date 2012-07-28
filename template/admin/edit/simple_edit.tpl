[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[block center]]	

<div class="tabs">
	<a class="tab active" href="">Основные данные</a>
	/*<a class="tab" href="">Настройки страницы</a>
	<a class="tab" href="">Доступы к страницы</a>*/
</div>
<div class="edit-area" >
	<h1>Редактирование объекта</h1>
		[[ autoescape false ]]
			{ content }
		[[ endautoescape ]]
</div>
[[endblock]]