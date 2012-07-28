<div class="menu1">
	<div>
	[[for item in menu]]
		[[if loop.index%5==0]]
		</div>
		<div class="sec">
		[[endif]]
			<a href="/{item.redir}/"><button class="common red [[if item.inmenu_new]]activered[[endif]]" type="submit">
	        	<span>
	            	<span>
	                	<span class="button-text">
	                		<span>{item.caption}</span>                                            
	                    </span>                              
	                </span>                                   
	            </span>
	        </button></a>
	[[endfor]]
	</div>
</div>