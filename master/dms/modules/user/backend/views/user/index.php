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
        var ajaxUrl = baseUrl + 'admin/user/search?ajax=1';
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
                title: "Email",
                name: "email",
                type: "text",
            }, {
                title: "Nama",
                name: "fullname",
                type: "text",
            }, {
                title: "Phone",
                name: "phone",
                type: "text",                
            }, {
                title: "Status",
                name: "status",
                type: "select",
                items: [
                    { text: "", value: "" },
                    { text: "Active", value: "1" },
                    { text: "Inactive", value: "0" },
                ],
                valueField: "value",
                textField: "text"
            }, {
                title: "Email Status",
                name: "status_email",
                type: "select",
                items: [
                    { text: "", value: "" },
                    { text: "Verified", value: "1" },
                    { text: "Not Verified", value: "0" },
                ],
                valueField: "value",
                textField: "text"
            }, {
                type: "control",
                itemTemplate: function(value, item) {
                    var $editElm = "<a href='"+baseUrl+"admin/user/update?id="+item.user_id+"' title='Edit'><i class='fa fa-pencil'></i></a>&nbsp;";

                    var $deleteElm = '<a href="'+baseUrl+'admin/user/delete?id='+item.user_id+'" title="Delete" onclick="return confirm(\'Are you sure to delete this item?\')"><i class="fa fa-trash"></i></a>';
                    return $editElm + $deleteElm;
                }
            }]
        });

    });
</script>