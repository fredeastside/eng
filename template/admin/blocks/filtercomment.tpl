<div class="filters">
	Комментарии
	<ul class="filter-list" >
		<li><a href="/admin/?modul={mod['redir']}&comm_film_id={request.comm_film_id}" [[if not moderation]]class="active"[[endif]]>Все</a></li>
		<li><a href="/admin/?modul={mod['redir']}&active=0&comm_film_id={request.comm_film_id}" [[if moderation]]class="active"[[endif]] >На модерации</a></li>
	</ul>  
</div>