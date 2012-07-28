[[if pages>1]]
<div class="counter">
	[[if page==1]]
		
	[[else]]
			<a href="/{request.modul}/page-{page-1}/[[if request.text]]{request.text}[[endif]]" class="active"> << </a>
	[[endif]]
	[[if pages<=10]]
		[[set k1 = 1]]
		[[set k2 = pages]]
	[[else]]
		[[if page>0 and page<=7]]
			[[set k1 = 1]]
			[[set k2 = 9]]
			[[set k3 = 1]]
		[[elseif page<=pages and page>=pages-7]]
			[[set k1 = pages-9]]
			[[set k2 = pages]]
			[[set k3 = 2]]
		[[else]]
			[[set k1 = page-3]]
			[[set k2 = page+3]]
			[[set k3 = 3]]
		[[endif]]
	[[endif]]
	[[if k3==2 or k3==3]]
			<a href="/{request.modul}/page-1/[[if request.text]]{request.text}[[endif]]">1</a>
			...
	[[endif]]
	
	[[for i in k1 .. k2]]
		[[if page==i]]
			<a href="javascript: void(0);" class="active">{i}</a>
		[[else]]
			<a href="/{request.modul}/page-{i}/[[if request.text]]{request.text}[[endif]]">{i}</a>
		[[endif]]
	[[endfor]]

	[[if k3==1 or k3==3]]
			...
			<a href="/{request.modul}/page-{pages}/[[if request.text]]{request.text}[[endif]]">{pages}</a>
	[[endif]]
	
	[[if page==pages]]
		
	[[else]]
			<a href="/{request.modul}/page-{page+1}/[[if request.text]]{request.text}[[endif]]" class="active">>></a>
	[[endif]]
</div>
[[endif]]