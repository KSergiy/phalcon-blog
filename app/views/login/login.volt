<div class="col-lg-12 page-content">
    <div class="post">
        <div class="entry-container ">
            <div class="entry-content">
                <h1 class="entry-title">
                    Log in
                </h1>

                {{ form('class': 'form-signin', 'action' : loginForm.getAction() ) }}

                    {{ flash.output() }}

                    {{ flash.has('email') ? flash.output('email') : '' }}
                    {{ loginForm.render('email') }}

                    {{ flash.has('password') ? flash.output('password') : '' }}
                    {{ loginForm.render('password') }}

                    {{ loginForm.render('login') }}

                </form>
            </div>
        </div>
    </div>
</div>