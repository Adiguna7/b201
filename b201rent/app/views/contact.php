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
            <form action="<?=BASEURL?>logout" method="post">
                <i class="fa fa-user"></i><span class="mx-2"><?=$data['user_name']?></span>                
                <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>                
                <input type="hidden" name="csrf_token" value="<?=$data['csrf']?>" />
                <span><button type="submit" style="display: inline; border:none; background-color: transparent; font-size: 14px;" >Logout</button></span>
            </form>
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
                <li><a href="<?=BASEURL?>home">Home</a></li>                            
                    <li><a href="<?=BASEURL?>home/category/">Category</a>
                        <ul class="header__menu__dropdown">
                            <li><a href="<?=BASEURL?>home/category/book">Book</a></li>
                            <li><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></li>
                            <li><a href="<?=BASEURL?>home/category/mouse">Mouse</a></li>
                            <li><a href="<?=BASEURL?>home/category/monitor">Monitor</a></li>                                                                        
                        </ul>
                    </li>                            
                <li class="active"><a href="<?=BASEURL?>home/contact">Contact</a></li>
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
                                <form action="<?=BASEURL?>logout" method="post">
                                    <i class="fa fa-user"></i><span class="mx-2"><?=$data['user_name']?></span>                
                                    <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>                
                                    <input type="hidden" name="csrf_token" value="<?=$data['csrf']?>" />
                                    <span><button type="submit" style="display: inline; border:none; background-color: transparent; font-size: 14px;" >Logout</button></span>
                                </form>
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
                        <a href="./index.html" class=""><img src="<?=BASEURL?>img/logo.png" alt="" class="img-fluid" alt="" style="max-height: 75px;"></a>
                    </div>
                </div>
                <div class="col-lg-10 d-flex align-items-center justify-content-end">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="<?=BASEURL?>home">Home</a></li>                            
                            <li><a href="<?=BASEURL?>home/category">Category</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="<?=BASEURL?>home/category/book">Book</a></li>
                                    <li><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></li>
                                    <li><a href="<?=BASEURL?>home/category/mouse">Mouse</a></li>
                                    <li><a href="<?=BASEURL?>home/category/monitor">Monitor</a></li>                                                                        
                                </ul>
                            </li>                            
                            <li class="active"><a href="<?=BASEURL?>home/contact">Contact</a></li>
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
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" data-setbg="<?=BASEURL?>img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>085961160000</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>B Building 201 Electrical Faculty ITS</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>8:00 am to 3:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>b201@its.ac.id</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.35073125955637!2d112.79644474174034!3d-7.28494407372284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa6d308b7b91%3A0xfa255422237d84eb!2sDepartemen%20Teknik%20Komputer%20FTE%20ITS!5e0!3m2!1sid!2sid!4v1593713227263!5m2!1sid!2sid"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>B201 Laboratory ITS</h4>
                <ul>
                    <li>Phone: 085961160000</li>
                    <li>Add: B Building 201 Electrical Faculty ITS</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->    