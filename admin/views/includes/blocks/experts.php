<section class="reports text-justify">
	<div class="container">

    	<div class="row col-margin-top text-center">
            <a href="?view=admin&block=add-expert" class="btn btn-primary add-compitation"><i class="glyphicon glyphicon-plus"></i>Добавить нового эксперта</a>
        </div>

        <?php if ( !empty( $experts ) ) : ?>

            <div class="row">

                <?php foreach ($experts as $expert): ?>

                    <div class="col-md-6 report col-margin-top">
                        <div class="card">
                            <img class="img-circle expert-photo" src="/<?= $expert->path_photo; ?>" alt="Marina">
                            <div class="clearfix"></div>
                            <p class="expert-name"><span>ФИО: </span><?= "$expert->surname $expert->name $expert->otchestvo"; ?>
                            <p class="expert-status"><span>Статус: </span><?= $expert->status; ?></p>
                            <p class="expert-compit"><span>Компитенция: </span><?= get_compitation_of_expert( $expert->compitation_id )->title; ?></p>
                            <div class="expert-delete"><a href="?view=admin&block=experts&action=delete_expert&expert_id=<?= $expert->id; ?>"><i class="glyphicon glyphicon-remove"></i>Удалить</a></div>
                            <div class="expert-change"><a href="?view=admin&block=change-expert&expert_id=<?= $expert->id; ?>"><i class="glyphicon glyphicon-pencil"></i>Изменить</a></div>
                        </div>
                    </div>
                    
                <?php endforeach ?>

            </div>

        <?php else: ?>

            <div class="row col-margin-top text-center">
                <p>Здесь нет ещё ни одного эксперта</p>
            </div>

        <?php endif ?>

        <!-- <div class="row">
        	<div class="col-md-6 report col-margin-top">
            	<div class="card">
                	<img class="img-circle expert-photo" src="<?= '../' . TEMPLATE; ?>img/Директор2.jpg" alt="Marina">
                    <div class="clearfix"></div>
                    <p class="expert-name"><span>ФИО: </span> Хабипов Ирек Ибрагимович
                    <p class="expert-status"><span>Статус: </span> Эксперт</p>
                    <p class="expert-compit"><span>Компитенция: </span> Полимеханика</p>
                </div>
            </div>
       	  <div class="col-md-6 report col-margin-top">
       		<div class="card">
                <img class="img-circle" src="<?= '../' . TEMPLATE; ?>img/NoPhoto.jpg" alt="Olga">
                <div class="clearfix"></div>
                <p class="expert-name"><span>ФИО: </span> Чистекова Ольга Александровна
                <p class="expert-status"><span>Статус: </span> Эксперт</p>
                <p class="expert-compit"><span>Компитенция: </span> Инженерный дизайн</p>
           	</div>
          </div>
       	  <div class="col-md-6 report col-margin-top">
       		<div class="card">
                    <img class="img-circle" src="<?= '../' . TEMPLATE; ?>img/NoPhoto.jpg" alt="Alexei">
                    <div class="clearfix"></div>
                    <p class="expert-name"><span>ФИО: </span> Чернуха Алексей николаевич
                    <p class="expert-status"><span>Статус: </span> Эксперт</p>
                    <p class="expert-compit"><span>Компитенция: </span> Инженерный дизайн</p>
                </div>
            </div>
        	<div class="col-md-6 report col-margin-top">
            	<div class="card">
                    <img class="img-circle" src="<?= '../' . TEMPLATE; ?>img/NoPhoto.jpg" alt="Marina">
                    <div class="clearfix"></div>
                    <p class="expert-name"><span>ФИО: </span> Шаевич Мария Александровна
                    <p class="expert-status"><span>Статус: </span> Эксперт</p>
                    <p class="expert-compit"><span>Компитенция: </span> Инженерный дизайн</p>
                </div>
            </div>
        </div> -->
    </div>
</section>