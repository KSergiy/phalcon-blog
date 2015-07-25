<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li class="active">Фильтр</li>
</ol>

<div class="col-lg-12 page-content">

    <div class="page-header">
        <h2>Фильтр</h2>
    </div>
    
    <div class="col-md-12">
        <div class="col-md-3 hidden-xs hidden-sm">
            <div class="thumbnail">
                {{ image('img/girl.jpg_small.jpg', 'width': '150', 'height':'190', 'class': 'img-responsive') }}
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-md-9">
            <form method="GET" action="/filter/main.html">
                
                {% for option in options %}
                    {% if option.option_type == 'int' %}
                        <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                            <label class="col-xs-12 col-md-12 control-label">{{ option.option_title }} ({{ option.option_dimensions }}):</label>

                            <select name="{{ option.option_id }}" class="form-control" >
                                <option value="" >Все</option>
                                {% for value in option.getOptionsVals() %}
                                    <option value='{{ value.value }}' >{{ value.value }}</option>
                                {% endfor %}
                            </select> 
                        </div>
                    {% else %}
                        <hr class="col-lg-12 col-xs-12">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                            <label class="col-xs-12 col-md-12 control-label">{{ option.option_title }}:</label>
                            
                            <select name="{{ option.option_id }}" class="form-control">
                                <option value="" >Все</option>
                                <option value="Спиральная" >Спиральная</option>
                                <option value="Прямозубая" >Прямозубая</option>
                            </select>
                        </div>
                    {% endif %}
                {% endfor %}
                
                <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                    <label class="col-xs-12 col-md-12 control-label">Категория:</label>

                    <select name="catalog" class="form-control" >
                        <option value="" >Все</option>
                        {% for item in catalog %}
                            <option value='{{ item.id }}' >{{ item.PagesInfo.title }}</option>
                        {% endfor %}
                    </select>
                </div>
                        
                <hr class="col-lg-12 col-xs-12">
                
                <div class="form-group col-md-6 pull-right">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <button type="submit" class="btn btn-default col-sm-10 input-group pull-right">Подобрать</button>
                </div>
                
            </form>
        </div>
    </div>
    
    
    <div class="row">

        <div class="col-md-12">
            <div class="page-header">
                <h3>Результат фильтра:</h3>
            </div>
        </div>

        <div class="col-md-9 col-md-push-3 table-responsive">
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th class="no-sort">Фото</th>
                        <th>Артикул</th>
                        {% for option in options %}
                            <th>{{ option.option_short }}</th>
                        {% endfor %}
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody id='tbody'>
                    {% for item in items %}
                        <tr>
                            <td>
                                {% for key, image in item.images %}
                                    {% if key == 0 %}
                                        <a href="{{ image.url }}" rel="fancybox{{ item.id }}" target="_blank" class="fancybox col-md-1 col-xs-1">
                                            <div class="">
                                                {{ image('', 'data-original': image.url, "alt": 'Photo №'~image.sort~' '~image.title, 'width':'60', 'height':'60', 'class': 'img-responsive') }}
                                            </div>
                                        </a>
                                    {% else %}
                                        <a href="{{ image.url }}" rel="fancybox{{ item.id }}" target="_blank" class="fancybox hidden col-md-1 col-xs-1">
                                            <div class="">
                                                {{ image('', 'data-original': image.url, "alt": 'Photo №'~image.sort~' '~image.title, 'width':'60', 'height':'60', 'class': 'img-responsive') }}
                                            </div>
                                        </a>
                                    {% endif %}
                                {% endfor %}
                            </td>
                            
                            <td>{{ item.artikul }}</td>
                            {% for option in options %}
                                {% for val in item.options %}
                                    {% if ( val.option_id == option.option_id ) %}
                                        <td>{{ val.value }}</td>
                                        {% break %}
                                    {% endif %}
                                {% endfor %}
                            {% endfor %}
                            <td>
                                {% if ( item.url != '' ) %}
                                    <a class="btn btn-cart" target="_blank" href="{{ item.url }}" >Купить</a>
                                {% else %}
                                    <a class="btn btn-cart" target="_blank" href="http://tdp.com.ua/catalog/frezy-dlja-chpu/" >Купить</a>
                                {% endif %}
                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
                
        <div class="col-md-3 col-md-pull-9">
            
            <div class="title">
                Фильтры:
            </div>
            
            <form id="filterForm" name="filterForm" method="POST">
            
                {% for option in options %}
                    <div class="col-md-12">
                        <label class="control-label">{{ option.option_title }}:</label>
                    </div>

                    {% if option.option_type == 'int' %}
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">от</div>
                                <input type="text" class="vals-min form-control" data-pos="{{ option.option_sort }}" data-id="{{ option.option_id }}" id="min_{{ option.option_id }}" value="{{ min[option.option_id] }}">
                                <div class="input-group-addon">до</div>
                                <input type="text" class="vals-max form-control" data-pos="{{ option.option_sort }}" data-id="{{ option.option_id }}" id="max_{{ option.option_id }}" value="{{ max[option.option_id] }}">
                            </div>
                            
                            <input class="slider" type="text" id="slider-{{ option.option_id }}" name="{{ option.option_id }}" data-pos="{{ option.option_sort }}" data-id="{{ option.option_id }}" data-slider-min="{{ min[option.option_id] }}" data-slider-max="{{ max[option.option_id] }}" data-slider-value="[{{ min[option.option_id] }},{{ max[option.option_id] }}]"  value="{{ min[option.option_id] }},{{ max[option.option_id]}}"/>
                        </div>
                    {% else %}
                        <div class="col-sm-12">
                            <select name="{{ option.option_id }}" data-id="{{ option.option_id }}" class="form-control select">
                                <option value="" >Все</option>
                                {% for value in option.getOptionsVals() %}
                                    <option value='{{ value.value }}' >{{ value.value }}</option>
                                {% endfor %}
                            </select>
                        </div>
                    {% endif %}
                {% endfor %}

                <input type="hidden" name="page_id" value="{{ page.id }}" id="id" />
            
            </form>
            
        </div>
      
    </div>

</div>