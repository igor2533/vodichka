<?php
/**
 * Template Name: О конкурсе
 */
  get_header();
?>

<div class="page-content page-content__desc">
            <div class="center-wrapper">
                <div class="title main-title main-title__desc">
                    <h3>О конкурсе</h3>
                </div>

                <section class="desc-goals">
                    
                    <span class="desc-section-heading">Цели конкурса</span>

                    <div class="desc-goals__items">
                        <?php $goals = get_field('цели_конкурса'); ?>
                        <?php foreach ($goals as $goal) { ?>
                          <div class="desc-goals__item">
                              <p><?php echo $goal['цель']; ?></p>
                          </div>
                        <?php } ?>
                    </div>

                </section>

            </div>

        </div>

        <section class="desc-participants">
            <div class="bg-wrapper"></div>
            <div class="center-wrapper">

                <div class="desc-participants_content">
                
                    <span class="desc-section-heading">Участники</span>

                    <ul class="desc-list">
                        <?php $participants = get_field('участники'); ?>
                        <?php foreach ($participants as $participant) { ?>
                          <li><?php echo $participant['пункт']; ?></li>
                        <?php } ?>
                    </ul>

                </div>

            </div>

        </section>

        <section class="desc-demands">

            <div class="center-wrapper">
                
                <span class="desc-section-heading">Требования к конкурсным проектам</span>

                <p><?php echo get_field('требования'); ?></p>

            </div>

        </section>

        <section class="desc-geography">
            
            <div class="center-wrapper">
                
                <span class="desc-section-heading">География</span>

                <div class="desc-geography__items">
                    <?php $geography = get_field('география'); ?>
                    <?php foreach ($geography as $country) { ?>
                      <div class="desc-geography__item">
                          <div class="desc-geography__img">
                              <img src="<?php echo $country['флаг']; ?>" alt="<?php echo $country['название']; ?>">
                          </div>
                          <p><?php echo $country['название']; ?></p>
                      </div>
                    <?php } ?>
                </div>

                <div class="desc-geography__items desc-geography__items_mobile">
                    <?php
                        $geography = get_field('география');
                        $geography_parts = array_chunk($geography, ceil(count($geography) / 2));
                    ?>
                    <div class="desc-geography__items_left">
                        
                        <?php foreach ($geography_parts[0] as $country) { ?>
                        <div class="desc-geography__item">
                            <div class="desc-geography__img">
                                <img src="<?php echo $country['флаг']; ?>" alt="<?php echo $country['название']; ?>">
                            </div>
                            <p><?php echo $country['название']; ?></p>
                        </div>
                        <?php } ?>

                    </div>


                    <div class="desc-geography__items_right">
                        <?php foreach ($geography_parts[1] as $country) { ?>
                        <div class="desc-geography__item">
                            <div class="desc-geography__img">
                                <img src="<?php echo $country['флаг']; ?>" alt="<?php echo $country['название']; ?>">
                            </div>
                            <p><?php echo $country['название']; ?></p>
                        </div>
                        <?php } ?>

                    </div>

                </div>

            </div>

        </section>

        <section class="desc-timing">
            
            <div class="center-wrapper">
                
                <span class="desc-section-heading">Сроки и порядок проведения конкурса</span>
                
                <div class="desc-timing__items">
                    <?php $dates = get_field('сроки'); ?>
                    <?php foreach ($dates as $date) { ?>
                        
                        <div class="desc-timing__item">
                            <p class="desc-timing__date"><?php echo $date['дата']; ?></p>
                            <p class="desc-timing__descr"><?php echo $date['описание']; ?></p>
                        </div>
                    <?php } ?>
                </div>

            </div>

        </section>

        <section class="desc-registration">
            
            <div class="center-wrapper">
                
                <span class="desc-section-heading">Регистрация и порядок представления</span>

            <div class="desc-registration__items">
                                                                <div class="desc-registration__item">
                            <span class="desc-registration__number">
                            	
                            	<img src="">
                            </span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Всем желающим принять участие в конкурсе необходимо пройти регистрацию на сайте и подтвердить электронный адрес</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">2</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Заполнить личный профиль участника</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">3</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Создать проект для одной из номинаций и подготовить файлы:
1-6 планшетов в формате png/jpg/jpeg (размером 1000х1400px)
1-6 планшетов в формате pdf (размером 100х140см, разрешением не менее 300px)
Файл проекта в формате pln/pla
Файл в формате bimx (опционально)
Видеоролик mp4 (опционально)</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">4</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Загрузить подготовленные файлы в личный кабинет</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">5</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Получить сообщение о приеме проекта к участию или комментарии к проекту</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">6</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Ожидать результатов конкурса</p>
                                                                  <svg width="100%" height="1">
                                    <line x1="0" y1="0" x2="100%" y2="0" stroke-width="1" stroke-dasharray="10" stroke="#cccccc"></line>
                                  </svg>
                                                            </div>
                        </div>
                                            <div class="desc-registration__item">
                            <span class="desc-registration__number">7</span>
                            <div class="desc-registration__content">
                                <p class="desc-registration__text">Получить приз и рассказать всем друзьям о победе!</p>
                                                            </div>
                        </div>
                    
                </div>

            </div>

        </section>

        <section class="desc-criterions">
            
            <div class="center-wrapper">
                
                <span class="desc-section-heading">Критерии участия</span>

                <div class="desc-criterions__items">
                    <?php $criterions = get_field('критерии'); ?>
                    <?php foreach ($criterions as $criteria) { ?>
                        <div class="desc-criterions__item">
                            <p class="desc-criterions__heading"><?php echo $criteria['название']; ?></p>
                            <?php echo $criteria['текст']; ?>
                        </div>
                    <?php } ?>
                </div>

            </div>

        </section>

        <section class="desc-notice">
            
            <div class="center-wrapper">
                
                <div class="desc-notice__wrapper">
                    <span class="desc-notice__star">*</span>
                    <?php echo get_field('уведомление'); ?>
                </div>

            </div>

        </section>

        <section class="desc-copyright">
            
            <div class="center-wrapper">
                
                <div class="desc-copyright__wrapper">
                    <?php echo get_field('права'); ?>
                </div>

            </div>

        </section>


<?php get_footer(); ?>
