<div class="filters">
	<ul class="menu-left">
		[[for child in menu[0]['child']]]
			<li>
				<a href="" class="menu-left-main [[if child.status]]active[[endif]]" rel="{loop.index}" >{child.caption}</a>
				<ul class="child-left" id="child-left-{loop.index}" [[if not child.status]]style="display:none;"[[endif]]>
					[[for ch in child['child']]]
						<li>
							<a class="[[if ch.status]]active[[endif]]" href="/admin/?modul={ch.redir}">{ch.caption}</a>
						</li>
					[[endfor]]
				</ul>
			</li>
		[[endfor]]
	</ul>
</div>