<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();

?>
<form class="form-material form-horizontal" id="app_form" action="#" method="POST">
    <?= Snl::chtml()->activeTextbox($model, 'form_id', array('class' => 'hidden')) ?>
    <div class="form-group">
        <label class="col-md-12"><?= $model->getLabel('form', TRUE); ?></label>
        <div class="col-md-12">
            <?= Snl::chtml()->activeTextbox($model, 'form') ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="table-form-type">
                  <thead>
                    <tr>
                      <th class="text-xs font-weight-bolder opacity-7 ps-0"><label>Jenis Form</label></th>
                      <th class="text-xs font-weight-bolder opacity-7"><label>&nbsp;</label></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if($form_type_data == NULL) : ?>
                    <tr>
                        <td><input type="text" class="form-control" name="Form[type][]" /></td>
                        <td>
                            <i class="fa fa-plus text-sm me-2 link-info append-form-type" role="button"></i>
                            <i class="fa fa-times text-sm me-2 link-danger remove-form-type" role="button"></i>
                        </td>
                    </tr>
                    <?php else : ?>
                        <?php foreach($form_type_data as $d) : ?>
                            <tr>
                                <td><input type="text" class="form-control" name="Form[type][]" value="<?= $d->jenis_peminjaman ?>" /></td>
                                <td>
                                    <i class="fa fa-plus text-sm me-2 link-info append-form-type" role="button"></i>
                                    <i class="fa fa-times text-sm me-2 link-danger remove-form-type" role="button"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
              </table>
          </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="submitform('app_form', 'Form')"><?= LabelHelper::getLabel('submit') ?></button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        var htmlElm = '';
        htmlElm += '<tr>';
            htmlElm += '<td><input type="text" class="form-control" name="Form[type][]" /></td>';
            htmlElm += '<td>';
                htmlElm += '<i class="fa fa-plus text-sm me-2 link-info append-form-type" role="button"></i>';
                    htmlElm += '<i class="fa fa-times text-sm me-2 link-danger remove-form-type" role="button"></i>';
            htmlElm += '</td>'
        htmlElm += '</tr>';


        $('body').on('click', '.append-form-type', function() {
            $('#table-form-type').find('tbody').append(htmlElm);
        });

        $('body').on('click', '.remove-form-type', function() {
            if($('#table-form-type').find('tbody').children().length > 1) {
                $(this).parent().parent().remove();    
            }
        });
    });

</script>