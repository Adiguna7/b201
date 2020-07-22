       
    <!-- background -->    

    <div class="background gradient-1" style="height: 100vh;">      

    <!-- akhir background -->

    <!-- form -->
      <div class="container">  
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 form shadow">
            <form class="text-center" method="POST" action="<?=BASEURL?>login/sendemailforgot">
              <h1 class="header">Forgot Password</h1>
              <p style="color: red;"><?= $data['error']?></p>
              <input type="hidden" name="csrf_token" value="<?= $data['csrf'] ?>">
              <div class="form-group">
                <input
                  name="email"
                  type="text"
                  class="form-control"
                  id="email"
                  placeholder="Email"
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
