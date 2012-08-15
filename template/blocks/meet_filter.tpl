<div class="midbackground">
    <div class="midbackbot">
        <div class="midbackmid townback">
            <h3>Поиск событий города</h3>
            <form action="" method="get" id="search">
                <input type="hidden" name="filter[action]" value="search" />
                <input type="hidden" name="filter[check]" value="true" />
                <div class="inputtext">
                    <input name="filter[search_string]" value="{search_string}" />
                    [[if categories]]
                    <select name="filter[event_category]" onchange="">
                        <option value="">Выберите категорию</option>
                        [[for item in categories]]
                        <option value="{item.id}" [[if item.id == event_category]]selected="selected"[[endif]]>{item.name}</option>
                        [[endfor]]
                    </select>
                    [[endif]]
                    
                    [[if date]]
                    <input name="filter[event_date]" value="{date}" id="datepicker" />
                    [[else]]
                    <div id="select_date" style="display:inline;">
                    <select name="filter[event_date]" onchange="">
                        <option value="">Выберите дату</option>
                        <option value="today" [[if event_date == "today"]]selected="selected"[[endif]]>Сегодня</option>
                        <option value="yersterday" [[if event_date == "yersterday"]]selected="selected"[[endif]]>Вчера</option>
                        <option value="week" [[if event_date == "week"]]selected="selected"[[endif]]>Неделя</option>
                        <option value="month" [[if event_date == "month"]]selected="selected"[[endif]]>Месяц</option>
                    </select>
                    </div>
                    [[endif]]
                    <a href="#" class="search" onclick="setSearch(); return false;">Найти</a>
                    <br/>
                    <a href="#" class="selectbydate" onclick="getDate(this);return false;">Выбрать по числу</a>
                </div>                        
            </form>
        </div>
    </div>
</div>