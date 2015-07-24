<head>
    <div class="header-block">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-2 col-xs-12 header-block-logo hidden-xs" >
                    <a href="/">
                        <?php echo $this->tag->image(array('img/header/logo.png', 'alt' => '3Dfreza', 'width' => '200', 'height' => '120', 'class' => 'logo')); ?>  
                    </a>
                </div>

                <div class="col-lg-4 col-xs-12 header-block-slogan hidden-xs" >
                    <p>
                        Производитель фрез по дереву и металлу для ЧПУ станков. <br />
                    </p>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pull-right" >
                    
                    <ul class="header-top-menu nav navbar-nav hidden-xs">
                        <li>
                            <a href="/shipment-payment/">Доставка и оплата</a>
                        </li>
                        <li>
                            <a href="/contacts/">Контакты</a>
                        </li>
                    </ul>

                    <div class="col-md-12 col-xs-12 header-phone">
                        <p>
                            (063) 940-40-30, &nbsp; (097) 940-40-30
                        </p>
                    </div>
                    
                    <div class="clearfix visible-xs-block col-xs-12"></div>
                    
                    <div class="col-md-12 col-xs-12">
                        <div class="header-search">
                            <form method="GET" id="searchform" class="navbar-form col-md-12 form-search input-group" action="/search/search">
                                <input type="text" class="form-control search-query" id="s" name="q" placeholder="Введите артикул фрезы...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-search">Поиск</button>
                                </span>
                            </form>
                        </div>
                    </div>
                    
                    <div class="clearfix visible-xs-block col-xs-12"></div>
                    
                </div>
            </div>
        </div>    
                
        <nav class="navbar navbar-default col-lg-12" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="true" data-target="#bs-navbar">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-lg hidden-md" href="/">3Dfreza</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-navbar">
                <?php echo $this->elements->getMenu(); ?>
            </div>
        </nav>
        
    </div>
                             
</head>