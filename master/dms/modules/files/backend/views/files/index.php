<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>

<div class="card">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Folder</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Owner</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<5; $i++) : ?>
            <tr>
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <!-- <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3"> -->
                    <i class="fa fa-folder opacity-6 text-dark me-3"></i>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-secondary text-sm text-dark">Leap UK. Petra</h6>
                  </div>
                </div>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0">Dokumen-dokumen program leap (agung wibowo)</p>
              </td>

              <td>
                <p class="text-xs font-weight-bold mb-0">Mas Agung</p>
                <p class="text-xs text-secondary mb-0">mas@agung.com</p>
              </td>

              <td class="align-middle text-center text-sm">
                <p class="text-xs text-secondary mb-0">18 Jan 2023 11:00</p>
              </td>
            </tr>
        <?php endfor; ?>
        
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        

    });
</script>