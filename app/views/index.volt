<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html ng-app="jinsei" lang="ru" xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="{{ keywords }}" >
        <meta name="description" content="{{ description }}" > 
        <meta name="author" content="SergiCo">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="ru" http-equiv="Content-Language" />
        {{ get_title() }}
        <link rel='canonical' href='{{ url~router.getRewriteUri() }}'/>
        <link rel='shortcut icon' href='/img/favicon.ico' />
        <link rel='icon' href='/img/favicon.ico' />

        {{ javascript_include("https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js") }}
        {{ javascript_include("js/angular/controllers.js") }}

        {{ assets.outputCss('css') }}
    </head>
    <body ng-controller="FrontendController as site">
    <p>{{ "{{site.title.name}}" }}</p>
        {{ partial("layouts/head") }}

        {{ content() }}
        <div>
            <input type="text" ng-model="greeting.text" placeholder="Enter a name here">
            <hr>
            <h1>Hello {{ "{{greeting.text}}" }}!</h1>
        </div>
    </body>
    <!-- Scripts -->


</html>