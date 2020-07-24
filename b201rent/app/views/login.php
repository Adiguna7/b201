       
    <!-- background -->    
    <div id="particles"></div> 

    <div class="background gradient-1">      

    <!-- akhir background -->

    <!-- form -->
      <div class="container">  
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 form shadow">
            <form class="text-center" method="POST" action="<?=BASEURL?>login/loginaccount">
              <h1 class="header">Login</h1>
              <p style="color: red;"><?= $data['error']?></p>
              <input type="hidden" name="csrf_token" value="<?= $data['csrf'] ?>">
              <div class="form-group">
                <input
                  name="name"
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Name"
                  autocomplete="off"
                  maxlength="20"
                  required
                />
              </div>              
              <div class="form-group">
                <input
                  name="password"
                  type="password"
                  class="form-control"
                  id="password"
                  placeholder="Password"                  
                  required
                />
              </div>
              <div class="form-group">
                <img class="img-fluid" src="<?=$data['captcha']?>" alt="" srcset="">
                <div class="row justify-content-center">
                  <div class="col-6">
                    <input type="text" minlength="5" maxlength="5" name="<?=$data['captcha_name']?>" id="" placeholder="Verify Captcha" class="form-control mt-3">
                  </div>
                </div>                
              </div>
              <button type="submit" class="btn gradient-2 mx-auto">
                Submit
              </button>              
              <p>No Account Yet? <a href="<?=BASEURL?>register">Register</a></p>
              <p>Forgot Password? <a href="<?=BASEURL?>login/forgotpassword">Reset</a></p>
            </form>
          </div>
        </div>
      </div>
    <!-- akhir form -->
  </div>
