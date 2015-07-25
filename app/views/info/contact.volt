<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li class="active">{{ title }}</li>
</ol>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-content">

    <div class="page-header">
        <h2>{{ title }}</h2>
    </div>

    <div class="col-md-8 col-xs-12">
        {{ content }}
    </div>

    <div class="col-md-4 col-xs-12 pull-right">
        <h3> Связатся с нами </h3>

        {{ form('/contacts/send/', 'role': 'form') }}

            <p><?php $this->flashSession->output() ?></p>
            <fieldset>
                <div class="form-group">
                    {{ form.label('name') }}
                    {{ flash.has('name') ? flash.output('name') : '' }}
                    {{ form.render('name', ['class': 'form-control', 'maxlength': 30, 'required': 'required']) }}
                </div>
                <div class="form-group">
                    {{ form.label('email') }}
                    {{ flash.has('email') ? flash.output('email') : '' }}
                    {{ form.render('email', ['class': 'form-control', 'type': 'email', 'required': 'required']) }}
                </div>
                <div class="form-group">
                    {{ form.label('comments') }}
                    {{ form.render('comments', ['class': 'form-control', 'required': 'required']) }}
                </div>
                <div class="form-group">
                    {{ submit_button('Отправить', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>
</div>