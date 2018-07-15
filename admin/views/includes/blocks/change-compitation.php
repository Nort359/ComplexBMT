<section class="record">
    <div class="container">
        
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

                        <label for="compitation-title" class="col-md-6 lbl-input">Введите название компитенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Название компитенции</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Название компитенции..."
                                       required="required"
                                       id="compitation-title"
                                       name="compitation-title"
                                       value="<?= @$current_compitation->title; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="compitation-short-description" class="col-md-6 lbl-input">Введите краткое описание компитенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Краткое описание компитенции"
                                          required="required"
                                          id="compitation-short-description"
                                          name="compitation-short-description"
                                          rows="5"><?= @$current_compitation->short_description; ?></textarea>
                            </div>
                        </div>

                        <label for="compitation-description" class="col-md-6 lbl-input">Введите полное описание компитенции: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <textarea class="form-control short-description"
                                          placeholder="Полное описание компитенции"
                                          required="required"
                                          id="compitation-description"
                                          name="compitation-description"
                                          rows="10"><?= @$current_compitation->description; ?></textarea>
                            </div>
                        </div>

                        <label for="compitation-img" class="col-md-6 lbl-input" title="Если вы не загрузите изображение, будет присвоино изображение по умолчанию">Загрузите изображение: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <input type="file"
                                       class="form-control"
                                       placeholder="Загрузите изображение"
                                       id="compitation-img"
                                       name="compitation-img">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"> <!-- Максимальный размер файла около 2Мб -->
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
                                       value="<?= @$current_compitation->date_begin; ?>">
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
                                       value="<?= @$current_compitation->date_end; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <div class="row row-margin-top text-center">
                          <h2 id="doc-header">Документы, принадлежашие этой компитенции:</h2>
                        </div>

                        <div class="exists-documents row">
                          <?php if ( !empty( $docs ) ) : ?>

                            <?php foreach ($docs as $doc) : ?>
                            
                              <div class="doc col-md-12">
                                <div class="doc-title col-md-11 col-xs-9"><?= $doc->title; ?></div>
                                <div class="doc-delete col-md-1 col-xs-3">
                                  <a href="?view=admin&block=change-compitation&action=delete_doc&doc_id=<?= $doc->id; ?>">
                                    <i class="glyphicon glyphicon-remove"></i>
                                  </a>
                                </div>
                              </div>

                            <?php endforeach ?>

                          <?php else: ?>

                            <p>У данной компитенции ещё нет ни одного документа</p>
                            
                          <?php endif ?>

                        </div>

                        <div class="documents col-md-12">
                          
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <a href="?view=admin&action=reg" class="form-control make-statement btn-goast add-document" id="add-document">Добавить новые поля для документа</a>
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="make-statement"
                                   value="Изменить компитенцию"
                                   name="compitation-change">
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>