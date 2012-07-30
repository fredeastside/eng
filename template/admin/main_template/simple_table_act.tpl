	
	<h1>{mod['caption']}</h1>
	
	{mod['text']}

	<div class="actions" >
		<table class="rt" >
			<tr>
				<td class="rt-tl"></td>
				<td class="rt-tc" ></td>
				<td class="rt-tr" ></td>
			</tr>
			<tr>
				<td class="rt-ml"></td>
				<td class="rt-mc" >
					<a href="/admin/?modul={request.modul}&action=new" class="action-link" ><div><img src="/images/admin/and.png" alt="" /></div>Добавить страницу</a>
				</td>
				<td class="rt-mr" ></td>
			</tr>
			<tr>
				<td class="rt-bl"></td>
				<td class="rt-bc" ></td>
				<td class="rt-br" ></td>
			</tr>
		</table>
	</div>

	[[if content]]
		{content}
		<BR><BR>
	[[ endif ]]
	
	<table border="0" cellspacing="1" cellpadding="0" class="main-table"  id="main-table">
	<thead>
		<tr class="td-header" >
	[[for fild in filds]]
		<td>{fild}</td>
	[[endfor]]
	
	<td >Управление</td>
	</tr>
	</thead>
	
	<tbody>
		[[for key,item in items]]
			<tr class="td-item">		
				
			[[for key,fild in filds]]
			<td  
				[[if loop.first]]
					style="padding: 0 0 0 {item['level']*20}px"
				[[endif]]
				>{item[key]}</td>	
			[[endfor]]
			<td valign="middle" align="center">
				[[ include TEMPLATE_PATH ~ "admin/blocks/actions.tpl" ]]
			</td>
			</tr>
		[[endfor]]	
	</tbody></table>