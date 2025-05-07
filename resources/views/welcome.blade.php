@extends('Frontend.layouts.app')


@section('content')

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <!-- SLIDER -->
                    <div class="rev_slider_wrapper fullwidthbanner-container" >
                        <div id="rev-slider1" class="rev_slider fullwidthabanner">
                            <ul>
                                <!-- Slide 1 -->
                                <li data-transition="random">
                                    <!-- Main Image -->
                                    <img src="{{ asset('frontend/assets/img/slider/slider-bg-1.jpg') }}" alt="" data-bgposition="center center" data-no-retina>

                                    <!-- Layers -->
                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-400"
                                        data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-130','-130','-125','-165']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="700"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        L'entretien auto arrive chez vous.
                                    </div>

                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-700"
                                        data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-62','-62','-62','-67']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        Simple, rapide, sans stress
                                    </div>

                                    <div class="tp-caption tp-resizeme text-white"
                                        data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['26','26','26','56']"
                                        data-fontsize="['16','16','16','15']"
                                        data-lineheight="['34','34','34','30']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">

                                        Réservez votre vidange ou entretien mécanique depuis chez vous. Notre équipe se déplace avec tout l'équipement nécessaire.

                                    </div>

                                    <div class="tp-caption"
                                        data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['115','115','110','167']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        <a href="page-contact.html" class="wprt-button accent big">RÉSERVER MAINTENANT</a>
                                    </div>
                                </li>
                                <!-- /End Slide 1 -->

                                <!-- Slide 2 -->
                                <li data-transition="random">
                                    <!-- Main Image -->
                                    <img src="{{ asset('frontend/assets/img/slider/slider-bg-2.jpg') }}" alt="" data-bgposition="center center" data-no-retina>

                                    <!-- Layers -->
                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-400 text-center"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-130','-130','-125','-165']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="700"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">

                                        PRIX COMPÉTITIFS

                                    </div>

                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-700 text-center"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-62','-62','-62','-67']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">

                                        GARANTIES À LONG TERME

                                    </div>

                                    <div class="tp-caption tp-resizeme text-white text-center"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['26','26','26','56']"
                                        data-fontsize="['16','16','16','15']"
                                        data-lineheight="['34','34','34','30']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">

                                        Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux : entretien des freins,<br> de l'échappement, mises au point, réparations du moteur, des systèmes électriques et de climatisation.

                                    </div>

                                    <div class="tp-caption text-center"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['115','115','110','167']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        <a href="page-contact.html" class="wprt-button accent big">RÉSERVER MAINTENANT</a>
                                    </div>
                                </li>
                                <!-- /End Slide 2 -->

                                <!-- Slide 3 -->
                                <li data-transition="random">
                                    <!-- Main Image -->
                                    <img src="{{ asset('frontend/assets/img/slider/slider-bg-3.jpg') }}" alt="" data-bgposition="center center" data-no-retina>

                                    <!-- Layers -->
                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-400 text-right"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-130','-130','-125','-165']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="700"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        MAÎTRE D'ENTRETIEN
                                    </div>

                                    <div class="tp-caption tp-resizeme text-white font-heading font-weight-700 text-right"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['-62','-62','-62','-67']"
                                        data-fontsize="['54','54','50','38']"
                                        data-lineheight="['64','64','60','48']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        & TECHNICIENS QUALIFIÉS
                                    </div>

                                    <div class="tp-caption tp-resizeme text-white text-right"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['26','26','26','56']"
                                        data-fontsize="['16','16','16','15']"
                                        data-lineheight="['34','34','34','30']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">

                                        Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux : entretien des freins, ,<br>  de l'échappement, mises au point, réparations du moteur, des systèmes électriques et de climatisation.
                                    </div>

                                    <div class="tp-caption text-right"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['middle','middle','middle','middle']" data-voffset="['115','115','110','167']"
                                        data-width="full"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                        data-mask_in="x:0px;y:[100%];"
                                        data-mask_out="x:inherit;y:inherit;"
                                        data-start="1000"
                                        data-splitin="none"
                                        data-splitout="none"
                                        data-responsive_offset="on">
                                        <a href="page-contact.html" class="wprt-button accent big">PRENDRE RENDEZ-VOUS</a>
                                    </div>
                                </li>
                                <!-- /End Slide 3 -->
                            </ul>
                        </div>
                    </div>
                    <!-- END SLIDER -->







                    <!-- 1 -->
                    <div class="row-services ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="33" data-mobi="40" data-smobi="40"></div>

                                    {{-- <div class="wprt-headings style-1 clearfix text-center">
                                        <h2 class="heading clearfix">NOS SERVICES</h2>
                                        <div class="sep clearfix"></div>
                                        <p class="sub-heading clearfix">Nos professionnels effectueront des tests de diagnostic, des vidanges et des remplissages de liquides, des remplacements de moteur, des changements d'huile et des révisions complètes du véhicule.</p>
                                    </div><!-- /.wprt-headings --> --}}

                                    <div class="wprt-spacer clearfix" data-desktop="30" data-mobi="30" data-smobi="30"></div>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-3">
                                    <div class="wprt-icon-box style-1 clearfix icon-top outline-type grey-outline align-center rounded-100 has-width w100">
                                        <div class="icon-wrap">
                                            <i class="as-icon-air-conditioning"></i>
                                        </div>

                                        <h3 class="heading">
                                            <a target="_blank" href="#">CLIMATISATION</a>
                                        </h3>

                                        <p class="desc">Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux. Entretien des freins, mises au point et réparations moteur.</p>

                                        {{-- <div class="elm-btn">
                                            <a target="_blank" class=" simple-link font-heading" href="#"></a>
                                        </div> --}}
                                    </div><!-- /.wprt-icon-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-icon-box style-1 clearfix icon-top outline-type grey-outline align-center rounded-100 has-width w100">
                                        <div class="icon-wrap">
                                            <i class="as-icon-electrical-service"></i>
                                        </div>

                                        <h3 class="heading">
                                            <a target="_blank" href="#">BOÎTE DE VITESSE</a>
                                        </h3>

                                        <p class="desc">Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux. Entretien des freins, mises au point et réparations moteur.</p>

                                        {{-- <div class="elm-btn">
                                            <a target="_blank" class=" simple-link font-heading" href="#">READ MORE</a>
                                        </div> --}}
                                    </div><!-- /.wprt-icon-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-icon-box style-1 clearfix icon-top outline-type grey-outline align-center rounded-100 has-width w100">
                                        <div class="icon-wrap">
                                            <i class="as-icon-disc-brake"></i>
                                        </div>

                                        <h3 class="heading">
                                            <a target="_blank" href="#">RÉPARATION DE FREINS</a>
                                        </h3>

                                        <p class="desc">Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux. Entretien des freins, mises au point et réparations moteur.</p>

                                        {{-- <div class="elm-btn">
                                            <a target="_blank" class=" simple-link font-heading" href="#">READ MORE</a>
                                        </div> --}}
                                    </div><!-- /.wprt-icon-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-icon-box style-1 clearfix icon-top outline-type grey-outline align-center rounded-100 has-width w100">
                                        <div class="icon-wrap">
                                            <i class="as-icon-air-filter2"></i>
                                        </div>

                                        <h3 class="heading">
                                            <a target="_blank" href="#">FILTRES AUTOMOBILES</a>
                                        </h3>

                                        <p class="desc">Nous offrons un service haut de gamme pour la réparation de véhicules importés et nationaux. Entretien des freins, mises au point et réparations moteur.</p>

                                        {{-- <div class="elm-btn">
                                            <a target="_blank" class=" simple-link font-heading" href="#">READ MORE</a>
                                        </div> --}}
                                    </div><!-- /.wprt-icon-box -->

                                </div><!-- /.col-md-3 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="104" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END 1 -->




                     <!-- SERVICES -->
                     <div class="row-services bg-light-grey ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="wprt-spacer clearfix" data-desktop="104" data-mobi="60" data-smobi="60"></div>

                                    <div class="wprt-headings style-1 clearfix">
                                        <h2 class="heading clearfix">TRUST OUR GARAGE</h2>
                                        <div class="sep clearfix"></div>
                                    </div><!-- /.wprt-headings -->

                                    <div class="wprt-spacer clearfix" data-desktop="30" data-mobi="25" data-smobi="25"></div>

                                    <div class="wprt-tabs clearfix style-1">


                                        <div class="tab-content-wrap">
                                            <div class="tab-content">
                                                <div class="item-content">
                                                    <p>At our AutoService garage, we fully appreciate how difficult it is for people to find reliable and trustworthy garages where they can service and repair their cars. We are always keen to prove to our customers that we are different!</p>

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We handle all makes and models and specialise in more than 40 car brands</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We are endorsed by the local trading standards office</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our mechanics and technicians are equipped with the latest portable technology</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our work has a minimum 12-month guarantee all services</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->
                                                </div>
                                            </div><!-- /.tab-content -->

                                            <div class="tab-content">
                                                <div class="item-content">
                                                    <p>At our AutoService garage, we fully appreciate how difficult it is for people to find reliable and trustworthy garages where they can service and repair their cars. We are always keen to prove to our customers that we are different!</p>

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We handle all makes and models and specialise in more than 40 car brands</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We are endorsed by the local trading standards office</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our mechanics and technicians are equipped with the latest portable technology</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our work has a minimum 12-month guarantee all services</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->
                                                </div>
                                            </div><!-- /.tab-content -->

                                            <div class="tab-content">
                                                <div class="item-content">
                                                    <p>At our AutoService garage, we fully appreciate how difficult it is for people to find reliable and trustworthy garages where they can service and repair their cars. We are always keen to prove to our customers that we are different!</p>

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We handle all makes and models and specialise in more than 40 car brands</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We are endorsed by the local trading standards office</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our mechanics and technicians are equipped with the latest portable technology</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our work has a minimum 12-month guarantee all services</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->
                                                </div>
                                            </div><!-- /.tab-content -->

                                            <div class="tab-content">
                                                <div class="item-content">
                                                    <h5>Trust Our Garage</h5>

                                                    <p>At our AutoService garage, we fully appreciate how difficult it is for people to find reliable and trustworthy garages where they can service and repair their cars. We are always keen to prove to our customers that we are different!</p>

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We handle all makes and models and specialise in more than 40 car brands</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">We are endorsed by the local trading standards office</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our mechanics and technicians are equipped with the latest portable technology</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->

                                                    <div class="wprt-list clearfix icon-left icon-top style-1">
                                                        <div class="inner">
                                                            <span class="icon-wrap">
                                                                <span class="icon"><i class="fa fa-check"></i></span>
                                                                <span class="text font-size-15">All our work has a minimum 12-month guarantee all services</span>
                                                            </span>
                                                        </div>
                                                    </div><!-- /.wprt-list -->
                                                </div>
                                            </div><!-- /.tab-content -->
                                        </div><!-- /.tab-content-wrap -->
                                    </div><!-- /.wprt-tabs -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-7 -->

                                <div class="col-md-5">
                                    <div class="wprt-spacer clearfix" data-desktop="20" data-mobi="10" data-smobi="10"></div>

                                    <img src="{{ asset('frontend/assets/img/technicial.png')}}" alt="Image" />
                                </div><!-- /.col-md-5 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END SERVICES -->





                    <!-- FACTS -->
                    <div class="row-facts bg-light-grey">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="55" data-mobi="50" data-smobi="50"></div>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-3">
                                    <div class="wprt-animation-block" data-animate="fadeInUpSmall" data-duration="1s" data-delay="0" data-position="80%">
                                        <div class="wprt-counter style-1 clearfix icon-top text-center">
                                            <div class="inner">
                                                <div class="icon-wrap">
                                                    <div class="icon"><i class="as-icon-mechanic"></i></div>
                                                </div>

                                                <div class="text-wrap">
                                                    <div class="number-wrap font-heading">
                                                        <span class="prefix"></span><span class="number accent" data-speed="3000" data-to="320" data-inviewport="yes">320</span><span class="suffix"></span>
                                                    </div>

                                                    <div class="sep"></div>
                                                    <h3 class="heading">EXPERIENCED TECHNICIALS</h3>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-counter -->
                                    </div><!-- /.wprt-animation-block -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-animation-block" data-animate="fadeInUpSmall" data-duration="1s" data-delay="0.15s" data-position="80%">
                                    <div class="wprt-counter style-1 clearfix icon-top text-center">
                                        <div class="inner">
                                            <div class="icon-wrap">
                                                <div class="icon"><i class="as-icon-key2"></i></div>
                                            </div>

                                            <div class="text-wrap">
                                                <div class="number-wrap font-heading">
                                                    <span class="prefix"></span><span class="number accent" data-speed="3000" data-to="100" data-inviewport="yes">100</span><span class="suffix">%</span>
                                                </div>

                                                <div class="sep"></div>
                                                <h3 class="heading">TRANSPARENCY MATTERS</h3>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-counter -->
                                    </div><!-- /.wprt-animation-block -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-animation-block" data-animate="fadeInUpSmall" data-duration="1s" data-delay="0.3s" data-position="80%">
                                    <div class="wprt-counter style-1 clearfix icon-top text-center">
                                        <div class="inner">
                                            <div class="icon-wrap">
                                                <div class="icon"><i class="as-icon-inspection"></i></div>
                                            </div>

                                            <div class="text-wrap">
                                                <div class="number-wrap font-heading">
                                                    <span class="prefix"></span><span class="number accent" data-speed="3000" data-to="9580" data-inviewport="yes">9580</span><span class="suffix"></span>
                                                </div>

                                                <div class="sep"></div>
                                                <h3 class="heading">COMPLETED PROJECTS</h3>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-counter -->
                                    </div><!-- /.wprt-animation-block -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-3">
                                    <div class="wprt-animation-block" data-animate="fadeInUpSmall" data-duration="1s" data-delay="0.45s" data-position="80%">
                                    <div class="wprt-counter style-1 clearfix icon-top text-center">
                                        <div class="inner">
                                            <div class="icon-wrap">
                                                <div class="icon"><i class="as-icon-diagnostic"></i></div>
                                            </div>

                                            <div class="text-wrap">
                                                <div class="number-wrap font-heading">
                                                    <span class="prefix"></span><span class="number accent" data-speed="3000" data-to="140" data-inviewport="yes">140</span><span class="suffix">+</span>
                                                </div>

                                                <div class="sep"></div>
                                                <h3 class="heading">PROFESSIONAL AWARDS</h3>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-counter -->
                                    </div><!-- /.wprt-animation-block -->
                                </div><!-- /.col-md-3 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="60" data-mobi="50" data-smobi="50"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END FACTS 1 -->



                     <!-- OFFERS -->
                    <div class="row-services">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="83" data-mobi="60" data-smobi="60"></div>

                                    <div class="wprt-headings style-1 clearfix text-center">
                                        <h2 class="heading clearfix">CE QUE NOUS OFFRONS</h2>
                                        <div class="sep clearfix"></div>
                                        <p class="sub-heading clearfix">Our professionals will perform diagnostic tests, fluid flush and fills, engine replacement, oil changes, and total vehicle overhauls.</p>
                                    </div><!-- /.wprt-headings -->

                                    <div class="wprt-spacer clearfix" data-desktop="45" data-mobi="30" data-smobi="30"></div>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-4">
                                    <div class="wprt-image-box style-1 clearfix text-center">
                                        <div class="item">
                                            <div class="inner">
                                                <div class="thumb"><img src="{{ asset('frontend/assets/img/services/service-4-600-394.jpg') }}" alt="Image"></div>

                                                <div class="text-wrap">
                                                    <h3 class="title"><a target="_blank" href="">CHECK ENGINE LIGHT</a></h3>

                                                    <div class="desc">We provide top-notch service for import and domestic car repairs. Servicing Brakes, Tune Ups</div>

                                                    {{-- <div class="elm-btn">
                                                        <a class="small wprt-button accent" href="#">READ MORE</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-image-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-4">
                                    <div class="wprt-image-box style-1 clearfix text-center">
                                        <div class="item">
                                            <div class="inner">
                                                <div class="thumb"><img src="{{ asset('frontend/assets/img/services/service-5-600-394.jpg') }}" alt="Image"></div>

                                                <div class="text-wrap">
                                                    <h3 class="title"><a target="_blank" href="">ELECTRICAL SYSTEM</a></h3>

                                                    <div class="desc">We provide top-notch service for import and domestic car repairs. Servicing Brakes, Tune Ups</div>

                                                    {{-- <div class="elm-btn">
                                                        <a class="small wprt-button accent" href="#">READ MORE</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-image-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="0" data-mobi="35" data-smobi="35"></div>
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-4">
                                    <div class="wprt-image-box style-1 clearfix text-center">
                                        <div class="item">
                                            <div class="inner">
                                                <div class="thumb"><img src="{{ asset('frontend/assets/img/services/service-6-600-394.jpg') }}" alt="Image"></div>

                                                <div class="text-wrap">
                                                    <h3 class="title"><a target="_blank" href="">OIL CHANGE & FILTER</a></h3>

                                                    <div class="desc">We provide top-notch service for import and domestic car repairs. Servicing Brakes, Tune Ups</div>

                                                    {{-- <div class="elm-btn">
                                                        <a class="small wprt-button accent" href="#">READ MORE</a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.wprt-image-box -->
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="90" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END OFFERS -->


                    <!-- CERTIFIED 1 -->
                    <div class="row-certified-1 parallax">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="120" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-2">
                                </div><!-- /.col-md-2 -->

                                <div class="col-md-9">
                                    <div class="wprt-animation-block" data-animate="fadeInUpSmall" data-duration="1s" data-delay="0s" data-position="90%">
                                        <div class="wprt-icon-box style-2 clearfix icon-left">
                                            <div class="image-wrap">
                                                <img src="{{ asset('frontend/assets/img/ase.png') }}" alt="Image">
                                            </div>

                                            <h3 class="heading">ASE CERTIFIED</h3>

                                            <p class="desc">Get in touch with our quality AutoService Shop, let our team of highly trained technicians provide you with the best car garage services, including MOT testing, car servicing and car repairs and diagnostics.</p>

                                            <div class="elm-btn">
                                                <a class=" wprt-button small outline white" href="#">SCHEDULE AN APPOINTMENT</a>
                                            </div>
                                        </div><!-- /.wprt-icon-box -->
                                    </div><!-- /.wprt-animation-block -->
                                </div><!-- /.col-md-9 -->

                                <div class="col-md-1">
                                </div><!-- /.col-md-1 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="120" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END CERTIFIED 1 -->




                       <!-- WHY US -->
                    <div class="row-why-us">
                        <div class="container-fluid" style="margin-top: 50px !important;">
                            <div class="row equalize sm-equalize-auto">
                                <div class="col-md-6 half-background style-1">
                                    <div class="wprt-icon style-1 clearfix background">
                                        <a class="icon-wrap popup-video" href="https://www.youtube.com/watch?v=-iN4ebYdsc4">
                                            <span class="icon"><i class="rt-icon-play-arrow"></i></span>
                                        </a>
                                    </div><!-- /.wprt-icon -->
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6">
                                    <div class="wprt-content-box clearfix" data-margin="10% 10% 10% 10%" data-mobimargin="8% 5% 10% 5%">
                                        <div class="col-md-12">
                                            <div class="wprt-headings style-1 clearfix">
                                                <h2 class="heading clearfix">WHY CHOOSE US?</h2>
                                                <div class="sep clearfix"></div>
                                                <p class="sub-heading clearfix">Our commitment to you is to provide honest, friendly, and on-time service. Visit a locally owned and operated business that has been serving the community since 1992.</p>
                                            </div><!-- /.wprt-headings -->

                                            <div class="wprt-spacer clearfix" data-desktop="40" data-mobi="40" data-smobi="40"></div>

                                            <div class="wprt-progress style-1 clearfix numb-grey height-4px">
                                                <h3 class="title">QUALITY SERVICES</h3>
                                                <div class="perc-wrap">
                                                    <div class="perc"><span>80%</span></div>
                                                </div>
                                                <div class="progress-bg" data-percent="80%" data-inviewport="yes">
                                                    <div class="progress-animate"></div>
                                                </div>
                                            </div><!-- /.wprt-progress -->

                                            <div class="wprt-spacer clearfix" data-desktop="35" data-mobi="35" data-smobi="35"></div>

                                            <div class="wprt-progress style-1 clearfix numb-grey height-4px">
                                                <h3 class="title">EXPERIENCED TECHNICIALS</h3>
                                                <div class="perc-wrap">
                                                    <div class="perc"><span>90%</span></div>
                                                </div>
                                                <div class="progress-bg" data-percent="90%" data-inviewport="yes">
                                                    <div class="progress-animate"></div>
                                                </div>
                                            </div><!-- /.wprt-progress -->

                                            <div class="wprt-spacer clearfix" data-desktop="35" data-mobi="35" data-smobi="35"></div>

                                            <div class="wprt-progress style-1 clearfix numb-grey height-4px">
                                                <h3 class="title">LONG TERM WARRANTY</h3>
                                                <div class="perc-wrap">
                                                    <div class="perc"><span>70%</span></div>
                                                </div>
                                                <div class="progress-bg" data-percent="70%" data-inviewport="yes">
                                                    <div class="progress-animate"></div>
                                                </div>
                                            </div><!-- /.wprt-progress -->
                                        </div><!-- /.col-md-12 -->
                                    </div><!-- /.wprt-content-box -->
                                </div><!-- /.col-md-6 -->
                            </div>
                        </div>
                    </div>
                    <!-- END WHY US -->


                      <!-- GALLERY -->
                    <div class="row-gallery">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="83" data-mobi="60" data-smobi="60"></div>

                                    <div class="wprt-headings style-1 clearfix text-center">
                                        <h2 class="heading clearfix">GALLERY PHOTOS</h2>
                                        <div class="sep clearfix"></div>
                                        <p class="sub-heading clearfix">Nos professionnels effectueront des tests de diagnostic, des vidanges et des remplissages de liquides, des remplacements de moteur, des changements d'huile et des révisions complètes du véhicule.</p>
                                    </div><!-- /.wprt-headings -->

                                    <div class="wprt-spacer clearfix" data-desktop="45" data-mobi="40" data-smobi="40"></div>

                                    <div class="wprt-gallery has-arrows arrow-center offsetcenter offset-v0" data-auto="false" data-column="3" data-column2="2" data-column3="1" data-gap="20"><div class="owl-carousel owl-theme">
                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                           <img src="{{ asset('frontend/assets/img/works/work-1-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-1-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">TUNE-UPS SYSTEM</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->

                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                        <img src="{{ asset('frontend/assets/img/works/work-2-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-2-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">ENGINE OIL CHANGE</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->

                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                        <img src="{{ asset('frontend/assets/img/works/work-3-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-3-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">CHECKING CAR ENGINE</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->

                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                        <img src="{{ asset('frontend/assets/img/works/work-4-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-4-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">AIR CONDITIONING</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->

                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                        <img src="{{ asset('frontend/assets/img/works/work-5-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-5-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">WHEEL ALIGNMENT</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->

                                        <div class="gallery-box">
                                            <div class="inner">
                                                <div class="hover-effect">
                                                    <div class="gallery-image">
                                                        <img src="{{ asset('frontend/assets/img/works/work-6-640x640.jpg') }}" alt="Image">
                                                    </div>

                                                    <div class="text">
                                                        <div class="icon">
                                                            <a class="zoom-popup" href="assets/img/works/work-6-full.jpg') }}"><i class="rt-icon-zoom-in-2"></i></a>
                                                        </div>
                                                        <h2><a href="#" title="#">CAR MAINTENANCE</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.gallery-box -->
                                    </div></div><!-- /.wprt-gallery -->

                                    <div class="wprt-spacer clearfix" data-desktop="50" data-mobi="40" data-smobi="40"></div>

                                    <div class="wprt-align-box text-center">
                                        <div class="button-wrap icon-left">
                                            <a href="#" class="wprt-button outline light">SEE FULL GALLERY</a>
                                        </div>
                                    </div>

                                    <div class="wprt-spacer clearfix" data-desktop="70" data-mobi="50" data-smobi="50"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END GALLERY -->


                    <!-- TESTIMONIALS -->
                    <div class="row-testimonials bg-light-grey">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="83" data-mobi="60" data-smobi="60"></div>

                                    <div class="wprt-headings style-1 clearfix text-center">
                                        <h2 class="heading clearfix">CLIENT TESTIMONIALS</h2>
                                        <div class="sep clearfix"></div>
                                        <p class="sub-heading clearfix">Our professionals will perform diagnostic tests, fluid flush and fills, engine replacement, oil changes, and total vehicle overhauls.</p>
                                    </div><!-- /.wprt-headings -->

                                    <div class="wprt-spacer clearfix" data-desktop="50" data-mobi="40" data-smobi="40"></div>

                                    <div class="wprt-carousel-box has-bullets bullet-circle" data-auto="true" data-loop="false" data-gap="25" data-column="3" data-column2="2" data-column3="1"><div class="owl-carousel owl-theme">
                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-1.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>Took the car in to have a noisy engine checked. They did a thorough check, found nothing untoward and, for good measure, updated all the engine management softwares. End result no cost. Brilliant!</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">JONATHAN AUERBACH</h6>
                                                            <span class="position">STRATEGY OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-2.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>I’ve been using this garage for a number of years to service both our cars. They are really good, they always have a slot available, work fast and have good prices. Would recommend them without reservations.</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">ALEXANDER BANFIELD</h6>
                                                            <span class="position">GROWTH OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-3.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>This is the second time I have used Quality Car Service and their service is great. Very polite staff who genuinely seem to care about your experience. Competitive pricing matched with this level of customer service!</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">AARON KACZMER</h6>
                                                            <span class="position">FINANCIAL OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-2.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>I’ve been using this garage for a number of years to service both our cars. They are really good, they always have a slot available, work fast and have good prices. Would recommend them without reservations.</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">ALEXANDER BANFIELD</h6>
                                                            <span class="position">GROWTH OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-1.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>Took the car in to have a noisy engine checked. They did a thorough check, found nothing untoward and, for good measure, updated all the engine management softwares. End result no cost. Brilliant!</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">JONATHAN AUERBACH</h6>
                                                            <span class="position">STRATEGY OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-2.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>I’ve been using this garage for a number of years to service both our cars. They are really good, they always have a slot available, work fast and have good prices. Would recommend them without reservations.</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">ALEXANDER BANFIELD</h6>
                                                            <span class="position">GROWTH OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->

                                        <div class="wprt-testimonials style-1 clearfix image-circle">
                                            <div class="item">
                                                <div class="inner">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/testimonials/customer-3.png') }}" alt="Image">
                                                    </div>

                                                    <blockquote class="text">
                                                        <p>This is the second time I have used Quality Car Service and their service is great. Very polite staff who genuinely seem to care about your experience. Competitive pricing matched with this level of customer service!</p>
                                                        <div class="name-pos">
                                                            <h6 class="name">AARON KACZMER</h6>
                                                            <span class="position">FINANCIAL OFFICER</span>
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div><!-- /.wprt-testimonials -->
                                    </div></div><!-- /.wprt-carousel-box -->

                                    <div class="wprt-spacer clearfix" data-desktop="70" data-mobi="40" data-smobi="40"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END TESTIMONIALS -->

                    <!-- PARTNERS -->
                    <div class="row-partner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer clearfix" data-desktop="60" data-mobi="40" data-smobi="30"></div>

                                    <div class="wprt-partner style-1 arrow-center offset30 offset-v0 has-arrows" data-auto="false" data-loop="false" data-column="5" data-column2="3" data-column3="2" data-gap="60"><div class="owl-carousel owl-theme">
                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-1.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-2.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-3.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-4.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-5.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-6.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-7.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="partner-item clearfix">
                                            <div class="inner">
                                                <a target="_blank" href="#">
                                                    <div class="thumb">
                                                        <img src="{{ asset('frontend/assets/img/partners/logo-8.png') }}" alt="Image">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div></div><!-- /.wprt-partner -->

                                    <div class="wprt-spacer clearfix" data-desktop="60" data-mobi="40" data-smobi="30"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div>
                    <!-- END PARTNERS -->


                    <!-- END PROMOTION -->
                </div><!-- /.page-content -->
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
    </div><!-- /#content-wrap -->
</div><!-- /#main-content -->

@endsection
