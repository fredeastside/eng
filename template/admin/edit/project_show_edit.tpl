[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left ]]
	
[[endblock]]

[[block center_all]]	
	<div class="center-content-all">
	
	[[phpcode`
		$context['xajax']->printJavascript("/libs/xajax/");
	`]] 
	
	[[block sub_menu]]
		{parent()}
	[[endblock]]
						<br />
						<div class="navigation" >
							<a href="/">Главная</a> / 
							[[for men in menu]]
								[[if men['status'] ]]
									<a href="./index.php?modul={men['redir']}">{men['caption']}</a> / 
								[[endif]]
							[[endfor]]
						</div>
						

					 	<div class="page-content" >
							<table class="rt" >
								<tr>
									<td  class="rt-tl"></td>
									<td class="rt-tc" ></td>
									<td class="rt-tr" ></td>
								</tr>
								<tr>
									<td class="rt-ml"></td>
									<td class="rt-mc">
										<div id="fixed-count-sites" ><table>
										<tr><td>Подходящих сайтов</td><td id="count-sites">0</td></tr>
										<tr><td></td><td align="right" <a onclick="$('#fixed-count-sites').hide();return false;" class="btn primary" href="./"><span class="f12"><span>я понял</span></span></a></td></tr>	
										</table></div>
										[[ autoescape false ]]
										{ content }
										[[ endautoescape ]]
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