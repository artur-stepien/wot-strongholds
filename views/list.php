<script type="text/javascript">
$(document).ready(function(){ 
	// add parser through the tablesorter addParser method 
    $.tablesorter.addParser({
        // set a unique id 
        id: 'resources', 
        is: function(s) { 
            // return false so this parser is not auto detected 
            return false; 
        }, 
        format: function(s) { 
            // format your data for normalization 
            return s.toLowerCase().replace(' ','').replace(',','');
        }, 
        // set type, either numeric or text 
        type: 'numeric' 
    });       
	
	 $.tablesorter.addParser({
        // set a unique id 
        id: 'nickname', 
        is: function(s) { 
            // return false so this parser is not auto detected 
            return false; 
        }, 
        format: function(s) { 
            // format your data for normalization 
            return s.toLowerCase();
        }, 
        // set type, either numeric or text 
        type: 'text' 
    }); 
	
	$("#clan-table").tablesorter({ 
		headers: {
			0: { 
				sorter:false
			},
			1: { 
				sorter:'nickname' 
			},
			2: { 
				sorter:'nickname' 
			},
			3: { 
				sorter:'nickname' 
			},
			4: { 
				sorter:'resources' 
			}, 
			5: { 
				sorter:'resources' 
			}, 
			6: { 
				sorter:'resources' 
			}, 
			7: { 
				sorter:false
			} 
		} 
	}); 
}); 
</script>
<div class="jumbotron">
	<p class="text-center hidden-xs">
		<img src="<?php echo $controller->getConfig('clan_logo') ?>" alt="<?php echo $controller->getConfig('clan_name') ?>" />
	</p>
	<h1 class="text-center"><?php echo $controller->getConfig('clan_tag'); ?></h1>
	<p class="text-center hidden-xs"><?php echo $controller->getConfig('clan_name') ?></p>
</div>

<?php 
$members = $controller->getMembers();
$period_lenght = floor(($controller->getConfig('ballance_date_current',time())-$controller->getConfig('ballance_date_last',time()))/(60*60*24));
?>
<form action="?action=storeMembersBallance" method="post">
<table class="table table-bordered table-condensed table-hover tablesorter" id="clan-table">
	<thead>
		<tr>
			<th style="width:1%" class="hidden-xs">#</th>
			<th><?php echo __('LIST_HEADER_PLAYER') ?></th>
			<th><?php echo __('LIST_HEADER_JOINED') ?></th>
			<th><?php echo __('LIST_HEADER_LAST_BATTLE') ?></th>
			<th class="text-center hidden-xs hidden-sm">
				<?php echo __('LIST_HEADER_RESOURCES_LAST') ?><br/>
				<small><?php echo date('Y-m-d', $controller->getConfig('ballance_date_last',time())) ?></small>
			</th>
			<th class="text-center hidden-xs hidden-sm">
				<?php echo __('LIST_HEADER_RESOURCES_CURRENT') ?><br/>
				<small><?php echo date('Y-m-d', $controller->getConfig('ballance_date_current',time())) ?></small>
			</th>
			<th class="text-center"><?php echo _s('LIST_HEADER_RESOURCES_INCOME', $period_lenght) ?></th>
			<th><?php echo __('LIST_HEADER_RESOURCES_UPDATE') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$monthly = 0;
	foreach($members AS $idx=>$member): 
//	$warning = false;
//	// does not play longer then 14 days
//	if( (time()-$member->last_battle_time > 60*60*24*14) AND $member->last_battle_time!=0) $warning = true;
//	
//	// joined more then month ago but does not earn minimum resources
//	if( 
//		($member->resources_current - $member->resources_last) < $controller->getConfig('required_earnings',300) AND
//		$member->joined_at < time()-60*60*24*30 AND $member->last_battle_time!=0
//	) {
//		$warning = true;
//	}
	// monthly resources income
	$monthly+=$member->resources_current - $member->resources_last;
	?>
		<tr class="<?php echo ($member->warning ? 'danger ':'') ?>">
			<td class="hidden-xs"><?php echo $idx+1 ?></td>
			<td><a href="http://worldoftanks.eu/community/accounts/<?php echo $member->account_id ?>-<?php echo $member->nickname ?>/"><?php echo $member->nickname ?></a></td>
			<td><small><?php echo date('Y-m-d', $member->joined_at) ?></small></td>
			<td><small><?php echo date('Y-m-d H:i:s', $member->last_battle_time) ?></small></td>
			<td class="text-right hidden-xs hidden-sm"><?php echo number_format($member->resources_last,0,null,',') ?></td>
			<td class="text-right hidden-xs hidden-sm">
				<?php echo number_format($member->resources_current,0,null,',') ?>
			</td>
			<td class="text-right"><?php echo number_format(($member->resources_current - $member->resources_last),0,null,',') ?></td>
			<td class="text-center">
				<input class="form-control" name="ballance[<?php echo $member->account_id ?>]" type="text" value="" size="5" tabindex="<?php echo $idx+1 ?>" required="required" placeholder="<?php echo __('LIST_BALLANCE_PLACEHOLDER') ?>"/>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
	<tfoot>
		<td class="hidden-xs"></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="hidden-xs hidden-sm"></td>
		<td class="hidden-xs hidden-sm"></td>
		<td class="text-right"><?php echo number_format($monthly,0,null,',') ?></td>
		<td class="text-center">
			<input type="submit" class="btn btn-primary" value="<?php echo __('LIST_BUTTON_UPDATE') ?>"/>
		</td>
	</tfoot>
</table>
<footer class="text-center"><small class="copyrights"><?php echo '&copy; ',date('Y'),' ',__('COPYRIGHTS') ?>, </small><small class="version"><?php echo _s('VERSION', VERSION) ?></small></footer>
<p></p>
</form>