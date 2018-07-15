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
            <a href="#teh" id="goto-teh"><li><span>О техникуме</span><i class="glyphicon glyphicon-info-sign"></i></li></a>
            <a href="#compit" id="goto-compit"><li><!--<img class="logo-wsr" src="<?= TEMPLATE; ?>img/logo-wsr.png" alt="WSR">--><span>Компитенции</span><i class="glyphicon glyphicon-list-alt"></i></li></a>
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
                    <a href="#teh"><li>О техникуме</li></a>
                    <a href="#compit"><li>Компитенции</li></a>
                    <li href="#top"><a class="link-logo-wsr" href="#top" id="goto-top"><img class="logo-wsr" src="<?= TEMPLATE; ?>img/logo-wsr.png" alt=""></a></li>
                    <a href="#experts"><li>Наши эксперты</li></a>
                    <a href="#record"><li>Запись</li></a>
                    <?php if ( !empty( $_SESSION[ 'admin_logged' ] )
                    OR !empty( $_COOKIE[ 'admin_logged' ] ) ) : ?>
                        <a href="?view=admin"><li><span>Управлять сайтом</span></li></a>
                    <?php else: ?>
                        <a href="#" class="login"><li><span>Вход</span></li></a>
                    <?php endif; ?>
                    
                </ul>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </nav> <!-- .top-menu-navigation -->


    <section class="objects text-justify">
        <div class="container">
            <?php if ( !empty( $current_compitation ) ) : ?>

                <div class="row row-margin-top text-center">
                    <h2 id="compit"><?= $current_compitation->title; ?></h2>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="card-object row">
                            <div class="compitation-photo col-md-5">
                                <img class="img-thumbnail" src="/<?= $current_compitation->path; ?>" alt="object-1" width="40%">
                            </div>
                            <p>
                                <?= $current_compitation->description; ?>
                            </p>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <h3>Дата начала конкурса: <?= $current_compitation->date_begin; ?></h3>

                </div>

                <div class="row">

                    <h3>Дата конца конкурса: <?= $current_compitation->date_end; ?></h3>

                </div>

                <div class="row text-center">

                    <h2>Список необходимых документов</h2>

                </div>

                <div class="exists-documents row">
                    <?php if ( !empty( $docs ) ) : ?>

                        <?php foreach ($docs as $doc) : ?>
                        
                          <div class="doc col-md-12">
                            <div class="doc-title col-md-11 col-xs-9"><?= $doc->title; ?></div>
                            <div class="doc-delete col-md-1 col-xs-3">
                              <a href="?view=more-compitation&action=get_document&document_id=<?= $doc->id; ?>">
                                <i class="glyphicon glyphicon-download-alt" title="Скачать документ"></i>
                              </a>
                            </div>
                          </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <p>У данной компитенции ещё нет ни одного документа</p>
                        
                    <?php endif; ?>

                </div>

            <?php else : ?>

                <div class="row col-margin-top text-center">
                    <p>Здесь нет ещё ни одной компитенции</p>
                </div>

            <?php endif; ?>
        </div>
    </section> <!-- /. objects -->
    
    <footer class="row-margin-top">
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