<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru" xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="{{ keywords }}" >
        <meta name="description" content="{{ description }}" > 
        <meta name="author" content="SergiCo">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"></meta>
        <meta content="ru" http-equiv="Content-Language"></meta>
        {{ get_title() }}
        <link rel='canonical' href='{{ url~router.getRewriteUri() }}'/>
        <link rel='shortcut icon' href='/img/favicon.ico' />
        <link rel='icon' href='/img/favicon.ico' />
        {{ assets.outputCss('css') }}
    </head>
    <body>
        <div class="container">
            {{ content() }}
            <footer class='col-lg-12 col-xs-12 text-center footer'>
                <div class="footer-block">
                    <div class="col-lg-4 col-xs-12 footer-block-copyright">
                        <p>© 2013 3DFreza. Все права защищены.</p>
                    </div>
                    <div class="col-lg-8 hidden-xs hidden-sm">
                        {{ elements.getFooterMenu() }}
                    </div>
                </div>
            </footer>
        </div>
        {{ assets.outputJs('js') }}
    </body>
    <!-- Scripts -->
</html>