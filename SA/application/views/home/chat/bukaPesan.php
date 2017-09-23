		<div class="monitoring">
			<div class="incoming-msgs" style="transform: scaleX(1) scaleY(1); opacity: 1;" onclick="bottom()">
				<span class="icon icon-down" onclick="bottom()"></span>
			</div>
			<div id="messages" class="pane-chat-msgs" tabindex="0" style="overflow-y:scroll;background: url(<?php echo base_url() ?>tema/style/img/bg_body_chat.gif) left top repeat;">
				<div class="pane-chat-empty"></div><!-- untuk enter-->
				<!-- untuk proses reffresh atau menampikan pesan lainnya Start -->
				<div class="more"onclick="reload()">
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
<script type="text/javascript">
	function reload (argument) {
	window.location.reload();
</script>