<section class="record">
    <div class="container">
        
        <div class="row row-margin-top text-center">
            <h2 id="record">Для создания новой компетенции, пожалуйста, заполните все поля:</h2>
        </div>
        
        <div class="row row-margin-top text-center">

          <?php if ( !empty( $_SESSION[ 'errors' ][ 'message_error_add_compit' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon error-flash-message"><i class="glyphicon glyphicon-remove"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_error_add_compit' ]; ?></span></div>
            </div>

            <?php if ( !empty( $_SESSION[ 'warnings' ][ 'message_warnings_add_document' ] ) ) : ?>
              
              <div class="alert-element">
                <div class="icon warning-flash-message"><i class="glyphicon glyphicon-warning-sign"></i></div>
                <div class="text"><span><?= $_SESSION[ 'warnings' ][ 'message_warnings_add_document' ]; ?></span></div>
              </div>

            <?php elseif ( !empty( $_SESSION[ 'warnings' ][ 'message_success_add_document' ] ) ) : ?>

              <div class="alert-element">
                <div class="icon success-flash-message"><i class="glyphicon glyphicon-ok"></i></div>
                <div class="text"><span><?= $_SESSION[ 'warnings' ][ 'message_success_add_document' ]; ?></span></div>
              </div>

            <?php endif ?>

          <?php elseif ( !empty( $_SESSION[ 'errors' ][ 'message_success_add_compit' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon success-flash-message" ><i class="glyphicon glyphicon-ok"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_success_add_compit' ]; ?></span></div>
            </div>

            <?php if ( !empty( $_SESSION[ 'warnings' ][ 'message_warnings_add_document' ] ) ) : ?>
              
              <div class="alert-element">
                <div class="icon warning-flash-message"><i class="glyphicon glyphicon-warning-sign"></i></div>
                <div class="text"><span><?= $_SESSION[ 'warnings' ][ 'message_warnings_add_document' ]; ?></span></div>
              </div>

            <?php elseif ( !empty( $_SESSION[ 'warnings' ][ 'message_success_add_document' ] ) ) : ?>

              <div class="alert-element">
                <div class="icon success-flash-message"><i class="glyphicon glyphicon-ok"></i></div>
                <div class="text"><span><?= $_SESSION[ 'warnings' ][ 'message_success_add_document' ]; ?></span></div>
              </div>

            <?php endif ?>

          <?php endif; ?>

          <?php

            // Удаляем флэш-сообщения
            unset( $_SESSION[ 'errors' ][ 'message_error_add_compit' ],
                   $_SESSION[ 'errors' ][ 'message_success_add_compit' ],
                   $_SESSION[ 'warnings' ][ 'message_warnings_add_document' ],
                   $_SESSION[ 'warnings' ][ 'message_success_add_document' ] );

          ?>
          
        </div>

        <div class="row row-margin-top text-justify">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div id="record" class="groups-elements">

                        <label for="compitation-title" class="col-md-6 lbl-input">Введите название компетенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Название компетенции</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Название компетенции..."
                                       required="required"
                                       id="compitation-title"
                                       name="compitation-title"
                                       value="<?= @$_POST[ 'compitation-title' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="compitation-short-description" class="col-md-6 lbl-input">Введите краткое описание компетенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Краткое описание компетенции"
                                          required="required"
                                          id="compitation-short-description"
                                          name="compitation-short-description"
                                          rows="5"><?= @$_POST[ 'compitation-short-description' ]; ?></textarea>
                            </div>
                        </div>

                        <label for="compitation-description" class="col-md-6 lbl-input">Введите полное описание компетенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Полное описание компетенции"
                                          required="required"
                                          id="compitation-description"
                                          name="compitation-description"
                                          rows="10"><?= @$_POST[ 'compitation-description' ]; ?></textarea>
                            </div>
                        </div>

                        <label for="compitation-img" class="col-md-6 lbl-input" title="Если вы не загрузите изображение, будет присвоино изображение по умолчанию">Загрузите изображение: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <input type="file"
                                       class="form-control"
                                       placeholder="Загрузите изображение"
                                       required="required"
                                       id="compitation-img"
                                       name="compitation-img">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"> <!-- Максимальный размер файла около 10Мб -->
                            </div>
                        </div>

                        <label for="compitation-date-begin" class="col-md-6 lbl-input">Введите дату начала конкурса: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Введите дату начала конкурса</p>
                                <input type="date"
                                       class="form-control"
                                       placeholder="Введите дату начала конкурса"
                                       id="compitation-date-begin"
                                       name="compitation-date-begin"
                                       value="<?= @$_POST[ 'compitation-date-begin' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="compitation-date-end" class="col-md-6 lbl-input">Введите дату окончания конкурса: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Введите дату окончания конкурса</p>
                                <input type="date"
                                       class="form-control"
                                       placeholder="Введите дату окончания конкурса"
                                       id="compitation-date-end"
                                       name="compitation-date-end"
                                       value="<?= @$_POST[ 'compitation-date-end' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <div class="documents col-md-12">
                          
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <a href="?view=admin&view=index&action=reg" class="form-control make-statement btn-goast add-document" id="add-document">Добавить новый документ</a>
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="make-statement"
                                   value="Создать компетенцию"
                                   name="compitation-add-new">
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>