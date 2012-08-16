[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block content]]
[[ include TEMPLATE_PATH ~ "blocks/left_side.tpl"]]

<div class="right-block">

    <div class="cucumbers">
        <a href="/">Главная</a> 
        <span>/</span> <a href="/{incident_url.redir}/">{incident_url.caption}</a>
        <span>/</span> <a href="/{incident_url.redir}/{item.cat.redir}/">{item.cat.name}</a> <span>/</span>
        {item.name}
    </div>
    
    <h1>{item.cat.name}</h1>
    <div class="about-header">{item.name}</div>
    
    {item.text|raw}

</div>
[[endblock]]