<div class="col-lg-12 page-content">
    
    <div class="page-header">
        <h2><?php echo $title; ?></h2>
    </div>

    <?php echo $content; ?>
    
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-header">
            <h3>Примеры работ с использованием наших фрез:</h3>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php foreach ($images as $image) { ?>
            <a href="<?php echo $image->url; ?>" target="_blank" class="fancybox col-md-2 col-xs-12" rel = "gallery">
                <div class="thumbnail">
                    <?php echo $this->tag->image(array('', 'data-original' => $image->url . '_small.jpg', 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'height' => '94', 'class' => 'img-responsive')); ?>
                </div>
            </a>
        <?php } ?>
    </div>
   
    
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-header">
            <h3>Подберите фрезу по параметрам:</h3>
        </div>
    </div>
        
    <div class="col-md-12">
        <div class="col-md-3 hidden-xs hidden-sm">
            <div class="thumbnail">
                <?php echo $this->tag->image(array('img/girl.jpg_small.jpg', 'width' => '150', 'height' => '190', 'class' => 'img-responsive')); ?>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-md-9">
            <form method="GET" action="/filter/main.html">
                
                <?php foreach ($options as $option) { ?>
                    <?php if ($option->option_type == 'int') { ?>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                            <label class="col-xs-12 col-md-12 control-label"><?php echo $option->option_title; ?> (<?php echo $option->option_dimensions; ?>):</label>

                            <select name="<?php echo $option->option_id; ?>" class="form-control" >
                                <option value="" >Все</option>
                                <?php foreach ($option->getOptionsVals() as $value) { ?>
                                    <option value='<?php echo $value->value; ?>' ><?php echo $value->value; ?></option>
                                <?php } ?>
                            </select> 
                        </div>
                    <?php } else { ?>
                        <hr class="col-lg-12 col-xs-12">
                        <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                            <label class="col-xs-12 col-md-12 control-label"><?php echo $option->option_title; ?>:</label>
                            
                            <select name="<?php echo $option->option_id; ?>" class="form-control">
                                <option value="" >Все</option>
                                <option value="Спиральная" >Спиральная</option>
                                <option value="Прямозубая" >Прямозубая</option>
                            </select>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <div class="form-group col-md-6 col-sm-12 col-xs-12 pull-right">
                    <label class="col-xs-12 col-md-12 control-label">Категория:</label>

                    <select name="catalog" class="form-control" >
                        <option value="" >Все</option>
                        <?php foreach ($catalog as $item) { ?>
                            <option value='<?php echo $item->id; ?>' ><?php echo $item->PagesInfo->title; ?></option>
                        <?php } ?>
                    </select>
                </div>
                        
                <hr class="col-lg-12 col-xs-12">
                
                <div class="form-group col-md-6 pull-right">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <button type="submit" class="btn btn-default col-sm-10 input-group pull-right">Подобрать</button>
                </div>
                
            </form>
        </div>
    </div>
                        
    <div class="col-md-12 col-xs-12">
        <div class="page-header">
            <h3>Наши товары:</h3>
        </div>
    </div>

    <div class="row">
        <?php foreach ($items as $item) { ?>
            <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                <div class="object-item-wrapper col-xs-12">
                    <?php echo $this->tag->image(array('', 'data-original' => $item->img->url, 'alt' => 'Photo №' . $item->img->sort . ' ' . $item->img->title, 'width' => '160', 'height' => '120', 'class' => 'img-responsive')); ?>
                    <div>
                        <?php echo $item->info->title; ?> 
                        
                        (<?php echo $item->artikul; ?>)
                    </div>
                    
                    <hr>
                    
                    <div calss="col-xs-12">
                        <?php if (($item->url != '')) { ?>
                            <a class="btn btn-cart" target="_blank" href="<?php echo $item->url; ?>" >Купить</a>
                        <?php } else { ?>
                            <a class="btn btn-cart" target="_blank" href="http://tdp.com.ua/catalog/frezy-dlja-chpu/" >Купить</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>