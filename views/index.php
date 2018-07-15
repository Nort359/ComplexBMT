<?php

    require_once 'controllers/controller.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>БМТ — специализированный центр компетенций</title>

        <!-- Bootstrap -->
        <?php print_styles(); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <!-- Форма регистрации -->
        <!--<div class="modal-container">
            <div class="modal-wrap">
                <div class="modal-header">
                    <span class="is-active"></span>
                    <span></span>
                    <span></span>
                    <i class="glyphicon glyphicon-remove"></i>
                </div>
                <div class="modal-bodies">
                    <div class="modal-body modal-body-step-1">
                        <div class="title">Регистрация<br>Шаг 1</div>
                        <div class="description">Здравствуйте, пожалуйста, введите необходимые данные данные:</div>
                        <form action="" method="POST">
                            <input type="email" placeholder="Ваш Email..." id="user_register_email" name="user_register_email" />
                            <input type="text" placeholder="Придумайте Login" id="user_register_login" name="user_register_login" />
                            <input type="password" placeholder="Придумайте пароль..." id="user_register_password" name="user_register_password" />
                            <input type="password" placeholder="Повторите пароль..." id="user_register_password_again" />
                            <!
                            <label>
                                <input type="checkbox" name="radio" /> Запомнить меня
                            </label>
                            >
                            <div class="text-center fade-in">
                                <button type="button" class="button first-next-btn" id="get_important_data" name="get_important_data">Далее</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body modal-body-step-2">
                        <div class="title">Шаг 2</div>
                        <div class="description">Следующие поля необязательны для заполнения, но они могут понадобиться Вам при записи на конкурс</div>
                        <form action="" method="POST">
                            <input type="text" placeholder="Ваша фамилия..." name="user_register_surname" />
                            <input type="text" placeholder="Ваше имя..." name="user_register_name" />
                            <input type="text" placeholder="Ваше отчество..." name="user_register_otch" />
                            <div class="text-center">
                                <div class="button" name="get_regular_data">Далее</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body modal-body-step-3">
                        <div class="title">Поздравляем</div>
                        <div class="description">Регистрация успешно завершина!</div>
                        <div class="text-center">
                            <div class="button registration-end close-modal">Готово!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Форма входа -->
        <div class="modal-login-container">
            <div class="modal-wrap">
                <div class="modal-header">
                    <span class="is-active"></span>
                    <span></span>
                    <i class="glyphicon glyphicon-remove"></i>
                </div>
                <div class="modal-bodies">
                    <div class="modal-body modal-body-step-1">
                        <div class="title">Вход</div>
                        <div class="description">Для того, чтобы войти, введите свои данные:</div>
                        <form action="" method="POST">
                            <input type="text" placeholder="Ваш Login..." id="admin-login" name="admin-login" />
                            <input type="password" placeholder="Ваш пароль..." id="admin-password" name="admin-password" />
                            <label>
                                <input type="checkbox" id="admin-remember-me" name="admin-remember-me" /> Запомнить меня
                            </label>
                            <div class="text-center">
                                <input type="submit" class="button" id="admin-send-login" name="admin-send-login" value="Войти">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a class="link-logo-wsr" href="#top" id="goto-top">
            <div class="goTop">
                <i class="glyphicon glyphicon-arrow-up"></i>
            </div>
        </a>
        

        <!-- Выдвигающееся меню -->
        <nav class="slide-menu">
            <ul>
                <li class="menu-toggle-humburger"><div class="humburger"></div></li>
                <hr>
                <!-- <a href="#" class="registration"><li><span>Регистрация</span><i class="glyphicon glyphicon-check"></i></li></a> -->
                <?php if ( !empty( $_SESSION[ 'admin_logged' ] )
                        OR !empty( $_COOKIE[ 'admin_logged' ] ) ) : ?>
                    <a href="?view=admin"><li><span>Управлять сайтом</span><i class="glyphicon glyphicon-log-in"></i></li></a>
                <?php else: ?>
                    <a href="#" class="login"><li><span>Вход</span><i class="glyphicon glyphicon-log-in"></i></li></a>
                <?php endif; ?>
                <hr>
                <a href="#general_infornation" id="goto-teh"><li><span>Общая информация</span><i class="glyphicon glyphicon-info-sign"></i></li></a>
                <a href="#compit" id="goto-compit"><li><!--<img class="logo-wsr" src="<?= TEMPLATE; ?>img/logo-wsr.png" alt="WSR">--><span>Компетенции</span><i class="glyphicon glyphicon-list-alt"></i></li></a>
                <!--<li><a class="link-logo-wsr" href="#top" id="goto-top"></a></li>-->
                <a href="#experts" id="goto-experts"><li><span>Наши эксперты</span><i class="glyphicon glyphicon-user"></i></li></a>
                <a href="#record" id="goto-record"><li><span>Запись</span><i class="glyphicon glyphicon-pencil"></i></li></a>
                <!--<a href="#"><img class="logo-wsr" src="<?= TEMPLATE; ?>img/logo-wsr.png" alt="WSR"></a>-->
            </ul>
        </nav>
        

        <!-- Верхнее меню навигации -->
        
        <nav id="top" class="top-menu-navigation">
            <div class="container">
                <div class="row">
                    <ul>
                        <a href="#"><li><i class="fa fa-address-card-o" aria-hidden="true"></i></li></a>
                        <a href="#general_infornation"><li>Общая информация</li></a>
                        <a href="#compit"><li>Компетенции</li></a>
                        <li href="#top"><a class="link-logo-wsr" href="#top" id="goto-top"><img class="logo-wsr" src="<?= TEMPLATE; ?>img/logo-wsr.png" alt=""></a></li>
                        <a href="#experts"><li>Наши эксперты</li></a>
                        <a href="#record"><li>Запись</li></a>

                        <?php if ( !empty( $_SESSION[ 'admin_logged' ] )
                                OR !empty( $_COOKIE[ 'admin_logged' ] ) ) : ?>
                            <a href="?view=admin"><li><span>Управлять сайтом</span></li></a>
                        <?php else : ?>
                            <a href="#" class="login"><li><span>Вход</span></li></a>
                        <?php endif; ?>
                        
                    </ul>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </nav> <!-- .top-menu-navigation -->
     
        <header>
            <div class="start-background parallax-window" data-parallax="scroll" data-image-src="<?= TEMPLATE; ?>img/ws3.jpg">
                <div class="section-table">
                    <div class="section-row">
                        <div class="section-cell">
                            <div class="section-center">
                                <p>
                                    <h1>БМТ — специализированный центр компетенций</h1>
                                </p>
                                
                                <a class="btn btn-primary" href="#record" id="get-record">Записаться на конкурс</a>
                            </div> <!-- /. section-center -->
                        </div> <!-- /. section-cell -->
                    </div> <!-- /. section-row -->
                </div> <!-- /. section-table -->
          </div> <!-- /. start-background -->
        </header>

        <section id="general_infornation">

            <?php $i = 0;  ?>
            
            <?php if ( !empty( $information_blocks ) ) : ?>

                <section class="discription">
                    <div class="container">
                        <?php foreach ( $information_blocks as $block ) : ?>
                            <?php $i++; ?>

                            <?php if ($i % 2 > 0): ?>

                                <div class="row col-margin-top text-justify">
                                    <div class="col-md-6">
                                        <h2 id="#"><?= $block->title; ?></h2>
                                        <p>
                                            <?= $block->short_description; ?>
                                        </p>
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
                                        <p>
                                            <?= $block->short_description; ?>
                                        </p>
                                    </div>
                                </div> <!-- /. row /. row-margin-top /. text-justify -->
                                
                            <?php endif ?>

                        <?php endforeach; ?>
                    </div>
                </section> <!-- /. discription -->

            <?php else : ?>

                <div class="row col-margin-top text-center">
                    <p>Здесь нет ещё ни одного информационного блока</p>
                </div>

            <?php endif; ?>

        </section>
        
        <!-- <section class="discription">
        	
            <div class="container">
            	<div class="row row-margin-top text-justify">
               	    <div class="col-md-6">
                    	<h2 id="teh">О техникуме</h2>
                        <p>
                        	Полное наименование Техникума: Государственное автономное профессиональное образовательное учреждение "Бугульминскинский машиностроительный техникум".
                        
                        	Бугульминский машиностроительный техникум (далее Техникум)был организован Министерством химического и нефтяного машиностроения СССР  приказом от 23 июня 1989 г. № 94. Постановлением Совета Министров СССР от 22.07.1989 г. №580 «О совершенствовании организационных структур управления в отраслях машиностроительного комплекса» Техникум в составе объединений, предприятий и организаций бывшего Министерства химического и нефтяного машиностроения СССР передан в ведение Министерства тяжелого машиностроения СССР.
                        </p>
                    </div>
               	  	<div class="col-md-6 col-margin-top">
                        <img src="<?= TEMPLATE; ?>img/bmt-photo.jpg" alt="First slide image" class="center-block discription-photo">
                    </div>
                </div> <! /. row /. row-margin-top /. text-justify
        	</div> <! /. container
    	</section> <! /. discription -->


        <section class="objects text-justify">
            <div class="container">
              <div class="row row-margin-top text-center">
                    <h2 id="compit">Компетенции</h2>
                </div>

                <?php if ( !empty( $list_compitations ) ) : ?>

                    <?php foreach ( $list_compitations as $compitation ) : ?>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card-object row">
                                    <div class="compitation-photo col-md-5">
                                        <a href="?block=change-compitation&compitation_id=<?= $compitation->id; ?>">
                                            <img class="img-thumbnail" src="/<?= $compitation->path; ?>" alt="object-1" width="40%">
                                        </a>
                                    </div>
                                    <div class="compitation-description col-md-7">
                                        <a href="?block=change-compitation&compitation_id=<?= $compitation->id; ?>">
                                            <h3><?= $compitation->title; ?></h3>
                                        </a>
                                        <p>
                                            <?= $compitation->short_description; ?>
                                        </p>
                                        <div class="container-btn compit">
                                            <a href="?view=more-compitation&compitation_id=<?= $compitation->id; ?>"
                                               class="btn btn-primary btn-compit">Подробнее</a>
                                        </div>
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
                
                <!--<div class="row">
                    <div class="col-md-12 col-margin-top">
                        <div class="card-object row">
                            <div class="compitation-photo col-md-5">
                                <img class="img-thumbnail" src="<?= TEMPLATE; ?>img/Engeener-design.jpg" alt="object-1" width="40%">
                            </div>
                            <div class="compitation-description col-md-7">
                                <h3>Инженерный дизайн</h3>
                                <p>
                                    Термином «Инженерный дизайн CAD» обозначается использование технологии компьютерного конструирования (CAD) при подготовке графических моделей, чертежей, бумажных документов и файлов, содержащих всю информацию, необходимую для изготовления и документирования деталей и компонентов для решения механических инженерных задач, с которыми сталкиваются работники отрасли.
                                </p>
                                <div class="container-btn compit">
                                    <a class="btn btn-primary btn-compit">Подробнее</a>
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-margin-top">
                        <div class="card-object row">
                            <div class="compitation-photo col-md-5">
                                <img class="img-thumbnail" src="<?= TEMPLATE; ?>img/PolitMeh.jpg" alt="object-1" width="40%">
                            </div>
                            <div class="compitation-description col-md-7">
                                <h3>Полимеханика</h3>
                                <p>
                                    Сегодня техники-программисты, разрабатывающие управляющие программы для широкого спектра металлорежущего оборудования с ЧПУ, востребованы во многих отраслях промышленности. Станки с ЧПУ используются повсеместно: на крупных предприятиях (например, автомобильные концерны), предприятиях среднего масштаба (изготовление пресс-форм) и малых предприятиях (сектор технического обслуживания). Профессиональные техники-программисты играют ключевую роль в успехе металлообрабатывающей промышленности.
                                </p>
                                <div class="container-btn compit">
                                    <div class="btn-main">
                                        <a class="btn btn-primary btn-compit">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-margin-top">
                        <div class="card-object row">
                            <div class="compitation-photo col-md-5">
                                <img class="img-thumbnail" src="<?= TEMPLATE; ?>img/Prototype.jpg" alt="object-1" width="40%">
                            </div>
                            <div class="compitation-description col-md-7">
                                <h3>Прототипирование</h3>
                                <p>
                                    Выходом любого проектирования, является изделие. Прототипирование – является промежуточным этапом между компьютерным проектированием и изготовлением изделия. Также прототипирование можно назвать контролем качества проектирования, т.к. само изготовление изделия всегда дорогостоящая процедура, предварительный прототип помогает избежать возможные ошибки в дальнейшем производстве.
                                </p>
                                <div class="container-btn compit">
                                    <div class="btn-main">
                                        <a class="btn btn-primary btn-compit">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </section> <!-- /. objects -->

        
        <section class="reports text-justify">
        	<div class="container">
            	<div class="row row-margin-top">
                	<div class="col-md-12 text-center">
                    	<h2 id="experts">Наши эксперты</h2>
               	  </div>
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
                                    <p class="expert-compit"><span>Компетенция: </span><?= get_compitation_of_expert( $expert->compitation_id )->title; ?></p>
                                </div>
                            </div>
                            
                        <?php endforeach ?>

                    </div>

                <?php else: ?>

                    <div class="row col-margin-top text-center">
                        <p>Здесь нет ещё ни одного эксперта</p>
                    </div>

                <?php endif ?>

                <!--<div class="row">
                	<div class="col-md-6 report col-margin-top">
                    	<div class="card">
                        	<img class="img-circle expert-photo" src="<?= TEMPLATE; ?>img/Директор.jpg" alt="Marina">
                            <div class="clearfix"></div>
                            <p class="expert-name"><span>ФИО: </span> Хабипов Ирек Ибрагимович
                            <p class="expert-status"><span>Статус: </span> Эксперт</p>
                            <p class="expert-compit"><span>Компетенция: </span> Полимеханика</p>
                        </div>
                    </div>
               	  <div class="col-md-6 report col-margin-top">
               		<div class="card">
                        <img class="img-circle" src="<?= TEMPLATE; ?>img/NoPhoto.jpg" alt="Olga">
                        <div class="clearfix"></div>
                        <p class="expert-name"><span>ФИО: </span> Чистекова Ольга Александровна
                        <p class="expert-status"><span>Статус: </span> Эксперт</p>
                        <p class="expert-compit"><span>Компетенция: </span> Инженерный дизайн</p>
                   	</div>
                  </div>
               	  <div class="col-md-6 report col-margin-top">
               		<div class="card">
                            <img class="img-circle" src="<?= TEMPLATE; ?>img/NoPhoto.jpg" alt="Alexei">
                            <div class="clearfix"></div>
                            <p class="expert-name"><span>ФИО: </span> Чернуха Алексей Николаевич
                            <p class="expert-status"><span>Статус: </span> Эксперт</p>
                            <p class="expert-compit"><span>Компетенция: </span> Инженерный дизайн</p>
                        </div>
                    </div>
                	<div class="col-md-6 report col-margin-top">
                    	<div class="card">
                            <img class="img-circle" src="<?= TEMPLATE; ?>img/NoPhoto.jpg" alt="Marina">
                            <div class="clearfix"></div>
                            <p class="expert-name"><span>ФИО: </span> Шаевич Мария Александровна
                            <p class="expert-status"><span>Статус: </span> Эксперт</p>
                            <p class="expert-compit"><span>Компетенция: </span> Инженерный дизайн</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
        
        <section class="record">
            <div class="container">
                
                <div class="row row-margin-top text-center">
                    <h2 id="record">Запишитесь на конкурс прямо сейчас</h2>
                </div>
                
                <div class="row row-margin-top text-justify">
                    <form action="" method="POST">
                        <div>
                            <div id="record" class="groups-elements">
                                <label for="user-surname" class="col-md-6 lbl-input">Введите вашу фамилию: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваше фамилию</p>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Ваша фамилия"
                                               required="required"
                                               id="user-surname"
                                               name="user-surname">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>
                                
                                <label for="user-name" class="col-md-6 lbl-input">Введите ваше имя: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваше имя</p>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Ваше имя"
                                               required="required"
                                               id="user-name"
                                               name="user-name">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>
                                
                                <label for="user-otch" class="col-md-6 lbl-input">Введите ваше отчество: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваше отчество</p>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Ваше отчество"
                                               required="required"
                                               id="user-otch"
                                               name="user-otch">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>

                                <label for="user-birthday" class="col-md-6 lbl-input">Введите вашу дату рождения: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Введите вашу дату рождения</p>
                                        <input type="date"
                                               class="form-control"
                                               placeholder="Введите вашу дату рождения"
                                               required="required"
                                               id="user-birthday"
                                               name="user-birthday">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>
                                
                                <label for="user-email" class="col-md-6 lbl-input">Введите ваш Email: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваш email</p>
                                        <input type="email"
                                               class="form-control"
                                               placeholder="Ваш email"
                                               required="required"
                                               id="user-email"
                                               name="user-email">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>

                                <label for="user-phone" class="col-md-6 lbl-input">Введите ваш телефон: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваш телефон</p>
                                        <input type="tel"
                                               class="form-control"
                                               placeholder="Ваш телефон"
                                               required="required"
                                               id="user-phone"
                                               name="user-phone"
                                               maxlength="12">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>

                                <label for="user-organization" class="col-md-6 lbl-input">Учебное заведение/место работы: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <div class="container-input">
                                        <p class="input-placeholder">Ваше уч. заведение/место работы</p>
                                        <input type="text"
                                               class="form-control"
                                               required="required"
                                               id="user-organization"
                                               name="user-organization"
                                               placeholder="Ваше уч. заведение/место работы">
                                        <div class="input-undeline"></div>
                                    </div>
                                </div>

                                <label for="user-compitation" class="col-md-6 lbl-input">Выберите компетенцию: </label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input user-container">

                                  <?php if ( !empty( $list_compitations ) ) : ?>

                                    <select class="form-control" name="user-compitation" id="user-compitation" required="required">

                                      <option value="" selected="selected" disabled="disabled">Выберите компетенцию</option>

                                        <?php foreach ( $list_compitations as $compitation ) : ?>
                                          
                                          <option value="<?= $compitation->id; ?>"><?= $compitation->title; ?></option>

                                        <?php endforeach; ?>

                                    </select>

                                    <?php else : ?>

                                      <p>Ещё нет ниодной компетенции, чтобы добавить, кликните <a href="?view=admin&block=add-compitation">здесь</a></p>
                                        
                                    <?php endif; ?>

                                </div>
                                
                                <label class="col-md-6 lbl-input"></label>
                                <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                                    <input type="submit"
                                           value="Записаться"
                                           id="make-statement"
                                           name="send-user-record"
                                           class="form-control make-statement">
                                </div>

                            </div>
                        </div>
                              
                    </form>
                    
                </div>
            </div>
        </section>

        <div class="query-is-success"></div>
        
        <div class="section contacts">
        	<div class="container text-center">
        		<div class="row col-margin-top">
        			<h2>Наши контакты</h2>
        		</div>
                <div class="row col-margin-top">
                	<div class="col-md-3 col-md-offset-1 col-margin-top phone-company">
                    	<p class="contacts-title">Наш телефон:</p>
                        <p class="large-text">+7 (85594) 9116 <br> 91-08-6</p>
                    </div>
                    <div class="col-md-3 col-margin-top email-company">
                    	<p class="contacts-title">Наш email:</p>
                        <p class="large-text">info@bumate.ru</p>
                    </div>
                    <div class="col-md-3 col-margin-top address-company">
                    	<p class="contacts-title">Наш адрес:</p>
                        <p class="large-text">г. Бугульма, ул. Владимира Ленина, д. 144</p>
                    </div>
                </div>
        	</div>
        </div>

        <div class="container google-map">
            <div class="row row-margin-top text-center">
                <h2>Найдите нас</h2>
            </div>
        </div>
        <iframe class="col-margin-top" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1376.7641917745482!2d52.83781053407664!3d54.52587535961689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4161a8b254366675%3A0xa982a814849ea0e5!2z0JHRg9Cz0YPQu9GM0LzQuNC90YHQutC40Lkg0LzQsNGI0LjQvdC-0YHRgtGA0L7QuNGC0LXQu9GM0L3Ri9C5INGC0LXRhdC90LjQutGD0Lw!5e0!3m2!1sru!2sru!4v1487173346951" width="100%" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe>
        
        <footer>
        	<div class="container text-justify">
        		<div class="row">
        			<div class="col-md-4 socian footer-block">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<h3>Официальный сайт WSR:</h3>
                            </div>
                        </div>
                        <a href="http://worldskills.ru/"
                           target="_blank">
                           <img class="footer-wsr-logo"
                                src="<?= TEMPLATE; ?>img/logo-wsr.png"
                                alt="Официальнйы сайт WSR"
                                title="Официальный сайт WSR"
                                data-toggle="tooltip"
                                data-placement="top">
                        </a>
                        <p>WSR — это международное некоммерческое движение, целью которого является повышение престижа рабочих профессий и развитие профессионального образования путем гармонизации лучших практик и профессиональных стандартов во всем мире посредством организации и проведения конкурсов профессионального мастерства, как в каждой отдельной стране, так и во всем мире в целом.</p>
                    </div>

                    <div class="col-md-4 payment footer-block">
                        <div class="row">
                            <h3 class="col-md-12">Наши партнёры:</h3>
                            <div class="partner">
                                <a class="col-md-3" href="http://bmz.tatneft.ru/" target="_blank"><img src="<?= TEMPLATE; ?>img/partners-bmz1.jpg" class="img-circle" alt="Официальный сайт БМЗ" title="Официальный сайт БМЗ"></a>
                                <div>
                                    <p>Бугульминский механический завод (БМЗ)</p>
                                </div>
                            </div>
                            <div class="partner">
                                <a class="col-md-3" href="http://gridcom-rt.ru/" target="_blank"><img src="<?= TEMPLATE; ?>img/partners-bes1.png" class="img-circle" alt="Официальный сайт БЭС" title="Официальный сайт БЭС"></a>
                                <div>
                                    <p>Бугульминские элкетрические сети (БЭС)</p>
                                </div>
                            </div>
                            <div class="partner">
                                <a class="col-md-3" href="http://www.ktits.ru/" target="_blank"><img src="<?= TEMPLATE; ?>img/partners-ktits.png" alt="Официальный сайт КТИТС" title="Официальный сайт КТИТС"></a>
                                <div>
                                    <p class="text-left">Казанский техникум информационных технологий и связи (КТИТС)</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 footer-block footer-questions">
                    	<h3>Остались вопросы?</h3>
                        <p>
                            Напишите нам свой вопрос и незамедлительно ответим на него
                        </p>
                        <p>
                            <a href="#">Написать вопрос</a>
                        </p>
                            <div>
                                <a href="#">
                                    <img src="<?= TEMPLATE; ?>img/envelope.png" alt="Написать свой вопрос" title="Написать свой вопрос">
                                </a>
                            </div>
                    </div>
        		</div>
        	</div>
            <div class="container-fluid col-margin-top copy">
            	<div class="container">
                    <div class="row copyright text-left">
                        <p>Директор техникума: Хабипов И. И.</p>
                    </div>
                </div>
            </div>
        </footer>
        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <?php print_scripts(); ?>

    </body>
    </html>