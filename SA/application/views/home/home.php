<body onload="load()">
<div id="app">
  <div class="app-wrapper app-wrapper-web app-wrapper-main" data-reactroot="">
	<div class="app two" tabindex="-1">
	  <div class="chatlist-panel pane pane-one" id="side">
		<header class="pane-header pane-list-header">
		<div class="chat-avatar">
		  <div class="avatar icon-user-default" style="height: 40px; width: 40px;">
			<div class="avatar-body" title="<?php echo $this->session->userdata('nama'); ?>">
			  <img  class="avatar-image is-loaded" draggable="false" src="<?php echo base_url()?>tema/style/img/<?php echo $this->session->userdata('gambar'); ?>">
			</div>
		  </div>
		</div>
		<div class="chat-body">
			<div class="chat-main">
				<div class="menu-item" title="Script Apps">
				<a href="<?php echo base_url() ?>">
					<img class="avatar-image is-loaded" draggable="false" src="<?php echo base_url()?>tema/style/img/ScriptApps.png">
				</a>
				</div>
			</div>
		</div>
		<div class="pane-chat-controls">
    <div class="btn-group">
		<button  title="Menu" data-toggle="dropdown">
			<i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
		</button>

        <ul role="menu" class="dropdown-menu pull-right">
            <li><a href="#">Tambah Kontak</a></li>
            <li><a href="#">Hapus Kontak</a></li>
            <li><a href="#">Profile Setting</a></li>
            <li><a href="#" data-target="#modal-header-primary" data-toggle="modal">Qr-Code</a></li>
            <li><a href="#">Library</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url() ?>MyAcount/logout">Log Out</a></li>
        </ul>
    </div>
		</div>
		</header>
		<!-- Kolom Pencarian Start -->
		<div class="chatlist-panel-search" tabindex="-1">
			<div class="pane-subheader pane-list-subheader subheader-search">
				<button class="icon icon-search-morph">
					<i class="fa fa-search pull-right" aria-hidden="true"></i>
				</button>
				<div class="input-placeholder"></div>
				<label class="cont-input-search" for="input-chatlist-search">
				<input class="input input-search" placeholder="Cari Kontak Teman" title="Cari Kontak" type="text"></label>
			</div>
		</div>
		<!-- Kolom Pencarian End -->
		<!-- Kolom Kontak yang dimiliki Start -->
		<div class="chatlist-panel-body" data-list-scroll-container="true" id="pane-side">
		  <div data-tab="3" tabindex="-1">
		  	<div class="chatlist infinite-list">
		  	  	
<?php
$height = $banyak * 72;
?>
		  	  <div class="infinite-list-viewport" style="height: <?php echo $height ?>px;">		  	  	
<?php
$length = 0; 
foreach($kontak->result() as $row) {
if ($row->isnKontak == $this->session->userdata('isnKontak')) {

	$togle = '';
	$style = 'active';
}else{
	$style ='';
	$togle = 'data-target="#modal-prompt" data-toggle="modal"';
}
	?>
				<div class="infinite-list-item infinite-list-item-transition" <?php if($row->isnKontak == $this->session->userdata('hakAkses')){
					?>

					<?php
					}else{
					?>
						onclick="StartChat(<?php echo $row->isnKontak ?>)" <?php echo $togle; ?> 
					<?php
						} ?> style="z-index: 16; height: 72px; transform: translateY(<?php echo $length; ?>px);">
		  	  		<div class="chat-drag-cover" tabindex="-1">
		  	  			<div class="<?php echo $style; ?> chat">
		  	  				<div class="chat-avatar">
		  	  					<div class="avatar icon-user-default">
		  	  						<div class="avatar-body">
		  	  							<img class="avatar-image is-loaded" draggable="false" src="<?php echo base_url() ?>tema/style/img/<?php echo $row->gambar ?>">
		  	  						</div>
		  	  					</div>
		  	  				</div>
		  	  				<div class="chat-body">
		  	  					<div class="chat-main">
		  	  						<div class="chat-title">
		  	  							<span class="emojitext ellipsify" dir="auto" title="<?php echo $row->nama ?>"><?php echo $row->nama ?></span>
		  	  						</div>
		  	  						<div class="chat-meta">
		  	  							<span class="chat-time"><?php echo $this->session->userdata('hakAkses') ?></span>
		  	  						</div>
		  	  					</div>
		  	  					<div class="chat-secondary">
		  	  						<div class="chat-status" title="Cripto Make Us Happy">
		  	  							<span class="emojitext ellipsify" dir="ltr">Cripto Make Us Happy</span>
		  	  						</div>
		  	  					</div>
		  	  				</div>
		  	  			</div>
		  	  		</div>
		  	  	</div>
	<?php
	$length = $length + 72;
}
 ?>
		  	  </div>
		  	</div>
		  </div>
		</div>
		<!-- Kolom Kontak Yang dimiliki End -->
	</div>
<!--Modal Header Color Primary-->
<div id="modal-header-primary" tabindex="-1" role="dialog"
     aria-labelledby="modal-header-primary-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">My Qr-Code</h4></div>
            <div class="modal-body">
				<center>
	            	<img src="<?php echo base_url() ?>upload/user/<?php echo $this->session->userdata('qrcode'); ?>">	
				</center>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close
                </button>
            </div>
        </div>
    </div>
</div>