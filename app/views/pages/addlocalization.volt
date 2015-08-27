<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">
                <h1 class="entry-title">
                    Add new localization for a page
                </h1>

                {{ form( 'action' : pageForm.getAction() ) }}
                {{ flash.output() }}

                {{ pageForm.render('page_id', ['value' : id]) }}

                <div class="form-group">
                    {{ flash.has('title') ? flash.output('title') : '' }}
                    {{ pageForm.label('title') }}
                    {{ pageForm.render('title') }}
                </div>

                <div class="form-group">
                    {{ flash.has('lang') ? flash.output('lang') : '' }}
                    {{ pageForm.label('lang') }}
                    {{ pageForm.render('lang') }}
                </div>

                <div class="form-group">
                    {{ flash.has('content') ? flash.output('content') : '' }}
                    {{ pageForm.label('content') }}
                    {{ pageForm.render('content') }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaDescription') ? flash.output('metaDescription') : '' }}
                    {{ pageForm.label('metaDescription') }}
                    {{ pageForm.render('metaDescription') }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaKeywords') ? flash.output('metaKeywords') : '' }}
                    {{ pageForm.label('metaKeywords') }}
                    {{ pageForm.render('metaKeywords') }}
                </div>

                {{ pageForm.render('add') }}
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

{{ javascript_include("js/tinymce/tinymce.min.js") }}