<?php
/**
 * This view display the buttons "use ComfortUpdate". 
 * It is injected by the javascript inside the li#udapteButtonsContainer, in the _checkButton view.
 * @var obj updateInfos the update informations provided by the update server 
 * @var obj $clang : the translate object, now moved to global function TODO : remove it  
 */
?>

<label><span style="font-weight: bold;"><?php echo gT('The following LimeSurvey updates are available:');?></span></label>
<br/>
<br/>

<table class="items table">
<?php
// First we check if the server provided a specific HTML message 
if(isset($updateInfos->html))
{
	if($updateInfos->html != "")
		echo '<tr><td>'.$updateInfos->html.'</tr></td>';
	
	// And we unset this html message for the loop on update versions don't crush on it
	unset($updateInfos->html);
}

?>


<?php foreach ($updateInfos as $aUpdateVersion):?>
	<?php $aUpdateVersion = (array) $aUpdateVersion;?>
	<thead>
		<tr>
			<th>
				<?php eT('LimeSurvey Version'); ?>	
			</th>
			<th>
				<?php eT('Branch'); ?>	
			</th>
			<th>
				<?php eT('Update type'); ?>	
			</th>						
			<th>
				
			</th>									
		</tr>
	</thead>
    <tr>
    	<td>
     		<?php
     			// display infos about the update. e.g : "2.05+ (150508) (stable)"  
     			echo $aUpdateVersion['versionnumber'];?> (<?php echo $aUpdateVersion['build'];?>)
    	</td>
		<?php if ($aUpdateVersion['branch']!='master'):?>
			<td class="text-warning">
				<?php  eT('unstable'); ?>
			</td>
		<?php else: ?> 
			<td>
				<?php eT('stable');?>
			</td>
		<?php endif;?>
    		 	
    		 	 
    	<?php if($aUpdateVersion['security_update']):?>
		<td class="text-warning">    			
    			<?php eT("Security Udpdate");?>
    	</td>
    	<?php else: ?>
    	<td>
    		<?php eT("Regular update");?>
    	</td>
    	<?php endif; ?>
    	
    	<td class="text-right">
    		<!-- The form launching an update process. First step is the welcome message. The form is not submitted, but catch by the javascript inserted in the end of this file -->
    		<?php echo CHtml::beginForm('update/sa/getwelcome', 'post', array('class'=>'launchUpdateForm')); ?>
    			<?php echo CHtml::hiddenField('destinationBuild' , $aUpdateVersion['build']); ?>
    			
    			<!-- the button launching the update --> 
				<button type="submit" class="btn btn-default ajax_button launch_update">
					<img src="<?php echo Yii::app()->getBaseUrl(true);?>/images/lime-icons/big/328637/shield-update.png" style="height : 1em; margin-right : 0.5em;"/>
					<?php eT("Use ComfortUpdate");?>
				</button>
						
	         	<?php if ($aUpdateVersion['branch']!='master'): ?> 
	         		<input type='button' class="ajax_button btn btn-default" onclick="window.open('http://www.limesurvey.org/en/unstable-release/viewcategory/26-unstable-releases', '_blank')" value='<?php eT("Download"); ?>' /> 
	         	<?php else: ?> 
	         		<input type='button' class="ajax_button btn btn-default" onclick="window.open('http://www.limesurvey.org/en/stable-release', '_blank')" value='<?php eT("Download"); ?>' />
	         	<?php endif; ?>
         	
         	<?php echo CHtml::endForm(); ?>
    	</td>
    </tr>
<?php endforeach; ?>	

</table>

<!-- this javascript code manage the step changing. It will catch the form submission, then load the ComfortUpdater for the required build -->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/scripts/admin/comfortupdater/comfortUpdateNextStep.js"></script>
<script>
	$('.launchUpdateForm').comfortUpdateNextStep({'step': 0});	
</script>