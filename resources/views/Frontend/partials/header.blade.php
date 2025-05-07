<!-- Header Wrap -->
<div id="site-header-wrap">


    <!-- Header -->
    <header id="site-header">
        <div id="site-header-inner" class="wprt-container">
            <div class="wrap-inner">
                <div id="site-logo" class="clearfix">
                    <div id="site-logo-inner">
                        <a href="home.html" title="CarBest" rel="home" class="main-logo"><img src="{{ asset('frontend/assets/img/logo.png') }}" width="202" height="52" alt="AutoServie" data-retina="assets/img/logo@2x.png" data-width="202" data-height="52"></a>
                    </div>
                </div><!-- #site-logo -->

                <div class="mobile-button"><span></span></div><!-- //mobile menu button -->

                <div id="header-aside">
                    <div class="header-aside-btn">
                        <a target="_blank" href="#"><span>RÉSERVEZ ICI</span></a>
                    </div>

                    <div class="header-info">
                        <div class="inner">
                            <div class="info-one">
                                <div class="info-wrap">
                                    <div class="info-i"><span><i class="rt-icon-chat2"></i></span></div>
                                    <div class="info-c"><span class="title">+1 718-999-3939</span><br><span class="subtitle">contact@autoser.com</span></div>
                                </div>
                            </div>

                            <div class="info-two">
                                <div class="info-wrap">
                                    <div class="info-i"><span><i class="rt-icon-alarm-clock"></i></span></div>
                                    <div class="info-c"><span class="title">8:00 - 17:30</span><br><span class="subtitle">Monday to Saturday</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /#header-aside -->
            </div>
        </div><!-- /#site-header-inner -->

        <div class="site-navigation-wrap">
            <div class="wprt-container inner">
                <nav id="main-nav" class="main-nav">
                    <ul id="menu-primary-menu" class="menu">
                        <li class="menu-item current-menu-item"><a href="/">ACCUEIL</a>

                        </li>

                        {{-- <li class="menu-item"><a href="#">NOS SERVICES</a>
                        </li> --}}

                        <li class="menu-item menu-item-has-children"><a href="{{ route('rendez-vous') }}">RENDEZ-VOUS ?</a>
                        </li>

                        <li class="menu-item"><a href="page-blog.html">A PROPOS</a></li>

                        <li class="menu-item"><a href="page-appointment.html">CONTACT</a></li>
                    </ul>
                </nav><!-- /#main-nav -->

                <ul class="nav-extend active">
                    {{-- <li class="ext c">
                        <a class="cart-info" href="#" title="View your shopping cart">6 items <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>260.00</span></a>
                    </li> --}}
                </ul><!-- /.nav-extend -->
{{--
                <div class="nav-top-cart-wrapper">
                    <a class="nav-cart-trigger" href="page-shop-cart.html">
                        <span class="cart-icon rt-icon-bag">
                            <span class="shopping-cart-items-count">6</span>
                        </span>
                    </a>

                    <div class="nav-shop-cart">
                        <div class="widget_shopping_cart_content">
                            <div class="woocommerce-min-cart-wrap">
                                <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        <a href="#" class="remove"><span class="fa fa-close"></span></a><a href="#">
                                            <img width="150" height="150" src="{{ asset('frontend/assets/img/shop/shop-item-150x150.jpg') }}" alt="Image">Advance Blue Oil Cans
                                        </a>

                                        <span class="quantity">1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>65.00</span></span>
                                    </li>

                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        <a href="#" class="remove"><span class="fa fa-close"></span></a><a href="#">
                                            <img width="150" height="150" src="{{ asset('frontend/assets/img/shop/shop-item-150x150.jpg') }}" alt="Image">Simple Blue Oil Cans
                                        </a>

                                        <span class="quantity">3 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>35.00</span></span>
                                    </li>

                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        <a href="#" class="remove"><span class="fa fa-close"></span></a><a href="#">
                                            <img width="150" height="150" src="{{ asset('frontend/assets/img/shop/shop-item-150x150.jpg') }}" alt="Image">Premium Blue Oil Cans
                                        </a>

                                        <span class="quantity">2 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>45.00</span></span>
                                    </li>
                                </ul>

                                <p class="woocommerce-mini-cart__total total"><strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>260.00</span></p>

                                <p class="woocommerce-mini-cart__buttons buttons"><a href="#" class="button wc-forward">View cart</a><a href="#" class="button checkout wc-forward">Checkout</a></p>
                            </div><!-- /.widget_shopping_cart_content -->
                        </div>
                    </div><!-- /.nav-shop-cart -->
                </div><!-- /.nav-top-cart-wrapper -->

                <div id="header-search">
                    <a class="header-search-icon" href="#"><span class="rt-icon-search2"></span></a>
                    <form role="search" method="get" class="header-search-form" action="#">
                        <label class="screen-reader-text">Search for:</label>
                        <input type="text" value="" name="s" class="header-search-field" placeholder="Type and hit enter...">
                        <button type="submit" class="header-search-submit" title="Search">Search</button>
                    </form>
                </div><!-- /#header-search --> --}}
            </div>
        </div><!-- /.site-navigation-wrap -->
    </header><!-- /#site-header -->
</div><!-- #site-header-wrap -->
