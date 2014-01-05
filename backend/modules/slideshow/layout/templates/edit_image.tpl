{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="pageTitle">
	<h2>{$lblGallery|ucfirst}: {$item.title}</h2>
</div>

{form:edit}
	<p>
			{$lblTitle|ucfirst}<br/>
			{$txtTitle} {$txtTitleError}
	</p>
	<div class="ui-tabs">
		<div class="ui-tabs-panel">
			<div class="options">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td id="leftColumn">         
                            
							<div class="box">
								<div class="heading">
									<h3>{$lblDescription|ucfirst}<abbr title="{$lblRequiredField}"></abbr></h3>
								</div>
								<div class="optionsRTE">
									{$txtDescription} {$txtDescriptionError}
								</div>
							</div>
							<p>
								{option:item.picture}
									<img src="{$FRONTEND_FILES_URL}/userfiles/images/slideshow/thumbnails/{$item.picture}" alt="" />
								{/option:item.picture}
								<label for="picture">Afbeelding</label>
								{$filePicture} {$filePictureError}
							</p>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="fullwidthOptions">
			<a href="{$var|geturl:'delete_image'}&amp;id={$item.id}&amp;gallery_id={$item.gallery_id}" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
				<span>{$lblDelete|ucfirst}</span>
			</a>
			<div class="buttonHolderRight">
				<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblPublish|ucfirst}" />
			</div>
		</div>

		<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
			<p>
				Verwijderen? {$item.title}
			</p>
		</div>

{/form:edit}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}
