<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="<?=BASEURL?>img/logo.png" alt=""></a>
        </div>        
        <div class="humberger__menu__widget">            
            <div class="header__top__right__auth">
                <?php
                if(isset($data['user_name']) && $data['role'] == "user"){                                
                ?>
                <i class="fa fa-user"></i><span class="mx-2"><?=$data['user_name']?></span>                
                <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>
                <span><a href="<?=BASEURL?>logout" style="display: inline;">Logout</a></span>
                <?php
                }
                else{                                
                ?>
                <a href="<?=BASEURL?>login"><i class="fa fa-user"></i> Login</a>
                <?php
                }
                ?>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="<?=BASEURL?>home">Home</a></li>                            
                <li><a href="">Category</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="<?=BASEURL?>home/category/book">Book</a></li>
                        <li><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></li>
                        <li><a href="<?=BASEURL?>home/category/mouse">Mouse</a></li>
                        <li><a href="<?=BASEURL?>home/category/monitor">Monitor</a></li>                                                                        
                    </ul>
                </li>                            
                <li><a href="<?=BASEURL?>home/contact">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>                
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">                    
                    <div class="col-lg-12 col-md-12">
                        <div class="header__top__right">                                                        
                            <div class="header__top__right__auth">
                                <?php
                                if(isset($data['user_name']) && $data['role'] == "user"){                                
                                ?>
                                <i class="fa fa-user"></i><span class="mx-2"><?=$data['user_name']?></span>                                
                                <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>
                                <span><a href="<?=BASEURL?>logout" style="display: inline;">Logout</a></span>
                                <?php
                                }
                                else{                                
                                ?>
                                <a href="<?=BASEURL?>login"><i class="fa fa-user"></i> Login</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.html" class=""><img src="<?=BASEURL?>img/logo.png" class="img-fluid" alt="" style="max-height: 75px;"></a>
                    </div>
                </div>
                <div class="col-lg-10 d-flex align-items-center justify-content-end">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?=BASEURL?>home">Home</a></li>                            
                            <li><a href="<?=BASEURL?>home/category">Category</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="<?=BASEURL?>home/category/book">Book</a></li>
                                    <li><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></li>
                                    <li><a href="<?=BASEURL?>home/category/mouse">Mouse</a></li>
                                    <li><a href="<?=BASEURL?>home/category/monitor">Monitor</a></li>                                                                        
                                </ul>
                            </li>                            
                            <li><a href="<?=BASEURL?>home/contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>                            
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">            
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="<?=BASEURL?>img/hero/home4.png">
                        <div class="hero__text">
                            <span style="color:white">Help You</span>
                            <h2 style="color:white">For Ease of <br />  Your Project </h2>                            
                            <a href="<?=BASEURL?>home/category" class="primary-btn">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?=BASEURL?>img/categories/cat-1.png">
                            <h5><a href="<?=BASEURL?>home/category/book">Book</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?=BASEURL?>img/categories/cat-2.png">
                            <h5><a href="<?=BASEURL?>home/category/monitor">Monitor</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?=BASEURL?>img/categories/cat-3.png">
                            <h5><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?=BASEURL?>img/categories/cat-4.png">
                            <h5><a href="<?=BASEURL?>home/category/mouse">Mouse</a></h5>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" id="all" onclick="getdataitem('all')">All</li>
                            <li id="book" onclick="getdataitem('book')">Book</li>
                            <li id="monitor" onclick="getdataitem('monitor')">Monitor</li>
                            <li id="keyboard" onclick="getdataitem('keyboard')">Keyboard</li>
                            <li id="mouse" onclick="getdataitem('mouse')">Mouse</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" id="show-item">
                <!-- <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div id="item-image" class="featured__item__pic" style="background-image: url('<?=BASEURL?>img/logo.png'); background-size: cover;">                            
                            <ul class="featured__item__pic__hover">                                
                                <li><a id="item-info-link"><i class="fa fa-info"></i></a></li>                                
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6 id="item-name" >Crab Pool Security</h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>                 -->
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <script src="<?=BASEURL?>js/home.js"></script>