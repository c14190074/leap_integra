<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>

<input type="hidden" id="folder_parent_name" value="<?= $folder_parent != NULL ? ucwords(strtolower($folder_parent->name)) : '' ?>" />
<input type="hidden" id="folder_id" value="<?= $folder_id ?>" />


<?php if(count($local_breadcrumbs) > 0) : ?>
<nav aria-label="breadcrumb" class="p-3 pt-0">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 px-0 me-sm-6 me-5 pt-0">
    <?php foreach($local_breadcrumbs as $data) : ?>
      <?php if(end($local_breadcrumbs) == $data) : ?>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $data['name'] ?></li>
      <?php else : ?>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $data['url'] ?>"><?= $data['name'] ?></a></li>
      <?php endif; ?>
      
    <?php endforeach; ?>    
  </ol>
</nav>
<?php endif; ?>

<div class="row mb-4 hidden">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
      <input type="text" class="form-control" id="input-search" placeholder="Cari file atau folder.." onfocus="focused(this)" onfocusout="defocused(this)">
    </div>  
  </div>

  <div class="col-md-3">
      <button type="button" class="btn btn-primary mb-0" id="advanced-search">Cari disemua folder</button>
  </div>
</div>

<?php if($model == NULL || Folder::countNumberOfFile($model) == 0) : ?>
  <p class="text-sm text-secondary p-3">No file or folder</p>

<?php else : ?>
<div class="card" id="folder_list">
  <div class="table-responsive">
    <table class="table align-items-center mb-0" id="table-data">
      <thead>
        <tr>
          <th class="pe-0 ps-3"><input type="text" class="form-control type-enter" id="search-name" placeholder="Nama" /></th>
          <th class="pe-0 ps-1"><input type="text" class="form-control type-enter" id="search-nomor" placeholder="Nomor" /></th>
          <th class="pe-0 ps-1"><input type="text" class="form-control type-enter" id="search-perihal" placeholder="Perihal" /></th>
          <th class="pe-0 ps-1"><input type="text" class="form-control type-enter" id="search-email" placeholder="Email" /></th>
          <th class="pe-3 ps-1">
            <input type="date" class="form-control me-2 w-70 float-start" id="search-date" placeholder="Tanggal" />

            <button class="btn btn-icon btn-2 btn-primary mb-0" type="button" id="btn-search">
              <i class="fa fa-search"></i>
            </button>
          </th>
        </tr>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Akses</th>
          <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keywords</th> -->
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <!--  DIISI LEWAT AJAX -->
        
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<hr />

<script type="text/javascript">
    $(document).ready(function() {
      if($("#folder_parent_name").val() != "") {
        $("#page_subtitle").html($("#folder_parent_name").val());
      }

      var folder_id = $('#folder_id').val();
      var getDataUrl = baseUrl + 'admin/files/getData?ajax=1&folder='+folder_id;

      $.ajax({
        url: getDataUrl,
      })
      .done(function( data ) {
        $('#folder_list').find('tbody').html(data);
      
      });

      $('body').on('click', '#btn-search', function() {
          var name = $('#search-name').val();
          var nomor = $('#search-nomor').val();
          var perihal = $('#search-perihal').val();
          var email = $('#search-email').val();
          var date = $('#search-date').val();

          getDataUrl = baseUrl + 'admin/files/getData?ajax=1&folder='+folder_id+'&name='+name+'&nomor='+nomor+'&perihal='+perihal+'&email='+email+'&date='+date;

          $.ajax({
            url: getDataUrl,
          })
          .done(function( data ) {
            $('#folder_list').find('tbody').html(data);
          });
      });

      $('body').on('keyup', '.type-enter', function(e) {
        var code = e.key;
        if(code == 'Enter') {
          var name = $('#search-name').val();
          var nomor = $('#search-nomor').val();
          var perihal = $('#search-perihal').val();
          var email = $('#search-email').val();
          var date = $('#search-date').val();

          getDataUrl = baseUrl + 'admin/files/getData?ajax=1&folder='+folder_id+'&name='+name+'&nomor='+nomor+'&perihal='+perihal+'&email='+email+'&date='+date;

          $.ajax({
            url: getDataUrl,
          })
          .done(function( data ) {
            $('#folder_list').find('tbody').html(data);
          });
        }
      });

    });
</script>