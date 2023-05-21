<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>

<div class="card" >
    <div class="table-responsive" id="user_grid">
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var ajaxUrl = baseUrl + 'admin/form/search?ajax=1';
        $("#user_grid").jsGrid({
            width: "100%",
            filtering: true,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: pageSize,
            pageLoading: true,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete the user?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        dataType: "json",
                        type: "GET",
                        url: ajaxUrl,
                        data: filter
                    });
                },
            },
            fields: [{
                title: "Form",
                name: "form",
                type: "text",
            }, {
                title: "Dibuat Oleh",
                name: "created_by",
                type: "text",
            }, 
            {
                title: "Tanggal Dibuat",
                name: "created_on",
                type: "text",
            }, {
                title: "Diubah Oleh",
                name: "updated_by",
                type: "text",
            }, 
            {
                title: "Tanggal Diubah",
                name: "updated_on",
                type: "text",
            }, {
                type: "control",
                itemTemplate: function(value, item) {
                    var $editElm = "<a href='"+baseUrl+"admin/form/update?id="+item.form_id+"' title='Edit'><i class='fa fa-pencil'></i></a>&nbsp;";

                    var $deleteElm = '<a href="'+baseUrl+'admin/form/delete?id='+item.form_id+'" title="Delete" onclick="return confirm(\'Are you sure to delete this item?\')"><i class="fa fa-trash"></i></a>';
                    return $editElm + $deleteElm;
                }
            }]
        });

    });
</script>