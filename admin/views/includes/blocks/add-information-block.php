<section class="record">
    <div class="container">
        
        <div class="row row-margin-top text-center">

          <?php if ( !empty( $_SESSION[ 'errors' ][ 'message_error_information-block' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon error-flash-message"><i class="glyphicon glyphicon-remove"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_error_information-block' ]; ?></span></div>
            </div>

          <?php elseif ( !empty( $_SESSION[ 'errors' ][ 'message_success_information-block' ] ) ) : ?>

            <div class="alert-element">
              <div class="icon success-flash-message" ><i class="glyphicon glyphicon-ok"></i></div>
              <div class="text"><span><?= $_SESSION[ 'errors' ][ 'message_success_information-block' ]; ?></span></div>
            </div>

          <?php endif; ?>

          <?php

            // Удаляем флэш-сообщения
            unset( $_SESSION[ 'errors' ][ 'message_error_information-block' ],
                   $_SESSION[ 'errors' ][ 'message_success_information-block' ] );

          ?>
          
        </div>

        <div class="row row-margin-top text-justify">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div id="record" class="groups-elements">

                        <label for="information-block-title" class="col-md-6 lbl-input">Введите заголовок блока: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Заголовок</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Заголовок"
                                       required="required"
                                       id="information-block-title"
                                       name="information-block-title"
                                       value="<?= @$_POST[ 'information-block-title' ]; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="information-block-short-description" class="col-md-6 lbl-input">Введите краткое описание блока: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Краткое описание блока"
                                          required="required"
                                          id="information-block-short-description"
                                          name="information-block-short-description"
                                          rows="5"><?= @$_POST[ 'information-block-short-description' ]; ?></textarea>
                            </div>
                        </div>

                        <label for="information-block-description" class="col-md-6 lbl-input">Введите полное описание блока: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Полное описание блока"
                                          required="required"
                                          id="information-block-description"
                                          name="information-block-description"
                                          rows="10"><?= @$_POST[ 'information-block-description' ]; ?></textarea>
                            </div>
                        </div>

                        <label for="information-block-img" class="col-md-6 lbl-input" title="Если вы не загрузите изображение, будет присвоино изображение по умолчанию">Загрузите изображение: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <input type="file"
                                       class="form-control"
                                       placeholder="Загрузите изображение"
                                       required="required"
                                       id="information-block-img"
                                       name="information-block-img">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"> <!-- Максимальный размер файла около 10Мб -->
                            </div>
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="make-statement"
                                   value="Создать новый информационный блок"
                                   name="information-block-add-new">
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>