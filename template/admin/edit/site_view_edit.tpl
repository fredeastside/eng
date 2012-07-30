[[ extends  TEMPLATE_PATH ~ "admin/main.tpl" ]]

[[ block left ]]
	
[[endblock]]

[[block center_all]]	
	[[raw]]
		<script>
			function changeStatus(status){
				$('#status').val(status);
				document.form.submit();
			}
		</script>
	[[endraw]]

	<div class="center-content-all">
			[[block sub_menu]]
				{parent()}
			[[endblock]]

	
						<br />
						<div class="navigation" >
							<a href="./">Главная</a> / 
							[[for men in menu]]
								[[if men['status'] ]]
									<a href="./index.php?modul={men['redir']}">{men['caption']}</a> / 
								[[endif]]
							[[endfor]]
						</div>
						
						<h2>{request.message}</h2>
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
										[[ autoescape false ]]
										{ content }
										[[ endautoescape ]]
										<h1>Текущий статус сайта - "{status[items['status']]}"</h1>
										<div style="margin: 0 0 0 420px;" >
											
											<a href="./" class="btn btn-purpure primary f14 primary-padding" onclick="changeStatus(2);return false;" ><span><span>Плохой</span></span></a>
											<a href="./" class="btn primary f14 primary-padding" onclick="changeStatus(4);return false;"><span><span>Отложен</span></span></a>
											<button name="save" class="action-button" onclick="changeStatus(3);return false;" ><div></div><span>Хороший</span> Хороший</button>
											
										</div>
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