<?php foreach($identitas->result() as $row) {} 	?>
<div class="pane pane-chat pane-two" id="main">
	<div class="pane-chat-tile"></div>
	<header class="pane-header pane-chat-header">
		<div class="chat-avatar">
			<div class="avatar icon-user-default" style="height: 40px; width: 40px;">
				<div class="avatar-body"><img class="avatar-image is-loaded" draggable="false" src="<?php echo base_url()?>tema/style/img/<?php echo $row->gambar ?>"></div>
			</div>
		</div>
		<div class="chat-body">
			<div class="chat-main">
				<h2 class="chat-title" dir="auto">
					<span class="emojitext ellipsify" dir="auto" title="nur fadilah"><?php echo $row->nama ?></span>
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
	<div class="pane-body pane-chat-tile-container">
		<div>
			<div class="incoming-msgs" style="transform: scaleX(1) scaleY(1); opacity: 1;">
				<span class="icon icon-down" onclick="bottom()"></span>
			</div>
			<div id="messages" class="pane-chat-msgs" tabindex="0" style="overflow-y:scroll;background: url(<?php echo base_url() ?>tema/style/img/bg_body_chat.gif) left top repeat;">
				<div class="pane-chat-empty"></div>
				<div class="more">
					<div class="btn-more" title="load earlier messages…">
						<i class="fa fa-refresh" aria-hidden="true"></i>
					</div>
				</div>
				<div class="message-list">
					<div class="msg">
						<div class="message message-system">
							<span class="message-system-body"><span class="hidden-token">
							<span class="emojitext" dir="auto" title="tanggal diterima">SELASA</span></span></span>
						</div>
					</div>
					<div class="msg msg-continuation">
						<span></span>
						<div class="message message-chat message-in tail message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="false_6288218454101@c.us_227A2D49A5E0C233A1F56CC43E5974">
										<span class="message-pre-text">[03:53, 6/15/2017]nur fadilah</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting</span>
									</div>
									<div class="message-meta">
										<span class="hidden-token"><span class="message-datetime">03:53</span></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg msg-continuation">
						<span></span>
						<div class="message message-chat message-out tail message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="true_6288218454101@c.us_91427E53A4ED348B15D03CAACBF58B">
										<span class="message-pre-text">[05:14, 6/18/2017]+62 896-5562-9793</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting</span>
									</div>
									<div class="message-meta text-clickable">
										<span class="hidden-token"><span class="message-datetime">05:14</span></span><span class="icon icon-msg-dblcheck-ack"></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg">
						<span></span>
						<div class="message message-chat message-out message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
					<img class="avatar-image is-loaded" draggable="false" src="<?php echo base_url() ?>tema/style/img/ScriptApps.png">
									<div class="message-text" data-id="true_6288218454101@c.us_FE126416BB52A030BE94745B05F9C0">
										<span class="message-pre-text">[05:14, 6/18/2017]+62 896-5562-9793</span><span class="emojitext selectable-text" dir="ltr"><!-- react-text: 906 --></span>
									</div>
									<div class="message-meta text-clickable">
										<span class="hidden-token"><span class="message-datetime">05:14</span></span><span class="icon icon-msg-dblcheck-ack"></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg msg-continuation">
						<span></span>
						<div class="message message-chat message-in tail message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="false_6288218454101@c.us_560E84AD3E55892EFB2EE98A6E14EA">
										<span class="message-pre-text">[05:17, 6/18/2017]nur fadilah</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting<img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"></span>
									</div>
									<div class="message-meta">
										<span class="hidden-token"><span class="message-datetime">05:17</span></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg">
						<span></span>
						<div class="message message-chat message-in message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="false_6288218454101@c.us_D2FA3C5D6F351B9267914C11526831">
										<span class="message-pre-text">[05:17, 6/18/2017]nur fadilah</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting<img alt="😚" class="selectable-text e1702 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😚" class="selectable-text e1702 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"></span>
									</div>
									<div class="message-meta">
										<span class="hidden-token"><span class="message-datetime">05:17</span></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg msg-continuation">
						<span></span>
						<div class="message message-chat message-out tail message-chat">
							<div>
								<span class="tail-container"></span<<span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="true_6288218454101@c.us_122466A02433B6B07A329708888B61">
										<span class="message-pre-text">[05:20, 6/18/2017]+62 896-5562-9793</span>
										<span class="emojitext selectable-text" dir="ltr">ok.. semangat..  <img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😘" class="selectable-text e1700 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><img alt="😚" class="selectable-text e1702 c0 emoji" draggable="false" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"></span>
									</div>
									<div class="message-meta text-clickable">
										<span class="hidden-token"><span class="message-datetime">05:20</span></span>
										<span class="icon icon-msg-dblcheck-ack"></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
					<div class="msg">
						<span></span>
						<div class="message message-chat message-out message-chat">
							<div>
								<span class="tail-container"></span><span class="tail-container highlight"></span>
								<div class="bubble bubble-text">
									<div class="message-text" data-id="true_6288218454101@c.us_349EB0CE669F808EB70D255E5F97D5">
										<span class="message-pre-text">[05:21, 6/18/2017]+62 896-5562-9793</span>
										<span class="emojitext selectable-text" dir="ltr">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting</span>
									</div>
									<div class="message-meta text-clickable">
										<span class="hidden-token"><span class="message-datetime">05:21</span></span>
										<span class="icon icon-msg-dblcheck-ack"></span>
									</div>
								</div><span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="pane-footer pane-chat-footer" tabindex="-1">
	  <form method="POST" action="proses.php">
		<div class="block-compose">
			<div tabindex="-1" class="emoji-button-container" data-tab="4">
				<button class="icon icon-smiley compose-btn-emoji"><i class="fa fa-smile-o fa-2x"></i></button>
			</div>
				
			<div tabindex="-1" class="input-container">
				<div tabindex="-1" class="input-emoji">
					<!-- <textarea class="input" name="pesan" title="masukan pesan anda disini"placeholder="Masukan Pesan Anda Disini" required></textarea> -->
					<input class="input" type="text" name="pesan" placeholder="Masukan Pesan Anda Disini" required>
				</div>
			</div>
			<button class="icon icon-send compose-btn-send"><i class="fa fa-send fa-2x" aria-hidden="true" title="kirim pesan"></i></button>
		</div>
	  </form>
		<div class="compose-box-items-positioning-container">
			<div class="compose-box-items-overlay-container">
				<div></div>
			</div>
		</div><span class="mentions-positioning-container"></span>
	</footer>