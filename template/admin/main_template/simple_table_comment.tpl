[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left_content ]]
	<div id="left">
		[[ include TEMPLATE_PATH ~ "admin/blocks/leftmenu.tpl" ]]
		[[ include TEMPLATE_PATH ~ "admin/blocks/filtercomment.tpl" ]]
	</div>
[[endblock]]

[[block center]]

[[raw]]
<script type="text/javascript" >

function check_all(id, name, state){
	
	
	
	var parent = document.getElementById(id);
	
	if (!parent)
	{
		eval('parent = document.' + id);
	}

	if (!parent)
	{
		return;
	}
	
	var rb = parent.getElementsByTagName('input');
	
	for (var r = 0; r < rb.length; r++)
	{
		if (rb[r].name.substr(0, name.length) == name)
		{
			rb[r].checked = state;
		}
	}
}

	function invert_all(id, name){
		var parent = document.getElementById(id);
		if (!parent)
		{
			eval('parent = document.' + id);
		}
	
		if (!parent)
		{
			return;
		}
		
		var rb = parent.getElementsByTagName('input');
		
		for (var r = 0; r < rb.length; r++)
		{
			if (rb[r].name.substr(0, name.length) == name)
			{
				rb[r].checked = !rb[r].checked;
			}
		}		
	}

</script> 
[[endraw]]

<h1>{mod.caption}</h1>
[[if name_film.caption]]<h2>Коментарии по фильму "{name_film.caption}"</h2>[[endif]]
/*<button class="fmk-button-admin" onclick="document.location='/admin/?modul={request.modul}&action=new';return false;"><div><div><div>Добавить</div></div></div></button>*/
[[if config_modul]]<button class="fmk-button-admin" onclick="document.location='{config_modul}';return false;"><div><div><div>Настройки</div></div></div></button>[[endif]]
<br /><br />
[[if content]]
		{content}
		<BR><BR>
	[[ endif ]]
	
	[[if pages]]
		<div class="pager" >
		[[for i in 1..pages]]
			<span><a href="/admin/index.php?modul={request.modul}&page={i}" [[if i==page ]]class="active"[[endif]] title="Страница {i}" >{i}</a></span>  
		[[endfor]]
		</div>
	[[endif]]
	[[ if items ]]
	<form method="POST" action="{request_url}">
		<table border="0" cellspacing="1" cellpadding="0" class="main-table"  id="main-table">
		<thead>
			<tr class="td-header" >
			<td><input type="checkbox" name="check_action[]" onclick="check_all('main-table','check_action',this.checked);" value=""></td>
		[[for fild in filds]]
			<td>{fild}</td>
		[[endfor]]
		
		<td >Управление</td>
		</tr>
		</thead>
		
		<tbody>
			[[for key,item in items]]
				<tr class="td-item">		
				<td style="text-align: center;"><input type="checkbox" name="check_action[]"  value="{item['id']}"></td>	
				[[for key,fild in filds]]
				<td  
					[[if loop.first]]
						style="padding: 0 0 0 {item['level']*20+20}px"
					[[endif]]
					>{item[key]}</td>	
				[[endfor]]
				<td valign="middle" align="center">
					[[ include TEMPLATE_PATH ~ "admin/blocks/actions.tpl" ]]
				</td>
				</tr>
			[[endfor]]	
		</tbody></table>
		<br/>
		<div class="quick">
			выберите действие: <select name="group_action" >
				[[if group_actions]]
					<option value="0"></option>
					[[for gr_action in group_actions]]
						<option value="{gr_action}">{group_action_val[gr_action]}</option>
					[[endfor]]
				[[endif]]
				</select>
			<input class="button2" value="Выполнить" type="submit">

		</div>

		<div class="quick">
			/*<input class="button2" name="delall" value="Удалить все" type="submit" onclick="javascript: return confirm('Удалить все записи?');" >&nbsp;*/
			<input class="button2" name="delmarked" value="Удалить отмеченные" type="submit" onclick="javascript: return confirm('Удалить отмеченные записи?');" ><br>
			<p class="small"><a href="javascript: void(0);" onclick="check_all('main-table','check_action',true); return false;">Отметить все</a> • <a href="javascript: void(0);" onclick="invert_all('main-table','check_action',true); return false;">Инвертировать</a> • <a href="javascript: void(0);" onclick="check_all('main-table','check_action',false); return false;">Снять выделение</a></p>
		</div>
	</form>
	[[else]]
		<h2>Нет комментариев</h2>
	[[endif]]
[[endblock]]	