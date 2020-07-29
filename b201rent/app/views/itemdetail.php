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
            <span><a href="<?=BASEURL?>logout" style="display: inline;">Logout</a></span>
            <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>
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
                                <i class="fa fa-user"></i><span class="mx-2"><?=$data['user_name']?></span>
                                <span><a href="<?=BASEURL?>logout" style="display: inline;">Logout</a></span>
                                <span><a href="<?=BASEURL?>home/history" style="display: inline;">History</a></span>
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
                            <li class=""><a href="<?=BASEURL?>home/contact">Contact</a></li>
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
                        <h2><?=$data['itemsingle']['item_name']?></h2>
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

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="<?=BASEURL?>img/items/<?=$data['itemsingle']['item_image']?>" alt="">
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?=$data['itemsingle']['item_name']?></h3>                        
                        <!-- <div class="product__details__price">$50.00</div> -->
                        <p><?=$data['itemsingle']['item_description']?></p>   
                        <?php
                        if(isset($_SESSION['user_name']) && $_SESSION['role'] == "user"){
                            if($data['itemsingle']['item_stock'] == 0){                                             
                        ?>
                            <p style="color: #a32a26;">Barang Sedang Dalam Peminjaman / Out Of Stock</p>
                            <?php
                            }
                            else{                            
                            ?>
                            <a href="<?=BASEURL?>home/cart/<?=$data['itemsingle']['item_id']?>" class="primary-btn">RENT</a>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        else{                        
                        ?>
                        <p style="color: #a32a26;">Silahkan Login Terlebih Dahulu Untuk Dapat Meminjam</p>                        
                        <?php
                        }
                        ?>
                        <ul>
                            <li><b>Category</b> <span><?=$data['itemsingle']['item_category']?></span></li>
                            <li><b>Availability</b> <span><?=$data['itemsingle']['item_stock']?></span></li>
                            <li><b>Max Rent</b> <span><?=$data['itemsingle']['item_maxrent']?> day</span></li>
                            <li><b>Late Charge</b><span><?=$data['itemsingle']['item_charge']?> / day</span></li>                            
                        </ul>
                    </div>
                </div>                
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <?php
    if($data['relateditems']){    
    ?>
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Items</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
            foreach ($data['relateditems'] as $item) {                            
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
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
        </div>
    </section>
    <?php
    }
    ?>
    <!-- Related Product Section End -->