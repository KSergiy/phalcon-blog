<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li class="active"><?php echo $title; ?></li>
</ol>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-content">

    <div class="page-header">
        <h2><?php echo $title; ?></h2>
    </div>

    <div class="col-md-8 col-xs-12">
        <?php echo $content; ?>
    </div>

    <div class="col-md-4 col-xs-12 pull-right">
        <h3> Связатся с нами </h3>

        <?php echo $this->tag->form(array('/contacts/send/', 'role' => 'form')); ?>

            <p><?php $this->flashSession->output() ?></p>
            <fieldset>
                <div class="form-group">
                    <?php echo $form->label('name'); ?>
                    <?php echo ($this->flash->has('name') ? $this->flash->output('name') : ''); ?>
                    <?php echo $form->render('name', array('class' => 'form-control', 'maxlength' => 30, 'required' => 'required')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label('email'); ?>
                    <?php echo ($this->flash->has('email') ? $this->flash->output('email') : ''); ?>
                    <?php echo $form->render('email', array('class' => 'form-control', 'type' => 'email', 'required' => 'required')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label('comments'); ?>
                    <?php echo $form->render('comments', array('class' => 'form-control', 'required' => 'required')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->tag->submitButton(array('Отправить', 'class' => 'btn btn-primary btn-large')); ?>
                </div>
            </fieldset>
        </form>
    </div>
</div>