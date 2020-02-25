</main>

    <footer class="footer">
        <div class="center-wrapper">
            <div class="footer__content">
                <div class="logo__wrapper">
                    <div class="logo__block"><img src="http://bestbim.pro/wp-content/uploads/2019/05/logof.png" alt="" class="logo"></div>
                </div>
                <div class="footer__block">
                    <div class="footer__info">
                        <div class="footer__title"><span>Организаторы конкурса:</span></div>
                        <div class="footer__text">
                            <p>Представительство GRAPHISOFT в России и СНГ</p>
                            <p>Официальный сайт: <strong><a href="http://graphisoft.ru" target="_blank">graphisoft.ru</a></strong></p>
                            <p>Загрузить ARCHICAD: <strong><a href="http://myarchicad.com" target="_blank">myarchicad.com</a></strong></p>
                            <p>Данные ответственного лица:</p>
                            <p>Специалист по образовательным программам</p>
                            <p>Калашникова Мария <strong><a href="mailto:mkalashnikova@graphisoft.com">mkalashnikova@graphisoft.com</a></strong></p>
                        </div>
                    </div>
                    <div class="footer__partners">
                        <div class="footer__title"><span>Партнеры</span></div>
                        <div class="footer__partners-icon__wrapper">
                            <?php
                            $partners_logos = get_field('партнеры', 2);
                            foreach ($partners_logos as $partners_logo) { ?>
                                <a href="<?php echo $partners_logo['ссылка'];?>" target="_blank">
                                    <div class="footer__partners-icon"><img src="<?php echo $partners_logo['лого'];?>" alt=""></div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="developer">
                            <a href="https://innite.ru" target="_blank"><b>Разработка сайта</b></a>
                            <a href="https://innite.ru" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/dev-logo.png"></a>
                        </div>
                    </div>
                </div>
                <div class="full-ver-link">
                    <a href="https://innite.ru" target="_blank"><b>Разработка сайта</b></a>
                    <a href="https://innite.ru" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/dev-logo.png"></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/es_LA/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php wp_footer(); ?>
    <script>
        $(document).ready(function() {
            $('#cabinet-form').validate({
                rules: {
                    category: {
                        required: true,
                    },
                    projectname: {
                        required: true,
                    },
                    projectdescription: {
                        required: true,
                    },
                    'project-file': {
                        required: true,
                    },
                    
                },
                messages: {
                    category: {
                        required: 'Пожалуйста выберите номинацию',
                    },
                    projectname: {
                        required: 'Пожалуйста укажите название проекта',
                    },
                    projectdescription: {
                        required: 'Пожалуйста укажите описание проекта',
                    },
                    'project-file': {
                        required: 'Пожалуйста укажите ссылку на облачное хранилище',
                    },

                }
            });
        });
    </script>
    <script>
        $( document ).ready(function()
        {
            $('#cabinet-form .form-group__section input[name=confirm]').change(function () {
                var form_submit = $('#cabinet-form .form-group__section button[type=submit]');
                if ($(this).is(':checked'))
                {
                    form_submit.removeClass('no_click');
                    //form_submit.attr('enabled', 'enabled');
                }
                else
                {
                    form_submit.addClass('no_click');
                    //form_submit.attr('disabled', 'disabled');
                }
            });

            $('#cabinet-form .form-group__section button[type=submit]').addClass('no_click');

        });
    </script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48675659 = new Ya.Metrika({
                    id:48675659,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48675659" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>

<style type="text/css">
    /* свойства модального окна по умолчанию */
.modal {
    position: fixed; /* фиксированное положение */
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0,0,0,0.5); /* цвет фона */
    z-index: 1050;
    opacity: 0; /* по умолчанию модальное окно прозрачно */
    -webkit-transition: opacity 200ms ease-in; 
    -moz-transition: opacity 200ms ease-in;
    transition: opacity 200ms ease-in; /* анимация перехода */
    pointer-events: none; /* элемент невидим для событий мыши */
    margin: 0;
    padding: 0;
}
/* при отображении модального окно */
.modal:target {
    opacity: 1; /* делаем окно видимым */
      pointer-events: auto; /* элемент видим для событий мыши */
    overflow-y: auto; /* добавляем прокрутку по y, когда элемент не помещается на страницу */
}
/* ширина модального окна и его отступы от экрана */
.modal-dialog {
    position: relative;
    width: auto;
    margin: 10px;
}
@media (min-width: 576px) {
  .modal-dialog {
      max-width: 500px;
      margin: 30px auto; /* для отображения модального окна по центру */
  }
}
/* свойства для блока, содержащего контент модального окна */ 
.modal-content {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
}
@media (min-width: 768px) {
  .modal-content {
      -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
      box-shadow: 0 5px 15px rgba(0,0,0,.5);
  }
}
/* свойства для заголовка модального окна */
.modal-header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 15px;
    border-bottom: 1px solid #eceeef;
}
.modal-title {
    margin-top: 0;
    margin-bottom: 0;
    line-height: 1.5;
    font-size: 1.25rem;
    font-weight: 500;
}
/* свойства для кнопки "Закрыть" */
.close {
    float: right;
    font-family: sans-serif;
    font-size: 24px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    text-decoration: none;
}
/* свойства для кнопки "Закрыть" при нахождении её в фокусе или наведении */
.close:focus, .close:hover {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    opacity: .75;
}
/* свойства для блока, содержащего основное содержимое окна */
.modal-body {
  position: relative;
    -webkit-box-flex: 1;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 15px;
    overflow: auto;
}

</style>
<div id="yspeh" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Загружено...</h3>
        <a href="#close" title="Close" class="close">×</a>
      </div>
      <div class="modal-body">    
        <p>Поздравляем! Проект успешно загружен и отображается в разделе Проекты! 
</p>
      </div>
    </div>
  </div>
</div>

