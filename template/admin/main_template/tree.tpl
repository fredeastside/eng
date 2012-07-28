[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ macro childGenerateItem(item,actions,request) ]]
	<div>	
		[[if not item.parent]]
			<img alt="раскрыть" src="/images/admin/munes-hideen.gif" class="plus_parent" rel="plus"/>
		[[endif]]						
		<img alt="перенести" src="/images/admin/parent-mini.png" class="cursor-move" />
		<a href="[[if item['delete_security']]]/admin/?modul={item.modul_redir}[[else]]/admin/?modul={request.modul}&id={item.id}&dop_polya=hide&action=edit[[endif]]" class="droppable_inner[[if item['delete_security']]] delete_security[[endif]]" >{item['caption']}</a>
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

[[block center]]	

<h1>Управление контентом</h1>
<button class="fmk-button-admin" onclick="document.location='/admin/?modul={request.modul}&dop_polya=hide&action=new';return false;"><div><div><div>Добавить страницу</div></div></div></button>
<script type="text/javascript" src="/js/admin/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="/js/admin/admintree.js"></script>
<br /><br />
<div id="tree" >
	{_self.tree(items,actions,request)}
</div>
[[endblock]]