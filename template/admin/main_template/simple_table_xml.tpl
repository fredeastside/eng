[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left ]]
	
[[endblock]]

[[block center]]

<h1>Управление контентом</h1>
<button class="fmk-button-admin" onclick="document.location='/admin/?modul={request.modul}&action=new';return false;"><div><div><div>Добавить</div></div></div></button>
<br /><br />
<script src="/js/admin/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="/js/admin/jquery.jqGrid.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/styles/admin/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="/styles/admin/smoothness/jquery-ui-1.8.16.custom.css" />
[[raw]]
<script type="text/javascript">
$(function(){ 
  $("#list").jqGrid({
    url:'example.php',
    datatype: 'xml',
    mtype: 'GET',
    colNames:[
              [[endraw]]
              	[[for fild in filds]]
              		[[if loop.last]]'{fild}'[[else]]'{fild}',[[endif]]
            	[[endfor]]
              [[raw]]
    ],
    colModel :[ 
      [[endraw]]
	      [[for fild in filds]]
			[[if loop.last]]
				[[raw]]{name:[[endraw]]'{fild}'[[raw]], index:[[endraw]]'{fild}'[[raw]], width:55}[[endraw]]
			[[else]]
				[[raw]]{name:[[endraw]]'{fild}'[[raw]], index:[[endraw]]'{fild}'[[raw]], width:55},[[endraw]]
			[[endif]]
		  [[endfor]]
      [[raw]] 
    ],
    pager: '#pager',
    rowNum:100,
    height: 300,
    width: 1000,
    rowList:[10,50,100],
    sortname: 'invid',
    sortorder: 'desc',
    viewrecords: true,
    gridview: true,
    caption: [[endraw]]'{mod['caption']}'[[raw]],
    editurl:"example.php"
  }); 
}); 
//jQuery("#list").setGridWidth($('#center').width()-30, true);
$(window).bind('resize', function() {
    jQuery("#list").setGridWidth($('#center').width()-100, true);
}).trigger('resize');
					
</script>
[[endraw]]
<table id="list"><tr><td/></tr></table> 
<div id="pager"></div> 
					

/*<div class="center-content-all">
[[block sub_menu]]
	{parent()}
[[endblock]]

<div class="page-content" >

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
	[[if name_film.caption]]<h1>Коментарии по фильму "{name_film.caption}"</h1>[[endif]]
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

</div>
</div>	*/
[[endblock]]	