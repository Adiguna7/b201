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
                    <li class="active">Category
                        <ul class="header__menu__dropdown">
                            <li><a href="<?=BASEURL?>home/category/book">Book</a></li>
                            <li><a href="<?=BASEURL?>home/category/keyboard">Keyboard</a></li>
                            <li><a href="<?=BASEURL?>home/category/mouse">Mouse</a></li>
                            <li><a href="<?=BASEURL?>home/category/monitor">Monitor</a></li>                                                                        
                        </ul>
                    </li>                            
                <li class=""><a href="<?=BASEURL?>home/contact">Contact</a></li>
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
                            <li class="active"><a href="<?=BASEURL?>home/category">Category</a>
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
                <!-- <div class="col-lg-5">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">                                
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>                        
                    </div>  
                </div>                                 -->
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" data-setbg="<?=BASEURL?>img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?= $data['judul']?></h2>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row justify-content-center">                
                <div class="col-lg-9 col-md-7">
                    <div class="section-title product__discount__title">
                        <h2><?=$data['judul']?></h2>
                    </div>                    
                    <div class="filter__item">                        
                        <div class="row">                            
                            <div class="col-lg-6 col-md-5">
                                <div class="filter__found text-lg-left">
                                    <h6><span><?=$data['jumlah']?></span> Products found</h6>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        foreach ($data['items'] as $item) {                            
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=BASEURL?>img/items/<?=$item['item_image']?>" style="background-size: contain; background-repeat: no-repeat; background-position: center;">
                                    <ul class="product__item__pic__hover">                                                                                
                                        <li><a href="<?=BASEURL?>home/itemdetail/<?=$item['item_id']?>"><i class="fa fa-info"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="<?=BASEURL?>home/itemdetail/<?=$item['item_id']?>"><?=$item['item_name']?></a></h6>
                                    <!-- <h5>$30.00</h5> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>                                                
                    </div>
                    <!-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->