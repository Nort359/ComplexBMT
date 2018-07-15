<nav id="top" class="top-menu-navigation">
    <ul>
        <a href="#"><li><i class="glyphicon glyphicon-user" aria-hidden="true"></i></li></a>
        <a href="?view=admin&block=information-blocks"><li>Информационные блоки</li></a>
        <a href="?view=admin&block=compitation"><li>Компитенции</li></a>
        <li><a class="link-logo-wsr" href="/"><img class="logo-wsr" src="<?= '../' . TEMPLATE; ?>img/logo-wsr.png" alt="Перейти наа главную страницу"></a></li>
        <a href="?view=admin&block=experts"><li>Эксперты</li></a>
        <a href="?view=admin&block=participant"><li>Участники</li></a>
        <?php if ( !empty( $_SESSION[ 'admin_logged' ] )
                OR !empty( $_COOKIE[ 'admin_logged' ] ) ) : ?>
        	<a href="?view=admin&action=logout"><li>Выход</li></a>
        <?php else : ?>
        	<a href="/admin/"><li>Вход</li></a>
        <?php endif; ?>

    </ul>
</nav> <!-- .top-menu-navigation -->