[[ include TEMPLATE_PATH ~ "blocks/header.tpl"]]
    <body>
        <!-- PAGE -->
        <div id="page">
            <div class="p-inner">
                <div class="emailpopup" id="popup99">
                    <div class="inputfield"><input type="text" name="Email" value="{configs.email}" />
                    <textarea name="text" rows="5" cols="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit</textarea></div>
                    <div class="inputnames">
                        <span class="inputname emailname">Email</span> <br/>
                        <span class="inputname">Письмо</span>
                    </div>
                    <div class="emailsendpopup"><a href="#">Отправить</a></div>
                </div>
                <div class="sharepopup" id="popup98">
                    <div class="linkstoshare">
                        <a href="#">Vkontakte</a>
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                    </div>
                </div>
                <div id="head">
                    <a href="#"><span id="logo"></span></a>
                    <div class="nav-top">
                        <span class="share"><a id="link98" href="javascript:display('show', 98)">Поделиться</a></span>
                        <span class="sitemap"><a href="#">Карта сайта</a></span>
                        <span class="emailto"><a id="link99" href="javascript:display('show', 99)">Написать нам</a></span>
                    </div>
                    <div class="banner">{configs.main_banner|raw}</div>

                </div>
                <div id="content">  
                    <div class="advertise-block">
                        <div class="img-hoverlink">
                            <div class="hoverlink"><a href="#">Спасатели обнаружили обломки сбитого Сирией турецкого ...</a></div>
                            <img src="/images/news1.jpg" alt="news1"/>            
                        </div>
                        <div class="img-hoverlink">
                            <div class="hoverlink"><a href="#">Глава дипломатии Евросоюза обеспокоена ситуацией ...</a></div>
                            <img src="/images/news2.jpg" alt="news2"/>            
                        </div>
                        <div class="banner-right">
                            {configs.right_block|raw}
                        </div>
                    </div>
                    <div class="left-menu">
                        <h1>Навигация</h1>
						[[ include TEMPLATE_PATH ~ "blocks/menu.tpl"]]
                        <div class="banner-left">
                            {configs.left_block|raw}
                        </div>

                    </div>
                    <div class="right-block">
                        <h1>Главные новости</h1>
                        <div class="main-news">
                            <div class="left-info">
                                <img alt="img1" src="/images/img.png"/>
                                <div class="left-text">
                                    <div class="headlink"><a href="#">Ночь в музее 2012 в Энгельсе</a></div>
                                    <span>В Энгельсе всего один музей принял участие в акции «Ночь музеев» — краеведческий. С одной стороны это хорошо.</span>
                                    <div class="moreinfo"><a href="#">Подробнее</a></div>
                                </div>
                            </div>
                            <div class="right-info">
                                <ul>
                                    <li><a href="#">Назначены судьи Энгельсского районного суда</a></li>
                                    <li><a href="#">Силовики искали взрывное устройство на мосту <br/> Саратов-Энгельс</a></li>
                                    <li><a href="#">Условные террористы захватили школу в Энгельсе</a></li>
                                    <li><a href="#">Прокуратура обжаловала приговор по делу Елены Таутиновой</a></li>
                                    <li><a href="#">Администрация решила потратить казенные деньги на свои новые окна</a></li>
                                    <li><a href="#">Энгельсский шаолинь на Казантипе с извинениями бросался на людей</a></li>
                                    <li><a href="#">Назначены судьи Энгельсского районного суда</a></li>
                                    <li><a href="#">Силовики искали взрывное устройство на мосту</a></li>
                                </ul>
                            </div>    
                        </div>
                        <div class="blockmid">
                            <h2 class="block-name"><em>Происшествия</em></h2>
                            <div class="cl"></div>
                            <ul>
                                <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                <li><a href="#">Переезд чиновников в "новую Москву" обойдется в $10 млрд В.Путин на саммите G20: Россия выделит МВФ до $10 млрд</a></li>
                                <li><a href="#">Слухи о смерти Хосни Мубарака опровергнуты</a></li>
                                <li><a href="#">Найдено тело одной из пропавших под Иркутском девочек</a></li>
                                <li><a href="#">Евро-2012: Франция сыграет с Испанией в плей-офф.Слухи о смерти Хосни Мубарака опровергнуты</a></li>
                                <li><a href="#">М.Ромни: Россия - наш геополитический противник</a></li>
                                <li><a href="#">Джулиан Ассандж попросил политубежища в Эквадоре</a></li>
                            </ul>
                            <div class="events-all"><a href="#">Все происшествия</a></div>
                        </div>
                        <div class="smallblocks">
                            <table>
                                <tr>
                                    <td>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Ближайшие события города</em></h2>
                                            <div class="cl"></div>

                                            <div class="block-background">
                                                <div class="background-bottom">
                                                    <div class="background-mid">
                                                        <div class="searchlink"><a href="#">Поиск событий</a></div>
                                                        <div class="moreinfo lastmore"><a href="#">Подробнее</a></div>
                                                        <div class="news-item">
                                                            <div class="header"><a href="#">Путин помирит Ближний Восток</a></div>
                                                            <div class="item-text">В Польшу для участия в новых драках едут несколько сотен российских хулиганов, которые намерены мстить за нападение на болельщиков, сообщил источник в одной из московских околофутбольных группировок.</div>
                                                            <div class="moreinfo youaresospecial"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="news-item">
                                                            <div class="header"><a href="#">В Новосибирске аварийно сел самолет</a></div>
                                                            <div class="item-text">В новосибирском аэропорту "Толмачево" совершил аварийную посадку Boeing 757 авиакомпании "ВИМ-Авиа", летевший из Екатеринбурга в Ханой. Как сообщается на сайте Западно-Сибирского управления на транспорте СК РФ, инцидент произошел около 6 утра по местному времени.</div>
                                                        </div> 
                                                        <div class="cl"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="blockmidleft sosedbackground">
                                            <h2 class="block-name"><em>Места</em></h2>
                                            <div class="cl"></div>
                                            <div class="news-item">
                                                <div class="header"><a href="#">Мубарака могут освободить</a></div>
                                                <div class="item-text">Административный суд Египта 7 июля рассмотрит ходатайство, поданное адвокатами приговоренного к пожизненному </div>
                                                <div class="moreinfo"><a href="#">Подробнее</a></div>
                                            </div>
                                            <div class="news-item">
                                                <div class="img-left"><img alt="smallimg" src="/images/imgsmallnews.jpg"/></div>
                                                <div class="right-item">
                                                    <div class="header"><a href="#">Сдаются в аренду места</a></div>
                                                    <div class="item-text">Административный суд Египта 7 июля рассмотрит ходатайство, поданное адвокатами приговоренного к пожизненному</div>
                                                    <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                </div>
                                                <div class="cl"></div>
                                            </div>   
                                            <div class="places">
                                                <a href="#">Рестораны</a>
                                                <a href="#">Кафе</a>
                                                <a href="#">Бары</a>
                                                <a href="#">Парки</a>
                                                <br/>
                                                <a href="#">Музеи</a>
                                                <a href="#">Театры</a>
                                                <a href="#">Стадионы</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все места</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <div class="blockmidleft">
                                            <h2 class="block-name"><em>Финансы</em></h2>
                                            <div class="cl"></div>
                                            <div>
                                                <div class="left-info">
                                                    <img alt="img1" src="/images/mib.jpg"/>
                                                    <div class="left-text">
                                                        <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                        <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                    </div>
                                                </div>
                                                <div class="right-info">
                                                    <ul>
                                                        <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                        <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                        <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="cl"></div>
                                            <div class="placessmall">
                                                <a href="#">Банки</a>
                                                <a href="#">Страховые компании</a>
                                                <a href="#">Инвестиционные компании</a>
                                                <a href="#">Негосударственные пенсионные фонды</a>
                                                <a href="#">Ломбарды</a>
                                            </div>
                                            <div class="events-all"><a href="#">Все финансы</a></div>

                                        </div>
                                        <h2 class="block-name midbackname"><em>Недвижимость</em></h2>
                                        <div class="blockmidleft midbackground">
                                            <div class="midbackbot">
                                                <div class="midbackmid">
                                                    <div class="left-info-background">
                                                        <div class="left-info">
                                                            <img alt="img1" src="/images/mib.jpg"/>
                                                            <div class="left-text">
                                                                <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                                <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                            </div>                                  
                                                        </div>
                                                        <div class="right-info">
                                                            <ul>
                                                                <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                                <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                                <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="placessmall">
                                                            <a href="#">Строительные компании</a>
                                                            <a href="#">Агентства недвижимости</a>
                                                            <a href="#">Ипотека</a>
                                                            <a href="#">Новостройки</a>
                                                        </div>
                                                        <div class="events-all"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="right-info-background">
                                                        <h3>Объявления</h3>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="events-all bottom"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="cl"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="block-name midbackname"><em>Авто</em></h2>
                                        <div class="blockmidleft midbackground">
                                            <div class="midbackbot">
                                                <div class="midbackmid">
                                                    <div class="left-info-background">
                                                        <div class="left-info">
                                                            <img alt="img1" src="/images/mib.jpg"/>
                                                            <div class="left-text">
                                                                <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                                <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                            </div>                                  
                                                        </div>
                                                        <div class="right-info">
                                                            <ul>
                                                                <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                                <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                                <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="placessmall">
                                                            <a href="#">Строительные компании</a>
                                                            <a href="#">Агентства недвижимости</a>
                                                            <a href="#">Ипотека</a>
                                                            <a href="#">Новостройки</a>
                                                        </div>
                                                        <div class="events-all"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="right-info-background">
                                                        <h3>Объявления</h3>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="events-all bottom"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="cl"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="block-name midbackname"><em>Работа</em></h2>
                                        <div class="blockmidleft midbackground">
                                            <div class="midbackbot">
                                                <div class="midbackmid">
                                                    <div class="left-info-background">
                                                        <div class="left-info">
                                                            <img alt="img1" src="/images/mib.jpg"/>
                                                            <div class="left-text">
                                                                <div class="headlink"><a href="#">Мубарака освободят</a></div>
                                                                <span>Административный суд Египта 7 июля рассмотрит.</span>
                                                            </div>                                  
                                                        </div>
                                                        <div class="right-info">
                                                            <ul>
                                                                <li><a href="#">Депозиты на акции: Еще один способ борьбы с кризисом</a></li>
                                                                <li><a href="#">По делу о крушении Ту-134 в Карелии обвинен чиновник Росавиации</a></li>
                                                                <li><a href="#">Судья лишил сборную Украины шанса на выход в плей-офф Евро-2012.</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="placessmall">
                                                            <a href="#">Строительные компании</a>
                                                            <a href="#">Агентства недвижимости</a>
                                                            <a href="#">Ипотека</a>
                                                            <a href="#">Новостройки</a>
                                                        </div>
                                                        <div class="events-all"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="right-info-background">
                                                        <h3>Объявления</h3>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="advertise-item">
                                                            <div class="advertise-head"><a href="#">2-х комнатная квартира в центре</a></div>
                                                            <div class="advertise-text">Продаётся квартира с хорошим ремонтом стоимость 3 млн. </div>
                                                            <div class="moreinfo"><a href="#">Подробнее</a></div>
                                                        </div>
                                                        <div class="events-all bottom"><a href="#">Посмотреть весь раздел</a></div>
                                                    </div>
                                                    <div class="cl"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="cl"></div>
                <!-- CONTENT -->
                <div class="cl"></div>                    

            </div>
[[ include TEMPLATE_PATH ~ "blocks/footer.tpl"]]
    </body>
</html>