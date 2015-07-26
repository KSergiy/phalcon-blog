<div class="row">
    <div class="sidebar">
        <div class="sidebar-inner">
            <div class="widget widget_search searchform">
                <form>
                    <div>
                        <input type="text" name="q" size="15" placeholder="Enter Keywords" value="">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </form>
            </div>

            <div class="widget widget_search">
                {{ form('login/login.html') }}
                    <div>
                        {{ text_field('email') }}

                        {{ password_field('password') }}

                        {{ submit_button('Login') }}
                    </div>
                </form>
            </div>

            <div class="widget widget_label searchform">
                <h2>
                    <span>
                        Labels
                    </span>
                </h2>
                <div class="widge-content label-list">
                    <ul>
                        <li><a href="">Programming</a></li>
                        <li><a href="">Languages</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>