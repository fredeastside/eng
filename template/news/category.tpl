[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block content]]
<div class="left-menu">
    <h1>Навигация</h1>
    [[ include TEMPLATE_PATH ~ "blocks/menu.tpl"]]
    <div class="banner-left">
        {configs.left_block|raw}
    </div>
</div>

<div class="right-block">

    <div class="cucumbers">
        <a href="/">Главная </a>
        <span>/</span>
        {item.name}
    </div>
    
    <h1>{item.name}</h1>
    
    {item.text|raw}

</div>
[[endblock]]