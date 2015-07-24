<div class="col-lg-12 page-content">
    
    <div class="page-header">
        <h2>Результаты поиска</h2>
    </div>

    <div class="col-md-12">
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
                        <td></td>
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
    </div>
    
</div>