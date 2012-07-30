[[ macro input(name, value, type, size) ]]
    <input type="{ type|default('text') }" name="{ name }}" value="{ value|e }" size="{ size|default(20) }" />
[[ endmacro ]]

[[ macro action(link,src,alt,width,height,confirm) ]]
	<a href="{link}" [[if confirm]] onclick="return confirm('{confirm}');"  [[endif]]>
		<img src="/images/admin/actions/{src}" width="{ width }" height="{ height }" border="0" alt="{alt}" title="{alt}"/>
	</a>
[[ endmacro ]]