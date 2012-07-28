<div class="breadcrumbs">
	<a href="/" >Главная</a>
	[[for b in breadcrubs]]
		[[if loop.last]]
			 / {b.caption}
		[[else]]
			/ <a href="{b.link}" >{b.caption}</a> 
		[[endif]]
	[[endfor]]
</div>