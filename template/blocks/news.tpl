						<h1>Главные новости</h1>
                        <div class="main-news">
							[[if main_new]]
                            <div class="left-info">
                                <img alt="img1" src="/images/sitemodul_image/{main_new.id}/vb{main_new.picture}"/>
                                <div class="left-text">
                                    <div class="headlink"><a href="/[[if not(url)]]{news_url}[[else]]{url}[[endif]]/{main_new.cat_redir}/{main_new.redir}">{main_new.name}</a></div>
                                    <span>{main_new.anons}</span>
                                    <div class="moreinfo"><a href="/[[if not(url)]]{news_url}[[else]]{url}[[endif]]/{main_new.cat_redir}/{main_new.redir}">Подробнее</a></div>
                                </div>
                            </div>
							[[endif]]
							[[if news]]
                            <div class="right-info">
                                <ul>
									[[for new_item in news]]
                                    <li><a href="/[[if not(url)]]{news_url}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}">{new_item.name_new}</a></li>
									[[endfor]]
                                </ul>
                            </div>
							[[endif]]
                        </div>