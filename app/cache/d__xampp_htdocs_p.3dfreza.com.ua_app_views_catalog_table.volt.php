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
                                <div class="thumbnail">
                                    <?php echo $this->tag->image(array('', 'data-original' => $image->url, 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'width' => '60', 'height' => '60', 'class' => 'img-responsive')); ?>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo $image->url; ?>" rel="fancybox<?php echo $item->id; ?>" target="_blank" class="fancybox hidden col-md-1 col-xs-1">
                                <div class="thumbnail">
                                    <?php echo $this->tag->image(array('', 'data-original' => $image->url, 'alt' => 'Photo №' . $image->sort . ' ' . $image->title, 'width' => '60', 'height' => '60', 'class' => 'img-responsive')); ?>
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
                <td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>