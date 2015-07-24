<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li class="active"><?php echo $title; ?></li>
</ol>

<div class="col-lg-12 page-content">

    <div class="page-header">
        <h2><?php echo $title; ?></h2>
    </div>
    
    <?php echo $content; ?>
    
    <div class="row">
        <div class="col-lg-12 text-center"> 
        <?php foreach ($images as $image) { ?>
            <div class=" col-md-6">
                <a href="<?php echo $image->url; ?>" target="_blank">
                    <div class="thumbnail">
                        <?php echo $this->tag->image(array('', 'data-original' => $image->url . '_small.jpg', 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'height' => '180', 'class' => 'img-responsive')); ?>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
    
    
    <div class="row">

        <div class="col-md-12">
            <div class="page-header">
                <h3>Список фрез:</h3>
            </div>
        </div>

        <div class="col-md-9 col-md-push-3 table-responsive">
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th class="no-sort">Фото</th>
                        <th>Артикул</th>
                        <?php foreach ($options as $option) { ?>
                            <th><?php echo $option->option_short; ?></th>
                        <?php } ?>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody id='tbody'>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td>
                                <?php foreach ($item->images as $key => $image) { ?>
                                    <?php if ($key == 0) { ?>
                                        <a href="<?php echo $image->url; ?>" rel="fancybox<?php echo $item->id; ?>" target="_blank" class="fancybox col-md-1 col-xs-1">
                                            <div class="">
                                                <?php echo $this->tag->image(array('', 'data-original' => $image->url . '_small.jpg', 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'width' => '60', 'height' => '60', 'class' => 'img-responsive')); ?>
                                            </div>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo $image->url; ?>" rel="fancybox<?php echo $item->id; ?>" target="_blank" class="fancybox hidden col-md-1 col-xs-1">
                                            <div class="">
                                                <?php echo $this->tag->image(array('', 'data-original' => $image->url . '_small.jpg', 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'width' => '60', 'height' => '60', 'class' => 'img-responsive')); ?>
                                            </div>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            
                            <td><?php echo $item->artikul; ?></td>
                            <?php foreach ($options as $option) { ?>
                                <?php foreach ($item->options as $val) { ?>
                                    <?php if (($val->option_id == $option->option_id)) { ?>
                                        <td><?php echo $val->value; ?></td>
                                        <?php break; ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <td>
                                <?php if (($item->url != '')) { ?>
                                    <a class="btn btn-cart" target="_blank" href="<?php echo $item->url; ?>" >Купить</a>
                                <?php } else { ?>
                                    <a class="btn btn-cart" target="_blank" href="http://tdp.com.ua/catalog/frezy-dlja-chpu/" >Купить</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
                
        <div class="col-md-3 col-md-pull-9">
            
            <div class="title">
                Фильтры:
            </div>
            
            <form id="filterForm" name="filterForm" method="POST">
            
                <?php foreach ($options as $option) { ?>
                    <div class="col-md-12">
                        <label class="control-label"><?php echo $option->option_title; ?>:</label>
                    </div>

                    <?php if ($option->option_type == 'int') { ?>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">от</div>
                                <input type="text" class="vals-min form-control" data-pos="<?php echo $option->option_sort; ?>" data-id="<?php echo $option->option_id; ?>" id="min_<?php echo $option->option_id; ?>" value="<?php echo $min[$option->option_id]; ?>">
                                <div class="input-group-addon">до</div>
                                <input type="text" class="vals-max form-control" data-pos="<?php echo $option->option_sort; ?>" data-id="<?php echo $option->option_id; ?>" id="max_<?php echo $option->option_id; ?>" value="<?php echo $max[$option->option_id]; ?>">
                            </div>
                            
                            <input class="slider" type="text" id="slider-<?php echo $option->option_id; ?>" name="<?php echo $option->option_id; ?>" data-pos="<?php echo $option->option_sort; ?>" data-id="<?php echo $option->option_id; ?>" data-slider-min="<?php echo $min[$option->option_id]; ?>" data-slider-max="<?php echo $max[$option->option_id]; ?>" data-slider-value="[<?php echo $min[$option->option_id]; ?>,<?php echo $max[$option->option_id]; ?>]"  value="<?php echo $min[$option->option_id]; ?>,<?php echo $max[$option->option_id]; ?>"/>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <select name="<?php echo $option->option_id; ?>" data-id="<?php echo $option->option_id; ?>" class="form-control select">
                                <option value="" >Все</option>
                                <?php foreach ($option->getOptionsVals() as $value) { ?>
                                    <option value='<?php echo $value->value; ?>' ><?php echo $value->value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                <?php } ?>

                <input type="hidden" name="page_id" value="<?php echo $page->id; ?>" id="id" />
            
            </form>
            
        </div>
      
    </div>

</div>