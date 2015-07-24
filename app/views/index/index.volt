<div class="col-lg-12 page-content">
    
    <div class="page-header">
        <h2>{{ title }}</h2>
    </div>

    {{ content }}
    
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-header">
            <h3>Примеры работ с использованием наших фрез:</h3>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        {% for image in images %}
            <a href="{{ image.url }}" target="_blank" class="fancybox col-md-2 col-xs-12" rel = "gallery">
                <div class="thumbnail">
                    {{ image('', 'data-original': image.url~'_small.jpg', "alt": 'Photo №'~image.sort~' '~image.title, 'height':'94', 'class': 'img-responsive') }}
                </div>
            </a>
        {% endfor %}
    </div>
   
    
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-header">
            <h3>Подберите фрезу по параметрам:</h3>
        </div>
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
                        
    <div class="col-md-12 col-xs-12">
        <div class="page-header">
            <h3>Наши товары:</h3>
        </div>
    </div>

    <div class="row">
        {% for item in items %}
            <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                <div class="object-item-wrapper col-xs-12">
                    {{ image('', 'data-original': item.img.url~'_middle.jpg', "alt": 'Photo №'~item.img.sort~' '~item.img.title, 'width':'160', 'height':'120', 'class': 'img-responsive') }}
                    <div>
                        {{ item.info.title }} 
                        
                        ({{ item.artikul }})
                    </div>
                    
                    <hr>
                    
                    <div calss="col-xs-12">
                        {% if ( item.url != '' ) %}
                            <a class="btn btn-cart" target="_blank" href="{{ item.url }}" >Купить</a>
                        {% else %}
                            <a class="btn btn-cart" target="_blank" href="http://tdp.com.ua/catalog/frezy-dlja-chpu/" >Купить</a>
                        {% endif %}
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>

</div>