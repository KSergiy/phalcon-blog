<div class="container">
    <div class="row">
        <div class="col-mg-9 col-lg-9">
            {{ content() }}
        </div>
        <div class="col-md-3 col-lg-3">
            {{ partial("layouts/left-block") }}
        </div>
    </div>
    <div class="buffer"></div>
</div>

{{ partial("layouts/footer") }}