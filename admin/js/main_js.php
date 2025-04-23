<script>
/* ==================================================PHP AJAX================================================== */

function fn_status_change(id){
    $.ajax({
        type: 'POST',
        url: '<?=($_SERVER['PHP_SELF'])?>',
        data: {status_ajax_request: 'true', id: id},
        cache: false,
        dataType: 'json',           
        success: function(data) {
            //For Alert Popups
            data.status = (data.status == "error" ? "danger" : data.status);
            var title = (data.status == "success" ? "Success!" : "Oh Snap!");
            notification(title, data.msg, data.status);
            if(data.status == 'success'){                
                if(data.res_data.status == "1"){
                    $('#status_'+data.res_data.id).attr("checked");
                }else{
                    $('#status_'+data.res_data.id).removeAttr("checked");
                }
                

            }
        },
        error: function(data) {
            console.log(data);
        }      
    });
}

/* ==================================================END JS CODE================================================== */

</script>