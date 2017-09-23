<?php foreach($kontak->result() as $row)?>
<div class="modal-header">
    <h4 id="modal-prompt-label" class="modal-title">Enter the Key for <?php echo $row->nama ?></h4></div>
        <div class="modal-body">
        <form method="POST" action="<?php echo base_url() ?>Home/openChat" >
                <input id="fullname" id="key" type="text" name="key" required class="form-control"/>
                <input type="hidden" id="isnKontak" name="isnKontak" value="<?php echo $row->isnKontak ?>" class="form-control"/>
                <br />
                <input class="btn btn-success pull-rigth" type="submit" class="form-control" value="Lanjutkan" />
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Close
            </button>
        </div>