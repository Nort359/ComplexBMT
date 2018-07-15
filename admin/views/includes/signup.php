<section class="record">
    <div class="container">
        
        <div class="row row-margin-top text-center">
            <h2 id="record">Желаете стать администратором?<br>Впишите свои данные и ждите подтверждения</h2>
        </div>

        <div class="row row-margin-top text-center">

          <?php if ( !empty( $_SESSION[ 'errors' ][ 'message_error_add_admin' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon error-flash-message"><i class="glyphicon glyphicon-remove"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_error_add_admin' ]; ?></span></div>
            </div>

          <?php elseif ( !empty( $_SESSION[ 'errors' ][ 'message_success_add_admin' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon success-flash-message" ><i class="glyphicon glyphicon-ok"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_success_add_admin' ]; ?></span></div>
            </div>

          <?php endif; ?>

          <?php

            // Удаляем флэш-сообщения
            unset( $_SESSION[ 'errors' ][ 'message_error_add_admin' ],
                   $_SESSION[ 'errors' ][ 'message_success_add_expert' ] );

          ?>
          
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
                                       id="admin-surname"
                                       name="admin-surname"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       value="<?= @$_POST[ 'admin-surname' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>
                        
                        <label for="admin-name" class="col-md-6 lbl-input">Введите ваше имя: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Ваше имя</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Ваше имя"
                                       required="required"
                                       id="admin-name"
                                       name="admin-name"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       value="<?= @$_POST[ 'admin-name' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>
                        
                        <label for="admin-otch" class="col-md-6 lbl-input">Введите ваше отчество: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Ваше отчество</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Ваше отчество"
                                       required="required"
                                       id="admin-otch"
                                       name="admin-otch"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       value="<?= @$_POST[ 'admin-otch' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>
                        
                        <label for="admin-email" class="col-md-6 lbl-input">Введите ваш Email: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Ваш email</p>
                                <input type="email"
                                       class="form-control"
                                       placeholder="Ваш email"
                                       required="required"
                                       id="admin-email"
                                       name="admin-email"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       value="<?= @$_POST[ 'admin-email' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="admin-login" class="col-md-6 lbl-input">Придумайте Login: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Придумайте Login</p>
                                <input type="text"
                                       id="admin-login"
                                       class="form-control"
                                       placeholder="Придумайте Login"
                                       required="required"
                                       id="admin-login"
                                       name="admin-login"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       value="<?= @$_POST[ 'admin-login' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="admin-password" class="col-md-6 lbl-input">Придумайте пароль: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Придумайте пароль</p>
                                <input type="password"
                                       id="admin-password"
                                       class="form-control"
                                       placeholder="Придумайте пароль"
                                       required="required"
                                       id="admin-password"
                                       name="admin-password"
                                       data-toggle="tooltip"
                                       data-placement="bottom">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="admin-password-again" class="col-md-6 lbl-input">Повторите пароль: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Повторите пароль</p>
                                <input type="password"
                                       class="form-control"
                                       placeholder="Повторите пароль"
                                       required="required"
                                       id="admin-password-again"
                                       name="admin-password-again"
                                       data-toggle="tooltip"
                                       data-placement="bottom">
                                <div class="input-undeline"></div>
                            </div>
                        </div>
                        
                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="admin-registration"
                                   value="Отправить заявку"
                                   name="admin-registration">
                        </div>
                        
                        <label class="col-md-6 lbl-input"></label>

                    </div>
                </div>
                      
            </form>
            
        </div>
    </div>
</section>