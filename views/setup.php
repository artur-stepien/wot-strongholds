<script type="text/javascript">
$(document).ready(function(){
	$('[name="clan_tag"]').focus();
});
</script>

<form action="?action=setupClan" class="form" method="post">
	<h2><?php echo __('SETUP_HEADER') ?></h2>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('SETUP_PANEL_HEADING') ?>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="clan_tag" class="control-label"><?php echo __('SETUP_CLAN_TAG_LABEL') ?></label>
						<input type="text" class="form-control" name="clan_tag" id="clan_tag" placeholder="<?php echo __('SETUP_CLAN_TAG_PLACEHOLDER') ?>" tabindex="1"/>
					</div>
					<div class="form-group">
						<label for="application_id" class="control-label">
							<?php echo __('SETUP_APPLICATION_KEY_LABEL') ?> <a href="https://eu.wargaming.net/developers/applications/" target="_BLANK"><span class="glyphicon glyphicon-question-sign"></span></a>
							<i>(ip:<?php echo $_SERVER['SERVER_ADDR'] ?>)</i>
						</label>
						<input type="text" class="form-control" name="application_id" id="application_id" placeholder=""  tabindex="2"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="accepted_absence" class="control-label"><?php echo __('SETUP_MAX_ABSENCE_LABEL') ?></label>
						<input type="text" class="form-control" name="accepted_absence" id="accepted_absence" placeholder="<?php echo __('SETUP_MAX_ABSENCE_PLACEHOLDER') ?>" tabindex="3" value="14"/>
					</div>
					<div class="form-group">
						<label for="required_earnings" class="control-label"><?php echo __('SETUP_MINIMUM_RESOURCES_LABEL') ?></label>
						<input type="text" class="form-control" name="required_earnings" id="required_earnings" placeholder="<?php echo __('SETUP_MINIMUM_RESOURCES_PLACEHOLDER') ?>"  tabindex="4" value="300"/>
					</div>
				</div>
			</div>

			<div class="form-actions">
				<input type="reset" value="<?php echo __('SETUP_BUTTON_RESET') ?>" class="btn btn-default" />
				<input type="submit" value="<?php echo __('SETUP_BUTTON_INSTALL') ?>" class="btn btn-primary" tabindex="5" />
			</div>

		</div>
	</div>
	<footer class="text-center"><small class="copyrights"><?php echo '&copy; ',date('Y'),' ',__('COPYRIGHTS') ?>, </small><small class="version"><?php echo _s('VERSION', VERSION) ?></small></footer>
</form>