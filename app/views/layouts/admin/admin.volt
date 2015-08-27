<div class="admin-head">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
                <ul class="nav navbar-nav">
                    {{ elements.getAdminMenu() }}
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li>{{ link_to('login/logout/', 'Logout', 'class': 'btn btn-danger btn-sm') }}</li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-mg-12 col-lg-12">
            {{ content() }}
        </div>
    </div>
    <div class="buffer"></div>
</div>

{{ partial("layouts/admin/footer") }}