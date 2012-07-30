<FORM name='{$form->formName}' action='{$form->formAction}' method='{$form->formMethod}' enctype='{$form->formEnctype}'>
	<table class="edittable">
		<colgroup>
			<col width="160px"/>
			<col width="300px"/>
			<col />
		</colgroup>
		<tr>
			<td>
			ID
			</td>
			<td>
			<?=$request->id;?>
			</td>
			<td>
			
			</td>
		</tr>
		<?
		foreach ($form->elements as $id=>$elements){
			switch($elements->type){
				case "NEWTEXT":?>

					<tr>
						<td colspan="2">
							<b><?=$elements->caption;?></b>
							<div class="edit-area" style="width: 800px;">
								<?=$elements->value?>
								
							</div>
						</td>
					</tr>
					
					<?break;
				case "NEWTEXT_CONFIGS":?>
					<tr>
						<td class="configs_td" ><span><b><?=$elements->caption;?></b></span><br /><?=$elements->text?></td>
						<td class="full configs_td" ><?=$elements->value?></td>
					</tr>
					<?break;
				case "TEXTAREA":?>
					<tr>
						<td><label for="<?=$elements->name?>" ><?=$elements->caption;?></label></td>
						<td>
						<TEXTAREA style="width:500px;"  name='<?=$elements->name;?>' rows='<?=$elements->rows;?>' cols='<?=$elements->cols;?>' id='<?=$elements->name?>'><?=$elements->value;?></TEXTAREA>
						</td>
					</tr>
					<?break;
				case "TEXTAREAMINI":?>
					<tr>
						<td><label for="<?=$elements->name?>" ><?=$elements->caption;?></label></td>
						<td>
						<TEXTAREA style="width:500px;height:70px;"  name='<?=$elements->name;?>' rows='<?=$elements->rows;?>' cols='<?=$elements->cols;?>' id='<?=$elements->name?>'><?=$elements->value;?></TEXTAREA>
						</td>
					</tr>
					<?break;
				case "CHECKBOX":
					$caption = $elements->caption;
					$elements->caption = null;
					$input = "<";
					$input .= "INPUT type='".$elements->type."' ";
					$input .= "name='".$elements->name."' ";
					$input .= "value='".$elements->value."' ";
					$input .= "id='".$elements->name."' ";
					$input .= (($elements->checked==true)? 'checked' : '')." class=\"permissions-checkbox\" >";?>
					<tr>
						<td><label for="<?=$elements->name?>"><?=$caption;?></label></td>
						<td><div class="mini_input"  >
						<?=$input;?>
						</div></td>
					</tr>
					<?	
					break;

				case "SELECT":
					$input = "<";
					$input .= "select ";
					$input .= "name='".$elements->name."'";
					if($elements->java)
					$input .= " ".$elements->java."";
					
					$input .= "id ='".($elements->id ?$elements->id : $elements->name )."'";
					$input .= " >";
	
					foreach ($elements->options as $options) {
						$input .= "<OPTION value='".$options->value."' ".(($options->selected==true)? 'selected':'')." ".(($options->disabled==true)? 'disabled':'').">";
						$input .= $options->caption."</OPTION>";
					}
					$input .= "</select>";?>
					<tr>
						<td><label for="<?echo ($elements->id ?$elements->id : $elements->name );?>"><?=$elements->caption;?></label></td>
						<td><div class="mini_input"  ><?=$input;?></div></td>
					</tr>
					<?
					break;

				case "RADIO":
					$input = "";
					foreach ($elements->options as $options) {
						$input .= "\t<label><INPUT TYPE=radio name='".$elements->name."' value='".$options->value."' ".(($options->selected==true)? 'CHECKED':'').">";
						$input .= $options->caption."</label><br>\n";
					}?>
					<tr>
						<td><?=$elements->caption;?><td>
						<td>
						<?=$input;?>
						</td>
					</tr>
					<?
					break;
				case "HTML":
					$input = "";
					$caption = $elements->name;
					$input .= $elements->value."<br>\n";?>
					<tr>
						{$elements->name}{$elements->value}
					</tr>
					<?
					break;
				case "HItdEN":
					$input = "<";
					$input .= "INPUT type='".$elements->type."' ";
					$input .= "name='".$elements->name."' ";
					$input .= "size='".$elements->size."' ";
					$input .= "value='".$elements->value."' ";
					$input .= "id='".$elements->name."' ";
					$input .= (($elements->checked==true)? 'checked' : '').">";	?>
						<?=$input;?>
		
					<?
					break;
				case 'SUBMIT':
					/*$input = "<button class='action-button' name='".$elements->name."'><div></div>";
					$input .= "<span>".$elements->value."</span>";
					$input .= " ".$elements->value."</button>"; ?>*/
					$input = "<button class='fmk-button-admin f10'><div><div>";
					$input .= "<div>".$elements->value."</div>";
					$input .= "</div></div></button>"; ?>
					
					<tr>
						<td colspan="2" align="right" >
						<?=$input;?>
						</td>
					</tr>
					</p>
					<?
				break;
				case 'HIDDEN':
					$input = "<";
					$input .= "INPUT type='".$elements->type."' ";
					$input .= "name='".$elements->name."' ";
					$input .= "size='".$elements->size."' ";
					$input .= "value='".$elements->value."' ";
					$input .= "id='".$elements->name."' ";
					$input .= (($elements->checked==true)? 'checked' : '').">";	
					$hidden .= $input;
					?>

					<?
				break;
				default:
					if($request->dop_polya && ($elements->name=='caption' || $elements->name=='redir' || $elements->name=='keywords' || $elements->name=='description') ) $dop_polya = ' style="display:none;"';
					else $dop_polya = '';
					$input = "<";
					$input .= "INPUT type='".$elements->type."' ";
					$input .= "name='".$elements->name."' ";
					$input .= "size='".$elements->size."' ";
					$input .= "value='".$elements->value."' ";
					$input .= "id='".$elements->name."' ";
					$input .= (($elements->checked==true)? 'checked' : '').">";	?>
					<tr <?=$dop_polya?>>
						<td><label for="<?=$elements->name?>" id="<?=$elements->name?>-label"><?=$elements->caption;?></label><br />
							<?=$elements->text?>
						</td>
						<td>
						<?=$input;?>
						</td>
					</tr>
					<?
					
			}
		}
		?>
		
	</table>	
	<?php echo $hidden;?>
</FORM>
