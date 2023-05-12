<?php
/**
 * Шаблон по умолчанию для страницы
 */
ct()->header();
?>
    <main>
        <section class="school-intro submenu-mobile-container" id="intro">
            <div class="page-intro container">
                <h1 class="page-intro__title title title--h1">
					<?php the_title() ?>
                </h1>

                <div class="page-intro__text">
					<?php the_content() ?>
                </div>
            </div>
        </section>
    </main>

<?php
ct()->footer();
