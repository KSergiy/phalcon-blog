<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li class="active">Пиоск</li>
</ol>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-content">
    
    <div class="page-header">
        <h2>Результаты поиска</h2>
    </div>

    <div class="col-md-12">
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
                                        <div class="thumbnail">
                                            {{ image('', 'data-original': image.url, "alt": 'Photo №'~image.sort~' '~image.title, 'width':'60', 'height':'60', 'class': 'img-responsive') }}
                                        </div>
                                    </a>
                                {% else %}
                                    <a href="{{ image.url }}" rel="fancybox{{ item.id }}" target="_blank" class="fancybox hidden col-md-1 col-xs-1">
                                        <div class="thumbnail">
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
    
</div>