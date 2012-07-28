[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left ]]
	[[raw ]]
		<link rel="stylesheet" type="text/css" href="/styles/admin/datepicker.css" />
		<script type="text/javascript" src="/js/datepicker.js"></script>
		<script type="text/javascript" >
			$(document).ready(function(){


			$('#filter-date1').DatePicker({
				format:'d.m.Y',
				[[endraw]]
				date: '{ request.date_start ? request.date_start : "now"|date("d.m.Y") }',
				current: '{"now"|date("d.m.Y")}',
				[[raw ]]
				starts: 1,
				onShow:function() {
					//alert(111);
					return false;
				},
				onChange:function(dateText) {
				   document.getElementById('filter-date1').value = dateText;
				   $('#filter-date1').DatePickerHide();
				}
				});
				
				$('#filter-date2').DatePicker({
				format:'d.m.Y',
				[[endraw]]
				date: '{ request.date_end ? request.date_end : "now"|date("d.m.Y") }', 
				current: '{"now"|date("d.m.Y")}',
				[[raw ]]
				starts: 1,
				onShow:function() {
					//alert(111);
					return false;
				},
				onChange:function(dateText) {
				   document.getElementById('filter-date2').value = dateText;
				   $('#filter-date2').DatePickerHide();
				}
				});

			});
		</script>
	[[endraw]]

	<div class="filters" >
						<table class="rt" >
							<tr>
								<td class="rt-tl"></td>
								<td class="rt-tc" ></td>
								<td class="rt-tr" ></td>
							</tr>
							<tr>
								<td class="rt-ml"></td>
								<td class="rt-mc" >

									<form method="get" action="/admin/index.php" >
									<input name="modul" value="{request.modul}" type="hidden" /> 
									<img alt="" src="/images/admin/celendar-mini.gif">
									Дата добавления <br />
									<table><tr>
									<td>
										c
									</td>
									<td>
										<input type="text" class="filter-date" id="filter-date1" name="date_start" value="{request.date_start}"  > <img src="/images/vcard_delete.png" onclick="$('#filter-date1').val('');"  />
									</td>
									</tr><tr>
									<td>
										по 
									</td>
									<td>
										<input type="text" class="filter-date" id="filter-date2" name="date_end" value="{request.date_end}" /> <img src="/images/vcard_delete.png" onclick="$('#filter-date2').val('');"  />
									</td></tr></table>
									<br />
									<input type="submit" name="" value="Применить"   />
									</form>
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
[[endblock]]

[[block center]]	


	[[block sub_menu]]
		{parent()}
	[[endblock]]
	<div class="page-content">
	<h1>Галерея</h1>
	
	{mod['text']}
	<script type="text/javascript" src="/js/gallery/admin-gallery.js"></script>
	<div id="iframe-pole" style="position: absolute; top: -81px; left: 136px;z-index: 9999999;width: 800px; min-height: 500px;display: none;"></div>
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
					<a href="/modules/fmakeGallery/index.php?id_gallery={item.id}" onclick="return false;" id="link-gallery"  class="action-link" ><div><img src="/images/admin/and.png" alt="" /></div>Добавить Галерею</a>
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

<!-- Галерея всплывающее окно -->

	
	[[if pages]]
		<div class="pager" >
		
		<span><a href="/admin/index.php?modul={request.modul}&page=0[[if request.status]]&status={request.status}[[endif]]" [[if page == 1 ]]class="active"[[endif]] title="Страница 0" >первая</a></span> ..
		[[ set start = page//limitOnpage*limitOnpage - 1]]
		[[ set end = start + limitOnpage + 1]]
		
		[[ for i in start..end ]]
			[[ if i <= pages and i > 0]]
				<span><a href="/admin/index.php?modul={request.modul}&page={i}[[if request.status]]&status={request.status}[[endif]][[if request.date_start]]&date_start={request.date_start}[[endif]][[if request.date_end]]&date_end={request.date_end}[[endif]]" [[if i==page ]]class="active"[[endif]] title="Страница {i}" >{i}</a></span>
			[[ endif ]]
		[[ endfor ]]
		
		
		.. <span><a href="/admin/index.php?modul={request.modul}&page={pages}[[if request.status]]&status={request.status}[[endif]]" [[if pages==page ]]class="active"[[endif]] title="Страница {pages}" >последняя</a></span>
		
		
		</div>
	[[endif]]
	
	[[if items ]]
	<table class="main-table">
		<tbody>
		<tr class="td-header">
			[[for fild in filds]]
				<td>{fild}</td>
			[[endfor]]
		</tr>
		[[for key,item in items]]
		<tr class="td-item"  >
			<td >
				<a onclick="return false;" id="link-gallery" href="/modules/fmakeGallery/index.php?id_gallery={item.id}" class="f14" >{item.caption}</a>
			</td>
			<td align="center" width="270px">
				<a class="f13" onclick="return false;" id="link-gallery" href="/modules/fmakeGallery/index.php?id_gallery={item.id}">
					<img alt="" src="{item.thumb}"><br>
				</a>
			</td>
			
			<td align="center" >
				<a onclick="return false;" id="link-gallery" href="/modules/fmakeGallery/index.php?id_gallery={item.id}">
					<img height="" border="0" width="" alt="" src="/images/admin/actions/icon_edit.gif">
				</a>

				<a onclick="return confirm('Вы уверенны?');" href="	 	/admin/?modul={request.modul}&amp;id={item.id}&amp;action=delete">
					<img height="16" border="0" width="16" alt="удалить" src="/images/admin/actions/del.gif">
				</a>
			</td>
		</tr>
		[[endfor]]
	</tbody></table>
	[[else]]
		<h1>Не найдено ни одной галереи</h1>
	[[endif]]	
	</div>
[[endblock]]	