<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">
                <h1 class="entry-title">
                    Create new page
                </h1>

                {{ form( 'action' : createForm.getAction() ) }}
                {{ flash.output() }}

                <div class="form-group">
                    {{ flash.has('title') ? flash.output('title') : '' }}
                    {{ createForm.label('title') }}
                    {{ createForm.render('title') }}
                </div>

                <div class="form-group">
                    {{ flash.has('name') ? flash.output('name') : '' }}
                    {{ createForm.label('name') }}
                    {{ createForm.render('name') }}
                </div>

                <div class="form-group">
                    {{ flash.has('type') ? flash.output('type') : '' }}
                    {{ createForm.label('type') }}
                    {{ createForm.render('type') }}
                </div>

                <div class="form-group">
                    {{ flash.has('lang') ? flash.output('lang') : '' }}
                    {{ createForm.label('lang') }}
                    {{ createForm.render('lang') }}
                </div>

                <div class="form-group">
                    {{ flash.has('location') ? flash.output('location') : '' }}
                    {{ createForm.label('location') }}
                    {{ createForm.render('location') }}
                </div>

                <div class="form-group">
                    {{ flash.has('content') ? flash.output('content') : '' }}
                    {{ createForm.label('content') }}
                    {{ createForm.render('content') }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaDescription') ? flash.output('metaDescription') : '' }}
                    {{ createForm.label('metaDescription') }}
                    {{ createForm.render('metaDescription') }}
                </div>

                <div class="form-group">
                    {{ flash.has('metaKeywords') ? flash.output('metaKeywords') : '' }}
                    {{ createForm.label('metaKeywords') }}
                    {{ createForm.render('metaKeywords') }}
                </div>

                {{ createForm.render('create') }}
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

{{ javascript_include("js/tinymce/tinymce.min.js") }}