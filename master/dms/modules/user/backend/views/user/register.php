<main class="main-content  mt-0">
  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg">
      <!-- <span class="mask bg-gradient-dark opacity-6"></span> -->
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="mb-2 mt-5">Welcome!</h1>
            <p class="text-lead">Use these awesome forms to login or create new account in your project for free.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Register</h5>
            </div>
            
            <div class="card-body">
              <form role="form text-left" id="app_form" action="#" method="POST">
                <div class="mb-3">
                  <?= Snl::app()->getFlashMessage() ?>
                  <?= Snl::chtml()->activeTextbox($model, 'email') ?>
                </div>
                <div class="mb-3">
                 <?= Snl::chtml()->activePassword($model, 'password') ?>
                </div>
                <div class="mb-3">
                 <?= Snl::chtml()->activePassword($model, 'password_repeat') ?>
                </div>
                <div class="mb-3">
                  <?= Snl::app()->getFlashMessage() ?>
                  <?= Snl::chtml()->activeTextbox($model, 'fullname') ?>
                </div>
                <div class="mb-3">
                  <?= Snl::app()->getFlashMessage() ?>
                  <?= Snl::chtml()->activeTextbox($model, 'phone') ?>
                </div>
               
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
                <div class="text-center">
                  <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2" onclick="submitform('app_form', 'User')">Daftar</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="javascript:;" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>