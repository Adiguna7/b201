<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Admin Dashboard | MAGE6</title>  
  

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
        <a class="nav-link collapsed" href="#">
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
                    <form action="<?=BASEURL?>/dashboard/additem" method="POST" enctype="multipart/form-data">
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
                            <select class="form-control" id="itemcategoryid" name="itemcategory" aria-placeholder="item_category">
                              <option disabled selected>item_category</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
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
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">item_id</th>
                    <th scope="col" class="text-center">item_name</th>
                    <th scope="col" class="text-center">item_description</th>
                    <th scope="col" class="text-center">item_image</th>
                    <th scope="col" class="text-center">item_stock</th>
                    <th scope="col" class="text-center">item_maxrent</th>
                    <th scope="col" class="text-center">item_charge</th>
                    <th scope="col" class="text-center">action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php                      
                      foreach($data['items'] as $item){
                      $i += 1;                      
                    ?>
                    <th scope="row" class="text-center"><?=$i?></th>
                    <td class="text-center"><?= $item['item_id'] ?></td>
                    <td class="text-center"><?= $item['item_name'] ?></td>
                    <td class="text-center"><?= $item['item_description'] ?></td>
                    <td class="text-center"><?= $item['item_image'] ?></td>
                    <td class="text-center"><?= $item['item_stock'] ?></td>
                    <td class="text-center"><?= $item['item_maxrent'] ?></td>
                    <td class="text-center"><?= $item['item_charge'] ?></td>
                    <td class="text-center">
                      <div class="row">
                        <div class="col-6">
                          <form action="<?=BASEURL?>dashboard/updateitem" method="POST">
                            <input type="hidden" name="itemid" value="<?=$item['item_id']?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>
                        </div>
                        <div class="col-6">
                          <form action="<?=BASEURL?>dashboard/deleteitem" method="POST">
                            <input type="hidden" name="itemid" value="<?=$item['item_id']?>">
                            <button type="submit" class="btn btn-primary">Delete</button>
                          </form>
                        </div>
                      </div>                                            
                    </td>
                    <?php
                      }                  
                    ?>
                  </tr>                  
                </tbody>
              </table>
            </div>
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