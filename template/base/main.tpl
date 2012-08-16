[[ include TEMPLATE_PATH ~ "blocks/header.tpl"]]
    <body>
        <!-- PAGE -->
        <div id="page">
            <div class="p-inner">
                <div class="emailpopup" id="popup99">
                    <div class="inputfield"><input onfocus="$(this).css('border', '1px solid #D7D7D7')" id="main_form_email" type="text" name="email" value="" />
                    <textarea name="msg" id="main_form_msg" rows="5" cols="10" onfocus="$(this).css('border', '1px solid #D7D7D7')"></textarea></div>
                    <div class="inputnames">
                        <span class="inputname emailname">Email</span> <br/>
                        <span class="inputname">Письмо</span>
                    </div>
                    <div class="emailsendpopup"><a href="#" onclick="sendLetter(); return false;">Отправить</a></div>
                    <div id="right_send">Сообщение отправлено!</div>
                </div>
                <div class="sharepopup" id="popup98">
                    <div class="linkstoshare">
                        <a href="http://vkontakte.ru/share.php?url=http://{hostname}/">Vkontakte</a>
                        <a href="http://www.facebook.com/share.php?u=http://{hostname}/&t={modul.title}">Facebook</a>
                        <a href="http://twitter.com/intent/tweet?text={modul.title}&url=http://{hostname}/">Twitter</a>
                    </div>
                </div>
                <div id="head">
                    <a href="/"><span id="logo"></span></a>
                    <div class="nav-top">
                        <span class="share"><a id="link98" href="javascript:display('show', 98)">Поделиться</a></span>
                        <!--span class="sitemap"><a href="#">Карта сайта</a></span-->
                        <span class="emailto"><a id="link99" href="javascript:display('show', 99)">Написать нам</a></span>
                    </div>
                    <div class="banner">{configs.main_banner|raw}</div>

                </div>
                <div id="content">  
                    [[block content]]
                    <div class="advertise-block">
                        [[ include TEMPLATE_PATH ~ "blocks/photo_reports.tpl"]]
                        <div class="banner-right">
                            {configs.right_block|raw}
                        </div>
                    </div>
                    [[ include TEMPLATE_PATH ~ "blocks/left_side.tpl"]]
                    <div class="right-block">
						[[ include TEMPLATE_PATH ~ "blocks/news.tpl"]]
						[[ include TEMPLATE_PATH ~ "blocks/incidents.tpl"]]
                        <div class="smallblocks">
                            <table>
                                <tr>
                                    <td>
                                        [[ include TEMPLATE_PATH ~ "blocks/meets.tpl"]]
                                        [[ include TEMPLATE_PATH ~ "blocks/places.tpl"]]
                                        [[ include TEMPLATE_PATH ~ "blocks/business_news.tpl"]]
                                        [[ include TEMPLATE_PATH ~ "blocks/education_news.tpl"]]                                        
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    [[endblock]]
                </div>
                <div class="cl"></div>
                <!-- CONTENT -->
                <div class="cl"></div>                    

            </div>
[[ include TEMPLATE_PATH ~ "blocks/footer.tpl"]]
    </body>
</html>