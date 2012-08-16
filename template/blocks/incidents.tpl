						[[if incidents]]
						<div class="blockmid">
                            <h2 class="block-name"><em>Происшествия</em></h2>
                            <div class="cl"></div>
                            <ul>
								[[for item in incidents]]
                                <li><a href="/[[if not(url)]]{incident_url.redir}[[else]]{url}[[endif]]/{item.cat_redir}/{item.redir_incident}/">{item.name_incident}</a></li>
								[[endfor]]
                            </ul>
                            <div class="events-all"><a href="/{incident_url.redir}/">Все происшествия</a></div>
                        </div>
						[[endif]]