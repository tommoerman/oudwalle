{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="pageTitle">
	<h2>{$lblModuleSettings|ucfirst}: {$lblLocation}</h2>
</div>

{form:settings}
	<div class="box horizontal">
		<div class="heading">
			<h3>{$lblSlideshow|ucfirst}</h3>
		</div>
		<div class="options">
			<p>
				<label for="width">{$lblWidth|ucfirst}</label>
				{$txtWidth} {$txtWidthError}
			</p>
		</div>
		<div class="options">
			<p>
				<label for="height">{$lblHeight|ucfirst}</label>
				{$txtHeight} {$txtHeightError}
			</p>
		</div>
	</div>

<div class="box horizontal">
		<div class="heading">
			<h3>{$lblThumbnail|ucfirst}</h3>
		</div>
		<div class="options">
			<p>
				<label for="width">{$lblThumbWidth|ucfirst}</label>
				{$txtThumbWidth} {$txtThumbWidthError}
			</p>
		</div>
		<div class="options">
			<p>
				<label for="height">{$lblThumbHeight|ucfirst}</label>
				{$txtThumbHeight} {$txtThumbHeightError}
			</p>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}