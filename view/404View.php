<?php

$session = SSession::getInstance();

if (isset($session->permissions)) {
    if ($session->permissions == 'T') {
        include_once 'public/headerProfessor.php';
    } else if ($session->permissions == 'S') {
        include_once 'public/headerStudent.php';
    } else if ($session->permissions == 'A') {
        include_once 'public/headerAdmin.php';
    } else if ($session->permissions == 'R') {
        include_once 'public/headerRoot.php';
    } else {
        include_once 'public/header.php';
    }
} else {
    include_once 'public/header.php';
}
?>
<section id="slider" class="slider-parallax swiper_wrapper full-screen">
    <div class="slider-parallax-inner">
        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark" style="background: url(public/images/landing/static.jpg) center;">
                    <div class="container vertical-middle center clearfix">
                        <div class="error404" style="color: white;">404</div>
                        <div class="heading-block nobottomborder">
                            <h4>Ooopps.! La página que estabas buscando no se pudo encontrar.</h4>
                            <span>Intenta más tarde</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

include_once 'public/footer.php';
