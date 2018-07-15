<section class="objects text-justify">
    <div class="container">
        <div class="row col-margin-top text-center">
            <a href="?view=admin&block=add-compitation" class="btn btn-primary add-compitation"><i class="glyphicon glyphicon-plus"></i>Добавить новую компетенцию</a>
        </div>

        <?php if ( !empty( $list_compitations ) ) : ?>

            <?php foreach ( $list_compitations as $compitation ) : ?>

                <div class="row">

                    <div class="col-md-12">

                        <div class="card-object row">
                            <div class="compitation-photo col-md-5">
                                <a href="?view=admin&block=change-compitation&compitation_id=<?= $compitation->id; ?>">
                                    <img class="img-thumbnail" src="/<?= $compitation->path; ?>" alt="object-1" width="40%">
                                </a>
                            </div>
                            <div class="compitation-description col-md-7">
                                <a href="?view=admin&block=change-compitation&compitation_id=<?= $compitation->id; ?>">
                                    <h3><?= $compitation->title; ?></h3>
                                </a>
                                <p>
                                    <?= $compitation->short_description; ?>
                                </p>
                                <div class="container-btn compit">
                                    <a href="?view=admin&block=change-compitation&compitation_id=<?= $compitation->id; ?>"
                                       class="btn btn-primary btn-compit">Изменить</a>
                                </div>
                            </div>
                            <div class="delete-compitation">
                                <a href="?view=admin&block=compitation&action=delete-compitation&compitation_id=<?= $compitation->id; ?>">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="row col-margin-top text-center">
                <p>Здесь нет ещё ни одной компетенции</p>
            </div>

        <?php endif; ?>
    </div>
</section> <!-- /. objects -->