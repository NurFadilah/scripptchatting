			</div>			
		</div>
	</div>
</div>
<!--Modal Prompt-->
<div id="modal-prompt" tabindex="-1" role="dialog" aria-labelledby="modal-prompt-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    var objDiv = document.getElementById("messages");
	objDiv.scrollTop = objDiv.scrollHeight;
</script>
<script type="text/javascript">
function bottom() {
    var objDiv = document.getElementById("messages");
	objDiv.scrollTop = objDiv.scrollHeight;
}
</script>

<script src="<?php echo base_url()?>tema/admin/global/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/js/jquery-ui.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/js/html5shiv.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/js/respond.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/global/vendors/iCheck/custom.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/vendors/google-code-prettify/prettify.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/vendors/jquery.pulsate.js"></script>
<!--LOADING SCRIPTS FOR PAGE--><!--CORE JAVASCRIPT-->
<script src="<?php echo base_url()?>tema/admin/global/js/core.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/js/system-layout.js"></script>
<script src="<?php echo base_url()?>tema/admin/assets/js/jquery-responsive.js"></script>
<script>jQuery(document).ready(function () {
    "use strict";
    JQueryResponsive.init();
    Layout.init();
});
</script>
<script>jQuery(document).ready(function () {
    ui_modals.init();
});
</script>
    <script type="text/javascript">
     function StartChat (id) {
        var idx= id;
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url() ?>index.php/Home/pilihTeman',
            data   : 'id='+idx,
            success : function(msg){
            //  alert(msg);
                $(".modal-content").html(msg);
            }

        });
     }
var pesan = document.getElementById("pesan");
pesan.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
        kirim_pesan(e);
    }
});
    function kirim_pesan(e){
        var pesan = document.getElementById("pesan").value;
          if (pesan == '') {
            alert('silahkan masukan pesan anda');
          }else{
            // document.getElementById("hasil").innerHTML="<img src=\'<?php echo base_url();?>themes/tick.gif\'>";
            $.ajax({
              type      : 'POST',
              data      : 'pesan='+pesan,
              url       : '<?php echo base_url() ?>index.php/Home/SendMessage',
              success : function(msg){
                $("#pesan").val('');
                $(".monitoring").html(msg);
                    var objDiv = document.getElementById("messages");
                    objDiv.scrollTop = objDiv.scrollHeight;
                //$(".chatbox__body").slimScroll({start: "bottom", railVisible: true, alwaysVisible: true, height: '340px'});
              }
            }
                  );
          };
        }

    </script>
