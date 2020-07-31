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
                        <h2>History</h2>
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
                                    <th>Charge</th>
                                    <th>Rent Start</th>
                                    <th>Rent End</th>
                                    <th>Status</th>                                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data['history'] as $history){                            
                                ?>

                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="<?=BASEURL?>img/items/<?=$history['item_image']?>" alt="">
                                        <h5><?=$history['item_name']?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$history['item_charge']?>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$history['transaksi_start']?>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$history['transaksi_end']?>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?=$history['transaksi_status']?>
                                    </td>                                                                                                                                                                                                                    
                                </tr>
                                
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <p>Apabila Status Waiting Silahkan Mengambil Barang di Lab B201 Dengan Membawa Jaminan KTP/KTM</p>
                        <?php
                        if(isset($data['latecharge']) && $data['latecharge'] != NULL){
                        ?>
                        <p style="color: red;">* <?=$data['latecharge']?></p>
                        <p style="color: red;">* Konsekuensi Apabila Barang dan Denda Tidak Dibayar Maka KTP/KTM Tidak Akan Bisa Diambil</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>                                
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->