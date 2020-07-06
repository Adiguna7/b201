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
                            <li><a href="<?=BASEURL?>home/category">Category</a>
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
                        <h2>Item Cart</h2>
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

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Item</th>
                                    <th>MaxRent</th>
                                    <th>Charge</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="<?=BASEURL?>img/items/<?=$data['item']['item_image']?>" alt="">
                                        <h5><?=$data['item']['item_name']?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$data['item']['item_maxrent']?>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$data['item']['item_charge']?>
                                    </td>                                            
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <?php
                        if(isset($data['sessionstatus']) && $data['sessionstatus'] == "pass"){
                        ?>
                        <form action="<?=BASEURL?>home/rentprocess" method="post">
                            <input type="hidden" name="userid" value="<?=$data['userid']?>">
                            <input type="hidden" name="itemid" value="<?=$data['item']['item_id']?>">
                            <button class="primary-btn cart-btn" type="submit" style="border: none;">CONTINUE</button>                                                
                        </form>
                        <?php
                        }
                        else{                        
                        ?>
                        <p>Silahkan Selesaikan Proses Peminjaman Anda Terlebih Dahulu Sebelum Meminjam Lagi</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>                                
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->