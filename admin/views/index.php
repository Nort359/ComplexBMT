<?php //header( "Location: http://complexbmt/admin/" ); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>БМТ — админская панель</title>

		<!-- Вставляем все необходимые стили -->
		<?php print_styles_admin(); ?>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>

		<?php require_once __DIR__ . '/includes/header.php'; ?> <!-- Подключение шапки -->

		<?php if ( !empty( $_SESSION[ 'admin_logged' ] )
			    OR !empty( $_COOKIE[ 'admin_logged' ] ) ) : ?>

			<div class="row col-margin-top text-center">
	            <h2><?= $blockCaption; ?></h2>
	        </div>

	        <!-- <?php require_once __DIR__ . '/includes/side_bar.php'; ?> --> <!-- Подключение Сайд-бара -->

			<!-- Подключение блока -->
	        <?php

	        	if ( file_exists( __DIR__ . "/includes/blocks/$block.php" ) ) {
	        		require_once __DIR__ . "/includes/blocks/$block.php";
	        	} else {
	        		$noBlock = 'Такого блока не существует';
	        	}

	        ?>

	        <?php if( !empty( $noBlock ) ) : ?>
	        	<div class="row col-margin-top text-center">
	        		<p><?= $noBlock; ?></p>
        		</div>
	        <?php endif; ?>

		<?php else : ?>

			<?php if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'reg' ) : ?>

				<?php require_once __DIR__ . '/includes/signup.php'; ?> <!-- Подключение формы регистрации -->


			<?php else : ?>
				
				<?php require_once __DIR__ . '/includes/login.php'; ?> <!-- Подключение формы входа -->

			<?php endif; ?>

		<?php endif; ?>

		<!-- <?php require_once __DIR__ . '/includes/footer.php'; ?> --> <!-- Подключение футера -->

		<!-- Вставляем все необходимые скрипты -->
		<?php print_scripts_admin(); ?>

	</body>
</html>