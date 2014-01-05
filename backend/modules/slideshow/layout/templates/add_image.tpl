{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="pageTitle">
	<h2>{$lblSlideshow|ucfirst}: {$item.title} ({$item.width} x {$item.height})</h2>
</div>

{form:add}
	<div class="ui-tabs">
		<div class="ui-tabs-panel">
			<div class="options">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td id="leftColumn">
								<p>
									<label for="picture">Afbeelding</label>
									{$filePicture} {$filePictureError}
								</p>
						</td>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="fullwidthOptions">
			<div class="buttonHolderRight">
				<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblAdd|ucfirst}" />
			</div>
		</div>
{/form:add}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}