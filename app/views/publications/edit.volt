<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">
                <h1 class="entry-title">
                    Edit publication <b>[{{ page.name }}]</b>
                </h1>

                {{ form( 'action' : pageForm.getAction() ) }}
                {{ flash.output() }}

                {{ pageForm.render('id', ['value':page.id]) }}

                <div class="form-group">
                    {{ flash.has('title') ? flash.output('title') : '' }}
                    {{ pageForm.label('title') }}
                    {{ pageForm.render('title', ['value':page.title]) }}
                </div>

                <div class="form-group">
                    {{ flash.has('name') ? flash.output('name') : '' }}
                    {{ pageForm.label('name') }}
                    {{ pageForm.render('name', ['value':page.name]) }}
                    <button type="button" onclick="convert2EN('title', 'name')" class="btn btn-default">Generate</button>
                </div>

                <div class="form-group">
                    {{ flash.has('lang') ? flash.output('lang') : '' }}
                    {{ pageForm.label('lang') }}
                    {{ pageForm.render('lang', ['value':page.lang_id]) }}
                </div>

                <div class="form-group">
                    {{ flash.has('location') ? flash.output('location') : '' }}
                    {{ pageForm.label('location') }}
                    {{ pageForm.render('location', ['value':page.location]) }}
                </div>

                <div class="form-group">
                    {{ flash.has('content') ? flash.output('content') : '' }}
                    {{ pageForm.label('content') }}
                    {{ pageForm.render('content', ['value':page.content]) }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaDescription') ? flash.output('metaDescription') : '' }}
                    {{ pageForm.label('metaDescription') }}
                    {{ pageForm.render('metaDescription', ['value':page.meta_description]) }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaKeywords') ? flash.output('metaKeywords') : '' }}
                    {{ pageForm.label('metaKeywords') }}
                    {{ pageForm.render('metaKeywords', ['value':page.meta_keywords]) }}
                </div>

                {{ pageForm.render('save') }}
                </form>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
</div>

{{ javascript_include("js/tinymce/tinymce.min.js") }}