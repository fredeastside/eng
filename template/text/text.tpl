[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]] 

[[block content]]
											<div class="sleeve act-block">
                                               <div class="breadcrumbs"><a href="#">Главная</a> / Актёры</div>
                                               <h1>{modul.caption}</h1>
                                               <div class="news-content">
                                                   {modul.text|raw}
                                               </div>
                                               
                                           </div> <!-- Sleeve Actor-block -->
[[endblock]]