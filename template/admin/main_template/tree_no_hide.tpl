[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ macro childGenerateItem(item,actions,request) ]]
	<div>							
		<img alt="перенести" src="/images/admin/parent-mini.png" class="cursor-move" />
		<a href="[[if item['delete_security']]]/admin/?modul={item.modul_redir}[[else]]/admin/?modul={request.modul}&id={item.id}&action=edit[[endif]]" class="droppable_inner[[if item['delete_security']]] delete_security[[endif]]" >{item['caption']}</a>
		<div class="actions" >
			[[ include TEMPLATE_PATH ~ "admin/blocks/actions.tpl" ]]
		</div>
	</div>
[[ endmacro ]]


[[ macro lineConstructor(item,actions,request) ]]
	<li class="droppable draggable" rel="id:{item['id']};" >
		{ _self.childGenerateItem(item,actions,request) }
		<ul class="children">
			[[for item in item['child']]]
				{ _self.lineConstructor(item,actions,request) }
			[[endfor]]
		</ul>
	</li>
[[endmacro]]

[[ macro tree(items,actions,request) ]]
	<ul class="dotted" >
		<li class="droppable">
			<ul class="children no-bg" >
			[[for item in items]]
					{_self.lineConstructor(item,actions,request)}
			[[ endfor ]]
			</ul>
		</li>
	</ul>
[[endmacro]]



[[ block left ]]
	
[[endblock]]

[[block center_all]]	

[[phpcode`
	$context['xajax']->printJavascript("/libs/xajax/");
`]] 

<div class="center-content-all">
	[[block sub_menu]]
		{parent()}
	[[endblock]]
	
<div class="page-content" >
	
	<table class="rt" >
		<tr>
			<td class="rt-tl"></td>
			<td class="rt-tc" ></td>
			<td class="rt-tr" ></td>
		</tr>
		<tr>
			<td class="rt-ml"></td>
			<td class="rt-mc">
				
				<h1>{mod['caption']}</h1> 
				
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
									<a href="/admin/?modul={request.modul}&action=new" class="action-link" ><div><img src="/images/admin/and.png" alt="" /></div>Добавить</a>
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
				<br />
				<div id="tree" >
						{_self.tree(items,actions,request)}
				</div>
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
</div>
[[endblock]]