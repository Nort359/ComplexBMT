<section class="record">
    <div class="container">
        
        <div class="row row-margin-top text-center">
            <h2 id="record">Для изменения данного эксперта, пожалуйста, заполните все поля:</h2>
        </div>
        
        <div class="row row-margin-top text-center">
          <?php

            if ( !empty( $_SESSION[ 'errors' ][ 'message_error_add_expert' ] ) ) {
              echo $_SESSION[ 'errors' ][ 'message_error_add_expert' ];
            } else {
              echo $_SESSION[ 'errors' ][ 'message_success_add_expert' ];
            }

            // Удаляем флэш-сообщения
            unset( $_SESSION[ 'errors' ][ 'message_error_add_expert' ],
                   $_SESSION[ 'errors' ][ 'message_success_add_expert' ] );

          ?>
        </div>

        <div class="row row-margin-top text-justify">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div id="record" class="groups-elements">

                        <label for="expert-surname" class="col-md-6 lbl-input">Введите фамилию эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Фамилия эксперта</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Фамилия эксперта"
                                       required="required"
                                       id="expert-surname"
                                       name="expert-surname"
                                       value="<?= @$current_expert->surname; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="expert-name" class="col-md-6 lbl-input">Введите имя эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Имя эксперта</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Имя эксперта"
                                       required="required"
                                       id="expert-name"
                                       name="expert-name"
                                       value="<?= @$current_expert->name; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="expert-otchestvo" class="col-md-6 lbl-input">Введите отчество эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Отчество эксперта</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Отчество эксперта"
                                       required="required"
                                       id="expert-otchestvo"
                                       name="expert-otchestvo"
                                       value="<?= @$current_expert->otchestvo; ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="expert-status" class="col-md-6 lbl-input">Введите статус эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <p class="input-placeholder">Статус эксперта</p>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Статус эксперта"
                                       required="required"
                                       id="expert-status"
                                       name="expert-status"
                                       value="<?php
                                                if ( !empty( @$current_expert->status ) ) {
                                                  echo @$current_expert->status;
                                                } else {
                                                  echo 'Эксперт';
                                                }
                                              ?>">
                                <div class="input-undeline"></div>
                            </div>
                        </div>

                        <label for="expert-compitation" class="col-md-6 lbl-input">Выберите компитенцию эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">

                          <?php if ( !empty( $list_compitations ) ): ?>

                            <select class="form-control" name="expert-compitation" id="expert-compitation" required="required">
                              <option value="" selected="selected" disabled="disabled" >Выберите компитенцию</option>

                                <?php foreach ($list_compitations as $compitation): ?>
                                  
                                  <option value="<?= $compitation->id; ?>"><?= $compitation->title; ?></option>

                                <?php endforeach ?>

                            </select>

                          <?php else: ?>

                              <p>Ещё нет ниодной компитенции, чтобы добавить, кликните <a href="?view=admin&block=add-compitation">здесь</a></p>
                                
                          <?php endif ?>
                        </div>

                        <label for="expert-photo" class="col-md-6 lbl-input" title="Если вы не загрузите изображение, будет присвоино изображение по умолчанию">Загрузите фото эксперта: </label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <div class="container-input">
                                <input type="file"
                                       class="form-control"
                                       placeholder="Загрузите изображение"
                                       id="expert-photo"
                                       name="expert-photo">
                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000"> <!-- Максимальный размер файла около 2Мб -->
                            </div>
                        </div>

                        <label class="col-md-6 lbl-input"></label>
                        <div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">
                            <input type="submit"
                                   class="form-control make-statement"
                                   id="make-statement"
                                   value="Добавить эксперта"
                                   name="expert-add-new">
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>