<div class="container">
  <div class="row">
    <?php if ( !empty( $participants ) ) : ?>

      <?php

        $russian_mounth = array(
          1 => 'Январь',
          2 => 'Февраль',
          3 => 'Март',
          4 => 'Апрель',
          5 => 'Май',
          6 => 'Июнь',
          7 => 'Июль',
          8 => 'Август',
          9 => 'Сентябрь',
          10 => 'Октябрь',
          11 => 'Ноябрь',
          12 => 'Декабрь'
        );

      ?>

      <?php foreach ( $participants as $participant ) : ?>

        <div class="participants col-md-12">
          <div class="participants-fio col-md-11 col-xs-9"><?= 'ФИО: ' . $participant->surname . ' ' . $participant->name . ' ' . $participant->otchestvo; ?></div>

          <div class="col-md-12">
            <p>
              <span>Дата  регистрации: </span>
              <?= date( 'd', strtotime( $participant->date_record ) )
          . ' ' . $russian_mounth[ date( 'n', strtotime( $participant->date_record ) ) ]
          . ' ' . date( 'Y', strtotime( $participant->date_record ) ); ?>
            </p>
          </div>

          <div class="hidden-info-participant col-md-12">
            <span>Email участника: </span>
            <?= $participant->email; ?>
          </div>

          <div class="hidden-info-participant col-md-12">
            <span>Номер телефона участника: </span>
            <?= $participant->phone_number; ?>
          </div>

          <div class="hidden-info-participant col-md-12">
            <span>Организация участника: </span>
            <?= $participant->organization; ?>
          </div>

          <div class="participant-more-information col-md-12">
            <a href="#"><i class="glyphicon glyphicon-plus" data-open="close"></i>Больше информации</a>
          </div>

        </div>
        

      <?php endforeach ?>

    <?php else: ?>


    <div class="row row-margin-top text-center">
        <p>Здесь нет ещё ни одного участника</p>
    </div>
      
      
    <?php endif ?>

  </div>
</div>