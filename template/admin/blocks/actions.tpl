[[ import TEMPLATE_PATH ~ "admin/macro/actions.tpl" as forms ]]

[[if 'retro'  in  actions ]]
	[[if (item['retro']==1)]]
		[[set img = 'published.gif' ]]
	[[else]]	
		[[set img = 'notpublished.gif' ]]
	[[endif]]	
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=retro
	[[ endset ]]
	
	{forms.action(link, img,'Ретро')}
[[endif]]
[[if 'best_retro'  in  actions ]]
		[[if (item['best_retro']==1)]]
			[[set img = 'new.gif' ]]
		[[else]]	
			[[set img = 'notnew.gif' ]]
		[[endif]]	
		
		[[ set link ]]
		 	/admin/?modul={request.modul}&id={item['id']}&action=best_retro
		[[ endset ]]
	
		
		{forms.action(link, img,'Лучший ретро фильм')}
[[endif]]

[[if 'index_film'  in  actions ]]
	[[if (item['index_film']==1)]]
		[[set img = 'published.gif' ]]
	[[else]]	
		[[set img = 'notpublished.gif' ]]
	[[endif]]	
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=index_film
	[[ endset ]]
	
	{forms.action(link, img,'показывать на главной')}
[[endif]]

[[if 'inmenu_new'  in  actions ]]
	[[if (item['inmenu_new']==1)]]
		[[set img = 'published.gif' ]]
	[[else]]	
		[[set img = 'notpublished.gif' ]]
	[[endif]]	
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=inmenu_new
	[[ endset ]]
	
	{forms.action(link, img,'новинка в меню')}
[[endif]]

[[if 'inmenu'  in  actions ]]
	[[if (item['inmenu']==1)]]
		[[set img = 'published.gif' ]]
	[[else]]	
		[[set img = 'notpublished.gif' ]]
	[[endif]]	
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=inmenu
	[[ endset ]]
	
	{forms.action(link, img,'показать в меню')}
[[endif]]

[[if 'index'  in  actions ]]
		[[if (item['index']==1)]]
			[[set img = 'new.gif' ]]
		[[else]]	
			[[set img = 'notnew.gif' ]]
		[[endif]]	
		
		[[ set link ]]
		 	/admin/?modul={request.modul}&id={item['id']}&action=index
		[[ endset ]]
	
		
		{forms.action(link, img,'Главная')}
[[endif]]

[[if 'newsindex'  in  actions ]]
		[[if (item['newsindex']==1)]]
			[[set img = 'new.gif' ]]
		[[else]]	
			[[set img = 'notnew.gif' ]]
		[[endif]]	
		
		[[ set link ]]
		 	/admin/?modul={request.modul}&id={item['id']}&action=newsindex
		[[ endset ]]
	
		
		{forms.action(link, img,'Публиковать на главной')}
[[endif]]

[[if 'move'  in  actions ]]

	[[set img = 'icon_up.gif' ]]
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=up
	[[ endset ]]
	{forms.action(link, img,'Вверх')}

	[[set img = 'icon_down.gif' ]]
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=down
	[[ endset ]]
	{forms.action(link, img,'Вниз')}

[[endif]]

[[if 'active'  in  actions ]]
	[[if (item['active']==1)]]
		[[set img = 'on.gif' ]]
	[[else]]	
		[[set img = 'off.gif' ]]
	[[endif]]	
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=active[[if request.comm_film_id]]&comm_film_id={request.comm_film_id}[[endif]]
	[[ endset ]]
	
	{forms.action(link, img,'Включить/Выключить')}
[[endif]]

[[if 'comments'  in  actions ]]
	
	[[set img = 'comment.gif' ]]
	
	[[ set link ]]
	 	/admin/?modul=comments&comm_film_id={item['id']}
	[[ endset ]]
	
	{forms.action(link, img,'Коментарии')}
[[endif]]

[[if 'edit'  in  actions ]]
	
	[[set img = 'icon_edit.gif' ]]
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=edit
	[[ endset ]]
	
	{forms.action(link, img,'Редактировать')}
[[endif]]

[[if 'edit_hide_polya'  in  actions ]]
	
	[[set img = 'icon_edit.gif' ]]
	
	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&dop_polya=hide&action=edit
	[[ endset ]]
	
	{forms.action(link, img,'Редактировать')}
[[endif]]

[[if 'delete'  in  actions and (item['delete_security']=='0' or ignor_delete_security)]]

	[[set img = 'del.gif' ]]

	[[ set link ]]
	 	/admin/?modul={request.modul}&id={item['id']}&action=delete[[if request.comm_film_id]]&comm_film_id={request.comm_film_id}[[endif]]
	[[ endset ]]
	
	{forms.action(link, img,'удалить',16,16,'Вы уверенны?')}
[[endif]]






