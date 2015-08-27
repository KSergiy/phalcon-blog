<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">
                <div class="row">
                    <div class="col-lg-4">
                        <h1 class="entry-title">
                            List of all publications
                        </h1>
                    </div>
                    <div class="col-lg-8 text-right">
                        {{ link_to('pages/create/', 'Add new page', 'class': 'btn btn-default') }}
                    </div>
                </div>

                <div>
                    <table class="table table-striped">
                        <thead>
                            <th></th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            {% for page in pages %}
                            <tr>
                                <td> <input type="checkbox"> </td>
                                <td> {{ page.id }} </td>
                                <td> {{ page.name }} </td>
                                <td>
                                    {% for info in page.PublicationsInfo %}
                                        <div>
                                            {{ info.title }} [{{ info.PublicationsLangs.Langs.lang_name }}] - {{ link_to('publications/edit/'~page.id~'/'~info.PublicationsLangs.Langs.id, 'Edit', 'class': 'btn btn-primary btn-xs') }}
                                        </div>
                                    {% endfor %}
                                </td>
                                <td>
                                    {% if ( page.type == '1' ) %}
                                        Static
                                    {% else %}
                                        Catalog
                                    {% endif %}
                                <td>
                                    {% if page.status == '0' %}
                                        {{ link_to('publications/enable/'~page.id, 'Disabled', 'class': 'btn btn-danger btn-sm') }}
                                    {% else %}
                                        {{ link_to('publications/enable/'~page.id, 'Enabled', 'class': 'btn btn-success btn-sm') }}
                                    {% endif %}
                                </td>
                                <td>
                                    {{ link_to('publications/addlocalization/'~page.id, 'Add localization', 'class': 'btn btn-primary btn-sm') }}
                                    {{ link_to('publications/delete/'~page.id, 'Delete', 'class': 'btn btn-danger btn-sm') }}
                                </td>
                            </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>