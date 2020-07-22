       
    <!-- background -->    

    <div class="background gradient-1" style="height: 100vh;">      

    <!-- akhir background -->

    <!-- form -->
      <div class="container">  
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 form shadow">
            <form class="text-center" method="POST" action="<?=BASEURL?>login/changepassword">
              <h1 class="header">Reset Password</h1>
              <p style="color: red;"><?= $data['error']?></p>
              <input type="hidden" name="csrf_token" value="<?= $data['csrf'] ?>">
              <input type="hidden" name="userid" value="<?= $data['user_id'] ?>">              
              <div class="form-group">
                <input
                  name="newpassword"
                  type="password"
                  class="form-control"
                  id="newpassword"
                  placeholder="New Password"
                  autocomplete="off"
                  maxlength="30"
                  required
                />
              </div>
              <div class="form-group">
                <input
                  name="retypepassword"
                  type="password"
                  class="form-control"
                  id="retypepassword"
                  placeholder="Retype New Password"
                  autocomplete="off"
                  maxlength="30"
                  required
                />
              </div>                            
              <button type="submit" class="btn gradient-2 mx-auto">
                Submit
              </button>                          
            </form>
          </div>
        </div>
      </div>
    <!-- akhir form -->
  </div>
