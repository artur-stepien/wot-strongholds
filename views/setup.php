<script type="text/javascript">
$(document).ready(function(){
	$('[name="clan_tag"]').focus();
});
</script>

<form action="?action=setupClan" class="form" method="post">
	<legend>Instalacja aplikacji</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			Ustawienia klanu
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="clan_tag" class="control-label">TAG klanu</label>
						<input type="text" class="form-control" name="clan_tag" placeholder="np. DPA_E" tabindex="1"/>
					</div>
					<div class="form-group">
						<label for="application_id" class="control-label">
							ID Aplikacji <a href="https://eu.wargaming.net/developers/applications/" target="_BLANK"><span class="glyphicon glyphicon-question-sign"></span></a>
							<i>(ip:<?php echo $_SERVER['SERVER_ADDR'] ?>)</i>
						</label>
						<input type="text" class="form-control" name="application_id" placeholder=""  tabindex="2"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="accepted_absence" class="control-label">Akceptowalny czas nieobecności</label>
						<input type="text" class="form-control" name="accepted_absence" placeholder="ilość dni np. 14" tabindex="3" value="14"/>
					</div>
					<div class="form-group">
						<label for="required_earnings" class="control-label">Minimalny okresowy przychód zasobów <small>(np. 300)</small></label>
						<input type="text" class="form-control" name="required_earnings" placeholder="np. 300"  tabindex="4" value="300"/>
					</div>
				</div>
			</div>

			<div class="form-actions">
				<input type="reset" value="Resetuj" class="btn btn-default" />
				<input type="submit" value="Instalacja" class="btn btn-primary" tabindex="5" />
			</div>

		</div>
	</div>
</form>