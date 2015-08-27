<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">

                {{ form( 'action' : pageForm.getAction() ) }}

                <div class="col-lg-12">
                    <div class="col-lg-6 entry-title">
                        Edit page <b>[{{ page.name }}]</b>
                    </div>
                    <div class="col-lg-6 text-right">
                        {{ link_to("pages/list/", "Back", 'class': 'btn btn-sm') }}
                        {{ pageForm.render('save') }}
                    </div>
                </div>

                {{ flash.output() }}

                {{ pageForm.render('id', ['value':page.id]) }}

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a>
                    </li>
                    <li role="presentation">
                        <a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="info">

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
                            {{ flash.has('type') ? flash.output('type') : '' }}
                            {{ pageForm.label('type') }}
                            {{ pageForm.render('type', ['value':page.type]) }}
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

                    </div>

                    <div role="tabpanel" class="tab-pane" id="photos">

                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Select files...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" data-url="/images/pages/upload/" name="files[]" multiple>
                        </span>

                        <div class="progress" id="progress"></div>

                    </div>

                </div>

                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>