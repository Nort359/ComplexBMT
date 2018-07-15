<section class="record">
    <div class="container">
        
        <div class="row row-margin-top text-center">
            <h2 id="record">Прежде чем войти в панель администратора, пожалуйста, введите свои данные:</h2>
            <div class="col-md-6 col-md-offset-0 col-xs-10 message-error">
              <?php
                if( !empty( $message_error_log_in ) ) {
                  echo $message_error_log_in;
                }
              ?>
            </div>
        </div>
        
        <div class="row row-margin-top text-justify">
            <form action="" method="POST">
                <div>
                    <div id="record" class="groups-elements">

                        <label for="user-login" class="col-md-6 lbl-input">Введите ваш Login: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Ваш Login...</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Ваш Login..."
                                       required="required"
                                       id="admin-login"
                                       name="admin-login"
                                       value="<?= @$_POST[ 'admin-login' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>
                        
                        <label for="user-password" class="col-md-6 lbl-input">Введите ваш пароль: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Ваш пароль...</p>
                                <input type="password"
                                       class="form-control"
                                       placeholder="Ваш пароль..."
                                       required="required"
                                       id="admin-password"
                                       name="admin-password">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="user-password" class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1">
                            <div class="">
                                <div class="remember-me-container">
                                  <label for="admin-remember-me" class="col-md-6 lbl-input remember-me-lbl">Запомнить меня:</label>
                                  <input type="checkbox"
                                         class="remember-me-checkbox"
                                         id="admin-remember-me"
                                         name="admin-remember-me">
                                </div>
                            </div>
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="make-statement"
                                   value="Войти в панель администратора"
                                   name="admin-send-login">
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <a href="?view=admin&action=reg" class="form-control make-statement btn-goast" id="make-statement">Хочу стать администратором</a>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>