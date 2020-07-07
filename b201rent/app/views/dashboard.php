<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Admin Dashboard | B201Rent</title>  
  

  <!-- Custom styles for this template-->  
  <link href="<?=BASEURL?>css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=BASEURL?>css/bootstrap.min.css">     
  <link rel="stylesheet" href="<?=BASEURL?>css/font-awesome.min.css">    
  <link href="<?=BASEURL?>css/sb-admin-2.css" rel="stylesheet">  
  <link rel="shortcut icon" href="<?=BASEURL?>img/logo.png" type="image/x-icon">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #760933;">
      
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
      </a>
                      
      <hr class="sidebar-divider">
      
      <div class="sidebar-heading">
        User Controls
      </div>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=BASEURL?>dashboard/showitem">
            <i class="fas fa-toolbox"></i>
            <span>Table Item</span>
        </a>        
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=BASEURL?>dashboard/showhistory">
            <i class="fas fa-history"></i>
            <span>Table History</span>
        </a>        
      </li>

    </ul>    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars" style="color: #760933;"></i>
          </button>

          <!-- Topbar Search -->          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->                               
                        
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['user_name'] ?></span>                
              </a>                            
            </li>
            <li class="d-flex align-items-center">
              <form id="logout-form" action="<?=BASEURL?>logout" method="POST">                         
                <button type="submit" style="background-color: transparent; border: none;">Logout</button>
              </form>
            </li>

          </ul>

        </nav>
        
        <?php 
          if(isset($data['items'])){
            $i = 0;
        ?>            
        <div class="container">
          <div class="row">
            <div class="col-lg-12">

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?=BASEURL?>dashboard/additem" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                          <div class="form-group">                            
                            <input name="itemname" type="text" class="form-control" id="itemnameid" placeholder="item_name" required>
                          </div>
                          <div class="form-group">                            
                            <input name="itemdescription" type="text" class="form-control" id="itemdescriptionid" placeholder="item_description" required>
                          </div>
                          <div class="form-group">                            
                            <input name="itemimage" type="file" class="form-control-file" id="itemimageid" placeholder="item_image" required>
                          </div>
                          <div class="form-group">
                            <select class="form-control" id="itemcategoryid" name="itemcategory" aria-placeholder="item_category" required>
                              <option disabled selected>item_category</option>
                              <option>Book</option>
                              <option>Keyboard</option>
                              <option>Mouse</option>
                              <option>Monitor</option>                              
                            </select>
                          </div>
                          <div class="form-group">                            
                            <input name="itemstock" type="number" min="1" max="10" class="form-control" id="itemstockid" placeholder="item_stock" required>
                          </div>
                          <div class="form-group">                            
                            <input name="itemmaxrent" type="number" min="1" max="14" class="form-control" id="itemmaxrentid" placeholder="item_maxrent" required>
                          </div>
                          <div class="form-group">                            
                            <input name="itemcharge" type="number" min="1000" max="10000" step="500" class="form-control" id="itemchargeid" placeholder="item_charge" required>
                          </div>
                      </div>
                      <div class="modal-footer">                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>                        
                    </form>                                                                                 
                  </div>
                </div>
              </div>

              

            </div>
          </div>
          
          <div class="row mt-5">
            <div class="col-lg-12" style="overflow-x: auto;">
              <table class="table">                
                <thead class="thead-dark">
                  <tr>                    
                    <th scope="col" class="text-center">item_id</th>
                    <th scope="col" class="text-center">item_name</th>
                    <th scope="col" class="text-center">item_description</th>
                    <th scope="col" class="text-center">item_category</th>
                    <th scope="col" class="text-center">item_image</th>
                    <th scope="col" class="text-center">item_stock</th>
                    <th scope="col" class="text-center">item_maxrent</th>
                    <th scope="col" class="text-center">item_charge</th>
                    <th scope="col" class="text-center">action</th>
                  </tr>
                </thead>                
                <tbody>
                  <?php                      
                    foreach($data['items'] as $item){                    
                  ?>
                  <tr>                                        
                    <td class="text-center align-middle"><?= $item['item_id'] ?></td>
                    <td class="text-center align-middle"><?= $item['item_name'] ?></td>
                    <td class="text-center align-middle"><?= $item['item_description'] ?></td>
                    <td class="text-center align-middle"><?= $item['item_category'] ?></td>
                    <td class="text-center align-middle"><!-- Button trigger modal -->
                      <button type="button" class="btn p-0" data-toggle="modal" data-target="#imagemodal<?=$item['item_id']?>">
                      <?= $item['item_image'] ?>
                      </button>
                      <!-- Modal IMAGE-->
                      <div class="modal fade" id="imagemodal<?=$item['item_id']?>" tabindex="-1" role="dialog" aria-labelledby="modallabel<?=$item['item_id']?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="<?=BASEURL?>img/items/<?=$item['item_image']?>" srcset="" class="img-fluid">
                              </div>                              
                            </div>
                          </div>
                        </div>
                    </td>
                    <td class="text-center align-middle"><?= $item['item_stock'] ?></td>
                    <td class="text-center align-middle"><?= $item['item_maxrent'] ?></td>
                    <td class="text-center align-middle"><?= $item['item_charge'] ?></td>
                    <td class="text-center align-middle">
                      <div class="row">
                        <div class="col-12">                                                      
                          <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#modalupdate" style="padding: 5px 3px;">Update</button>
                          
                          <!-- Modal UPDATE -->
                          <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="modalupdatelabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalupdatelabel">Update Item <?=$item['item_id']?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="<?=BASEURL?>dashboard/updateitem" method="POST" enctype="multipart/form-data">
                                  <div class="modal-body">
                                      <div class="form-group">                            
                                        <input name="itemname" type="text" class="form-control" id="itemnameid" placeholder="item_name" value="<?=$item['item_name']?>" required>
                                      </div>
                                      <div class="form-group">                            
                                        <input name="itemdescription" type="text" class="form-control" id="itemdescriptionid" placeholder="item_description" value="<?=$item['item_description']?>" required>
                                      </div>
                                      <div class="form-group">                            
                                        <input name="itemimage" type="file" class="form-control-file" id="itemimageid" placeholder="item_image">
                                      </div>
                                      <div class="form-group">
                                        <select class="form-control" id="itemcategoryid" name="itemcategory" aria-placeholder="item_category" required>                                          
                                          <option disabled>item_category</option>                                          
                                          <option <?php if($item['item_id'] == "book"){echo "selected";}?> >Book</option>
                                          <option <?php if($item['item_id'] == "keyboard"){echo "selected";}?>>Keyboard</option>
                                          <option <?php if($item['item_id'] == "mouse"){echo "selected";}?>>Mouse</option>
                                          <option <?php if($item['item_id'] == "monitor"){echo "selected";}?>>Monitor</option>                              
                                        </select>
                                      </div>
                                      <div class="form-group">                            
                                        <input name="itemstock" type="number" min="1" max="10" class="form-control" id="itemstockid" placeholder="item_stock" value="<?=$item['item_stock']?>" required>
                                      </div>
                                      <div class="form-group">                            
                                        <input name="itemmaxrent" type="number" min="1" max="14" class="form-control" id="itemmaxrentid" placeholder="item_maxrent" value="<?=$item['item_maxrent']?>" required>
                                      </div>
                                      <div class="form-group">                            
                                        <input name="itemcharge" type="number" min="1000" max="10000" step="500" class="form-control" id="itemchargeid" placeholder="item_charge" value="<?=$item['item_charge']?>" required>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="hidden" name="itemid" value="<?= $item['item_id'] ?>">
                                    <input type="hidden" name="itemimagename" value="<?= $item['item_image'] ?>">                        
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>                        
                                </form>                                                                                 
                              </div>
                            </div>
                          </div>                          
                        </div>                                                

                        <div class="col-12 mt-1">
                          <form action="<?=BASEURL?>dashboard/deleteitem" method="POST">
                            <input type="hidden" name="itemid" value="<?=$item['item_id']?>">
                            <input type="hidden" name="itemimage" value="<?=$item['item_image']?>">
                            <button type="submit" class="btn btn-success w-100" style="padding: 5px 3px;">Delete</button>
                          </form>
                        </div>
                      </div>                                            
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
        <?php
        }              
      elseif(isset($data['history'])){
      ?>
       <div class="row mt-5">      
            <div class="col-lg-12" style="overflow-x: auto;">
              <table class="table">                
                <thead class="thead-dark">
                  <tr>                    
                    <th scope="col" class="text-center">item_id</th>
                    <th scope="col" class="text-center">user_name</th>
                    <th scope="col" class="text-center">item_name</th>
                    <th scope="col" class="text-center">item_category</th>
                    <th scope="col" class="text-center">transaksi_start</th>
                    <th scope="col" class="text-center">transaksi_end</th>
                    <th scope="col" class="text-center">transaksi_status</th>                    
                    <th scope="col" class="text-center">action</th>
                  </tr>
                </thead>                
                <tbody>
                  <?php
                  foreach($data['history'] as $history){                  
                  ?>                  
                  <tr>                                        
                    <td class="text-center align-middle"><?=$history['item_id']?></td>
                    <td class="text-center align-middle"><?=$history['user_name']?></td>
                    <td class="text-center align-middle"><?=$history['item_name']?></td>
                    <td class="text-center align-middle"><?=$history['item_category']?></td>
                    <td class="text-center align-middle"><?=$history['transaksi_start']?></td>
                    <td class="text-center align-middle"><?=$history['transaksi_end']?></td>
                    <td class="text-center align-middle"><?=$history['transaksi_status']?></td>                    
                    <td class="text-center align-middle">                      
                        <?php
                        if($history['transaksi_status'] == "waiting"){
                        ?>
                        <form action="<?=BASEURL?>dashboard/verifrent" method="post">
                        <input type="hidden" name="transaksiid" value="<?=$history['transaksi_id']?>">                        
                        <button type="submit" class="btn btn-success">Verif Rent</button>
                        </form>
                        <?php
                        }
                        elseif($history['transaksi_status'] == "rent"){                        
                        ?>
                        <form action="<?=BASEURL?>/dashboard/verifdone" method="post">
                        <input type="hidden" name="transaksiid" value="<?=$history['transaksi_id']?>">                        
                        <button type="submit" class="btn btn-danger">Verif Done</button>
                        </form>
                        <?php
                        }
                        ?>                      
                    </td>                    
                  </tr>
                  <?php
                  }
                  ?>                                    
                </tbody>
              </table>
            </div>
          </div>         
      <?php 
      }
      ?>
        
      </div>      

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>&copy; B201RENT 2020</span>
          </div>
        </div>
      </footer>      

    </div>    

  </div> 
      

  
  <script src="<?=BASEURL?>js/jquery-3.4.1.min.js"></script>
  <script src="<?=BASEURL?>js/bootstrap.min.js"></script>
  <script src="<?=BASEURL?>js/all.min.js"></script>
  <script src="<?=BASEURL?>js/sb-admin-2.min.js"></script>  
</body>

</html>