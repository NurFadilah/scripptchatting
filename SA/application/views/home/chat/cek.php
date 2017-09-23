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
										<span class="emojitext selectable-text" dir="ltr"><?php echo $value->pesan_keluar ?></span>
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