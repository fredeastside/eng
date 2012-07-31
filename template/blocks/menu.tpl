						<div class="nav-left">
							[[for item in menu]]
							[[if not(item.status)]]
                            <dl>
                                <dt><a href="[[if item.index == 1]]/[[else]]/{item.redir}/[[endif]]">{item.caption}</a></dt>
                            </dl>
							[[else]]
							<dl class="active">
								<dt><a href="[[if item.index == 1]]/[[else]]/{item.redir}/[[endif]]">{item.caption}</a></dt>
								[[if item.child]]
									[[for child_item in item.child]]
									<dd>
										<a href="/{item.redir}/{child_item.redir}/" [[if loop.last]]class="last"[[endif]]>{child_item.name}</a>
									</dd>
									[[endfor]]
								[[endif]]
                            </dl>
							[[endif]]
                            <!--dl>
                                <dt><a href="#">Политика</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Образование</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Спорт</a></dt>
                            </dl>      
                            <dl>
                                <dt><a href="#">Город</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Афиша города</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Места</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Бизнес</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Финансы</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Объявление</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Маркет</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Работа</a></dt>
                            </dl>
                            <dl>
                                <dt><a href="#">Авто</a></dt>
                            </dl-->
							[[endfor]]
                        </div>