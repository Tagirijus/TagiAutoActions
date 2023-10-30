<div class="page-header">
    <h2><?= t('TagiAutoActions configuration') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('TagiAutoActionsController', 'saveConfig', ['plugin' => 'TagiAutoActions']) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <br>

    <p>
        <h3><?= t('Priority colors') ?></h3>
    </p>

    <p>
        <?= t('Here you can set the color names for each priority level from 0 to 3. Possible colors are: yellow, blue, green, purple, red, orange, grey, brown, deep_orange, dark_grey, pink, teal, cyan, lime, light_green, amber.') ?>
    </p>
    <div class="task-form-container">

        <div class="task-form-main-column">
            <?= $this->form->label(t('Priority') . ' 0', 'priority_0_color') ?>
            <?= $this->form->text('priority_0_color', ['priority_0_color' => $priority_0_color]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label(t('Priority') . ' 1', 'priority_1_color') ?>
            <?= $this->form->text('priority_1_color', ['priority_1_color' => $priority_1_color]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label(t('Priority') . ' 2', 'priority_2_color') ?>
            <?= $this->form->text('priority_2_color', ['priority_2_color' => $priority_2_color]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label(t('Priority') . ' 3', 'priority_3_color') ?>
            <?= $this->form->text('priority_3_color', ['priority_3_color' => $priority_3_color]) ?>
        </div>

    </div>



    <div class="task-form-bottom">
        <?= $this->modal->submitButtons() ?>
    </div>

</form>
