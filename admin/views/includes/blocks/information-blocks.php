<section class="objects text-justify">
    <div class="container">
        <div class="row col-margin-top text-center">
            <a href="?view=admin&block=add-information-block" class="btn btn-primary add-compitation"><i class="glyphicon glyphicon-plus"></i>Добавить новый блок</a>
        </div>

        <?php $i = 0;  ?>
        
        <?php if ( !empty( $information_blocks ) ) : ?>

            <section class="discription">
                <?php foreach ( $information_blocks as $block ) : ?>
                    <?php $i++; ?>

                    <?php if ($i % 2 > 0): ?>

                        <div class="row col-margin-top text-justify">
                            <div class="col-md-6">
                                <h2 id="#"><?= $block->title; ?></h2>

                                <div class="block-delete">
                                    <a href="?view=admin&block=information-block&action=delete-block&block_id=<?= $block->id; ?>"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>

                                <p>
                                    <?= $block->short_description; ?>
                                </p>
                                <div class="container-btn compit">
                                    <a href="?view=admin&block=change-information-block&block_id=<?= $block->id; ?>"
                                       class="btn btn-primary btn-compit">Изменить</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-margin-top">
                                <img src="/<?= $block->path; ?>" alt="<?= $block->title; ?>" class="center-block discription-photo">
                            </div>
                        </div> <!-- /. row /. row-margin-top /. text-justify -->

                    <?php else: ?>

                        <div class="row col-margin-top text-justify">
                            <div class="col-md-6 col-margin-top">
                                <img src="/<?= $block->path; ?>" alt="<?= $block->title; ?>" class="center-block discription-photo">
                            </div>
                            <div class="col-md-6">
                                <h2 id="#"><?= $block->title; ?></h2>

                                <div class="block-delete">
                                    <a href="?view=admin&block=information-block&action=delete-block&block_id=<?= $block->id; ?>"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>

                                <p>
                                    <?= $block->short_description; ?>
                                </p>
                                <div class="container-btn compit">
                                    <a href="?view=admin&block=change-information-block&block_id=<?= $block->id; ?>"
                                       class="btn btn-primary btn-compit">Изменить</a>
                                </div>
                            </div>
                        </div> <!-- /. row /. row-margin-top /. text-justify -->
                        
                    <?php endif ?>

                <?php endforeach; ?>
            </section> <!-- /. discription -->

        <?php else : ?>

            <div class="row col-margin-top text-center">
                <p>Здесь нет ещё ни одного информационного блока</p>
            </div>

        <?php endif; ?>

    </div>
</section> <!-- /. objects -->