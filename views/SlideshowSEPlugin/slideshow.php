<?php if ($data instanceof stdClass) : ?>

	<div class="slideshow_container slideshow_container_<?php echo htmlspecialchars($data->styleName); ?>" data-slideshow-id="<?php echo htmlspecialchars($data->post->ID); ?>" data-style-name="<?php echo htmlspecialchars($data->styleName); ?>" data-style-version="<?php echo htmlspecialchars($data->styleVersion); ?>" <?php if (SlideshowSEPluginGeneralSettings::getEnableLazyLoading()) : ?>data-settings="<?php echo htmlspecialchars(json_encode($data->settings)); ?>"<?php endif; ?>>
<?php if(isset($data->settings['showLoadingIcon']) && $data->settings['showLoadingIcon'] === 'true'): ?>
		<div class="slideshow_loading_icon"></div>
<?php endif; ?>
		<div class="slideshow_content" style="display: none;">
<?php

			if (is_array($data->slides) && count($data->slides) > 0)
			{
				$i = 0;

				for ($i; $i < count($data->slides); $i++)
				{
					echo '			<div class="slideshow_view">';

					for ($i; $i < count($data->slides); $i++)
					{
						$slideData             = new stdClass();
						$slideData->properties = $data->slides[$i];

						SlideshowSEPluginMain::outputView('SlideshowSEPluginSlideshowSlide' . DIRECTORY_SEPARATOR . 'frontend_' . $data->slides[$i]['type'] . '.php', $slideData);

						if (($i + 1) % $data->settings['slidesPerView'] == 0)
						{
							break;
						}
					}

					//echo '<div style="clear: both;"></div>';
					echo "			</div>" . PHP_EOL;
				}
			}
?>
		</div>
		<div class="slideshow_controlPanel slideshow_transparent" style="display: none;"><ul><li class="slideshow_togglePlay" data-play-text="<?php _e('Play', 'slideshow-se'); ?>" data-pause-text="<?php _e('Pause', 'slideshow-se'); ?>"></li></ul></div>
		<div class="slideshow_button slideshow_previous slideshow_transparent" role="button" data-previous-text="<?php _e('Previous', 'slideshow-se'); ?>" style="display: none;"></div>
		<div class="slideshow_button slideshow_next slideshow_transparent" role="button" data-next-text="<?php _e('Next', 'slideshow-se'); ?>" style="display: none;"></div>
		<div class="slideshow_pagination" style="display: none;" data-go-to-text="<?php _e('Go to slide', 'slideshow-se'); ?>"><div class="slideshow_pagination_center"></div></div>
<?php if(is_array($data->log) && count($data->log) > 0): ?>
		<!-- Error log
<?php foreach($data->log as $logMessage): ?>
			- <?php echo htmlspecialchars($logMessage); ?>
<?php endforeach; ?>
		-->
<?php endif; ?>
	</div>

<?php endif; ?>