<div class="wrap" id="wpSM">

	<h2>
		<a href="?page=wpsm.dashboard">
			<img src="<?php echo WP_PLUGIN_URL . '/wpSlackManager/asset/img/icon.svg'; ?>">
			slack <span>Manager</span>
		</a>
	</h2>

	<p>Home</p>

	<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/menu.php' ); ?>

	<div id="content">
		<h3>
			<i class="green-text fa fa-tachometer" aria-hidden="true"></i>
			<?php echo __('Dashboard', 'wpSlackManager'); ?>
		</h3>
	</div>

</div>