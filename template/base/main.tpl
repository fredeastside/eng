[[ include TEMPLATE_PATH ~ "blocks/header.tpl"]]

    <body>
        <!-- PAGE -->
        <div id="page">
            <div class="lozung">
            	Скоро открытие сайта,<br/> хочешь узнать первым?<br/>
				<img src="/images/site.jpg" />
            </div>
            <div class="logo">
            	<img src="/images/logo.png" />
            </div>
            <div class="feedback">
            	[[if message]]
            		<div class="text-message">
            			{message}
            		</div>
            	[[else]]
            		[[for er in errors]]
            			<div class="error">
            				{er}<br/>
            			</div>
            		[[endfor]]
	            	<form action="" method="post">
	            		<input type="hidden" name="action" value="feedback" />
	            		<input class="input_big fieldfocus" type="text" name="email" value="{request.email}" title="Введите e-mail" /><br/>
	            		<a onclick="$('form').submit();" class="link_feedback" href="#">Отправить</a>
	            	</form>
            	[[endif]]
            </div>
        </div>
        <!-- PAGE -->
    </body>
</html>