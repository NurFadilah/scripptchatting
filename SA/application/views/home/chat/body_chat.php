<?php foreach($identitas->result() as $row) {} 	?>
<div class="pane pane-chat pane-two" id="main">
	<div class="pane-chat-tile"></div>
	<!-- Start Header Of Kontak whichus choose -->
	<header class="pane-header pane-chat-header">
		<div class="chat-avatar">
			<div class="avatar icon-user-default" style="height: 40px; width: 40px;">
				<div class="avatar-body"><img class="avatar-image is-loaded" draggable="false" src="<?php echo base_url()?>tema/style/img/<?php echo $row->gambar?>"></div>
			</div>
		</div>
		<div class="chat-body">
			<div class="chat-main">
				<h2 class="chat-title" dir="auto">
					<span class="emojitext ellipsify" dir="auto" title="nur fadilah"><?php echo $row->nama;?></span>
				</h2>
			</div>
		</div>
    <div class="btn-group">
		<button  title="Menu" data-toggle="dropdown">
			<i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
		</button>

        <ul role="menu" class="dropdown-menu pull-right">
            <li><a href="#">Ping</a></li>
            <li><a href="#">Forward</a></li>
            <li class="divider"></li>
            <li><a href="#">Keluar</a></li>
        </ul>
    </div>
	</header>
	<!-- End Header Of Kontak whichus choose -->

	<div class="pane-body pane-chat-tile-container">
		<div class="monitoring">
			<div class="incoming-msgs" style="transform: scaleX(1) scaleY(1); opacity: 1;" onclick="bottom()">
				<span class="icon icon-down" onclick="bottom()"></span>
			</div>
			<div id="messages" class="pane-chat-msgs" tabindex="0" style="overflow-y:scroll;background: url(<?php echo base_url() ?>tema/style/img/bg_body_chat.gif) left top repeat;">
				<div class="pane-chat-empty"></div><!-- untuk enter-->
				<!-- untuk proses reffresh atau menampikan pesan lainnya Start -->
				<div class="more"  onclick="reload()">
					<div class="btn-more" title="load earlier messages…">
						<i class="fa fa-refresh" aria-hidden="true"></i>
					</div>
				</div>
				<!-- untuk proses reffresh atau menampikan pesan lainnya End -->
				<div class="message-list">
				<!-- untuk menampikan informasi waktu chat Start -->
					<div class="msg">
						<div class="message message-system">
							<span class="message-system-body"><span class="hidden-token">
							<span class="emojitext" dir="auto" title="tanggal diterima">SELASA</span></span></span>
						</div>
					</div>
				<!-- lokasi untuk menampikan informasi waktu chat End -->
<?php 
foreach($chatting->result() as $value) {
	if ($value->id_pengirim == $this->session->userdata('hakAkses')) {
		$style = 'out'; 
	}else{
		$style = 'in';
	}
	?>
				<!-- lokasi Pesan Masuk Start -->
					<div class="msg msg-continuation">
						<div class="message message-chat message-<?php echo $style;?> tail message-chat">
							<div>
								<span class="tail-container"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="false_6288218454101@c.us_227A2D49A5E0C233A1F56CC43E5974">
										<span class="emojitext selectable-text" dir="ltr"><?php $var =  $this->ChaesarChiper->bacaPesan(($this->ChaesarChiper->tampil($value->pesan_keluar)), $this->session->userdata('kunci'));
										$n = strlen($var);
										$sum = $n-$value->banyak_tambahan;
											$penggalan = 	substr($var, 0,$sum);
											echo $penggalan;
										?></span>
									</div>
									<div class="message-meta">
										<span class="hidden-token" title="<?php echo $value->waktu_kirim ?>"><span class="message-datetime"><?php $text =  $value->waktu_kirim; echo substr($text, 10,9); ?></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!--lokasi Pesan Masuk End -->
	<?php
}
 ?>

				<!--lokasi pesan Keluar Start Here -->
<!-- 					<div class="msg msg-continuation">
						<div class="message message-chat message-out tail message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="true_6288218454101@c.us_91427E53A4ED348B15D03CAACBF58B">
										<span class="message-pre-text">[05:14, 6/18/2017]+62 896-5562-9793</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting [<?php echo $this->session->userdata('hakAkses'); ?>]</span>
									</div>
									<div class="message-meta text-clickable">
										<span class="hidden-token"><span class="message-datetime">05:14</span></span><span class="icon icon-msg-dblcheck-ack"></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div> -->
				<!--lokasi pesan Keluar End Here -->
				</div>
			</div>
		</div>
	</div>
	<!-- Start Text area for send message -->
	<footer class="pane-footer pane-chat-footer" tabindex="-1">
	  <!-- <form method="POST" action="<?php echo base_url() ?>Home/SendMessage"> -->
		<div class="block-compose">
			<div tabindex="-1" class="emoji-button-container" data-tab="4">
				<button class="icon icon-smiley compose-btn-emoji"><i class="fa fa-smile-o fa-2x"></i></button>
			</div>
				
			<div tabindex="-1" class="input-container">
				<div tabindex="-1" class="input-emoji">
					<!-- <textarea class="input" name="pesan" title="masukan pesan anda disini"placeholder="Masukan Pesan Anda Disini" required></textarea> -->
					<input class="input" type="text" id="pesan" autofocus name="pesan" placeholder="Masukan Pesan Anda Disini <?php echo $this->session->userdata('kunci'); ?>" required>
				</div>
			</div>
			<button onclick="kirim_pesan()" class="icon icon-send compose-btn-send"><i class="fa fa-send fa-2x" aria-hidden="true" title="kirim pesan"></i></button>
		</div>
<!-- 	  </form> -->
		<div class="compose-box-items-positioning-container">
			<div class="compose-box-items-overlay-container">
				<div></div>
			</div>
		</div><span class="mentions-positioning-container"></span>
	</footer>
	<!-- End Text area for send message -->
    <script src="<?php echo base_url() ?>tema/jquery-latest.js"></script>
    <script type="text/javascript">
//     function load() {
//         $("#pesan").val('');
//     }
//      $(document).ready(function(){
//       setInterval(function(){
//             $.ajax({
//               url       : '<?php echo base_url() ?>index.php/Home/cek',
//               success : function(msg){
//                 $(".monitoring").html(msg);
//                     var objDiv = document.getElementById("messages");
//                     objDiv.scrollTop = objDiv.scrollHeight;
//                 //$(".chatbox__body").slimScroll({start: "bottom", railVisible: true, alwaysVisible: true, height: '340px'});
//               }
//             }
//                   );
//     }, 10000);
// });
function reload (argument) {
	window.location.reload();
}
    </script>
