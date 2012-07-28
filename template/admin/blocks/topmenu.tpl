<div id="topmenu">
	[[for men in menu]]
	<div class="menuitem">
		<a href="./?modul={men['redir']}" [[if men['status']]]class="active" rel_active="active"[[endif]] rel="{loop.index}"><span><span>{men['caption']}</span></span></a>				
	</div>
	[[endfor]]
</div>
<div id="child-container">
	[[for men in menu]]
		/*[[if loop.index==1]]*/
			<div class="child-menu" id="child-{loop.index}" rel="{loop.index}">
				<table><tr><td>
				[[for child in men['child']]]
					<div class="item-group-menu" >
						<h2 style="background-image: url('/images/icons/{child.icons}');">{child.caption}</h2>
						<ul>
							[[for ch in child['child']]]
								<li>
									<a href="/admin/?modul={ch.redir}">{ch.caption}</a>
								</li>
							[[endfor]]
						</ul>
					</div>
				[[endfor]]
				</td></tr></table>
			</div>
		/*[[endif]]*/
	[[endfor]]
</div>