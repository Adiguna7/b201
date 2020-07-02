       
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
              <button type="submit" class="btn gradient-2 mx-auto">
                Submit
              </button>              
              <p>Already Have Account? <a href="<?=BASEURL?>register">Register</a></p>
            </form>
          </div>
        </div>
      </div>
    <!-- akhir form -->
  </div>
