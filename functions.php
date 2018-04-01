<?php

add_action('wp_enqueue_scripts', 'marketplace_child_css', 1001);

function marketplace_child_css() {
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/style.css' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/css/styles.css' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/footer.php' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/header-topbar.php' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/woocommerce/single-product/meta.php' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/woocommerce/single-product/title.php' );
	wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/js/components/ajax-search.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'styles-child' );
}

function marketplace_add_child_shortcodes() {
	remove_shortcode('banner', 'banner_simple_height');
    add_shortcode( 'banner', 'banner_simple_height_officesupplies' );
}

add_action('wp_loaded', 'marketplace_add_child_shortcodes');

// Share

add_action('init', 'single_share_product_string');

function single_share_product_string() {
	remove_filter( 'getbowtied_woocommerce_before_single_product_summary_data_tabs', 'getbowtied_single_share_product', 50 );

	global $post, $product, $shopkeeper_theme_options;
    if ( (isset($shopkeeper_theme_options['sharing_options'])) && ($shopkeeper_theme_options['sharing_options'] == "1" ) ) :

	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false, ''); //Get the Thumbnail URL
	
	?>

    <div class="product_socials_wrapper show-share-text-on-mobiles">
		<div class="share-product-text">Distribuiţi Produsul</div>
		<div class="product_socials_wrapper_inner">
			<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_facebook"><span class="icon-facebook-share"></span></a>
		</div><!--.product_socials_wrapper_inner-->
			
	</div><!--.product_socials_wrapper-->

<?php
    endif;
	add_filter( 'getbowtied_woocommerce_before_single_product_summary_data_tabs', 'single_share_product_string', 50 );
}


// Shortcode for Banners.

function banner_simple_height_officesupplies($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'banner_white_on_black_text' => 'no',
		'title_placement' => 'bottom',
		'has_subtitle' => 'yes',
		'subtitle' => 'Subtitle',
		'has_call_to_action' => 'no',
		'call_to_action' => '',
		'link_url' => '',
		'new_tab'  => '',
		'has_border_radius' => 'no',
		'border_radius'	=> '',
		'title_color' => '#fff',
		'title_size' => '',
		'text_align' => 'left',
		'text_placement' => 'inner',
		'has_container_padding_inner' => 'no',
		'container_padding_inner' => '',
		'has_html_text' => 'no',
		'html_text' => '',
		'margin_outer_text' => '',
		'margin_bottom_outer_title' => '',
		'subtitle_has_margin' => 'no',
		'subtitle_margin_top' => '',
		'subtitle_margin_bottom' => '',
		'subtitle_color' => '#fff',
		'inner_stroke' => '2px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'image' => '',
		'image_width' => '',
		'image_height' => '',
		'height' => 'auto',
		'has_badge' => 'no',
		'badge_custom_size' => 'no',
		'badge_size_width' => '',
		'badge_size_height' => '',
		'badge_has_border_radius' => 'no',
		'badge_border_radius' => '',
		'badge_text' => '',
		'badge_text_size' => '',
		'badge_text_color' => '',
		'badge_has_small_text' => '',
		'badge_small_text' => '',
		'badge_small_text_placement' => 'top',
		'badge_color' => '',
		'has_image' => 'no',
		'with_bullet' => 'no',
		'bullet_text' => '',
		'bullet_bg_color' => '',
		'bullet_text_color' => '',
		'has_background_image' => 'no',
		'background_image' => '',
		'background_image_size' => '',
		'background_image_position' => '',
		'has_background_custom_class' => 'no',
		'background_custom_class' => ''
	), $params));
	
	$banner_with_img = '';
	
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
		$banner_with_img = 'banner_with_img';
	}
	
	$content = do_shortcode($content);
	
	$banner_simple_height = '
		<a href="'.$link_url.'" class="banner"><div class="shortcode_banner_simple_height '.$banner_with_img.'" '.$link_tab.'>';

		if ($has_border_radius == 'no') {
			if ($has_background_image == 'yes') {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_inner_bshimg">';
			} else {
			$banner_simple_height .= '<div class="shortcode_banner_simple_height_inner">';
			}
		}
		else
		{
			if ($title_placement == 'top') {
				if ($text_placement == 'outer') {
					if ($banner_white_on_black_text == 'no') {
						$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					} else {
						$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					}
				}
			}
			if ($title_placement == 'outer-top') {
				if ($text_placement == 'inner') {
					if ($banner_white_on_black_text == 'no') {
						$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					} else {
						$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					}
				}
			}
			if ($has_background_image == 'yes') {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_inner_bshimg" style="border-radius: '.$border_radius.'">';
			} else {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_inner" style="border-radius: '.$border_radius.'">';
			}
		}
			if ($has_background_image == 'yes') {
				if ($has_background_custom_class == 'no') {
					$banner_simple_height .= '<div class="shortcode_banner_simple_height_bkg banner_simple_bkimg" style="background-color:'.$bg_color.'; background-image:url('.$background_image.'); background-size: '.$background_image_size.'; background-position: '.$background_image_position.';"></div>';
				} else {
					$banner_simple_height .= '<div class="shortcode_banner_simple_height_bkg banner_simple_bkimg '.$background_custom_class.'" style="background-color:'.$bg_color.'; background-image:url('.$background_image.'); background-size: '.$background_image_size.'; background-position: '.$background_image_position.';"></div>';
				}
			} else {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_bkg" style="background-color:'.$bg_color.'"></div>';
			}

			if ($has_container_padding_inner == 'yes') {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_inside" style="height:'.$height.'; padding: '.$container_padding_inner.'; border: '.$inner_stroke.' solid '.$inner_stroke_color.'">';
			} else {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_inside" style="height:'.$height.'; border: '.$inner_stroke.' solid '.$inner_stroke_color.'">';
			}
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_content">';

					if ($has_image == 'yes') {
						if ($text_placement == 'inner') {
							if ($title_placement == 'top') {
								if ($banner_white_on_black_text == 'no') {
									$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								} else {
									$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								}
							}
						}
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_image">
							<img src="'.$image.'" width="'.$image_width.'" height="'.$image_height.'">
							</div>';
					}

					if ($text_placement == 'inner') {
						if ($has_subtitle == 'yes') {
							if ($title_placement == 'bottom') {
								if ($banner_white_on_black_text == 'no') {
									$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								} else {
									$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								}
							}
								if ($subtitle_has_margin == 'yes') {
									if ($banner_white_on_black_text == 'no') {
										$banner_simple_height .= '<div><p class="banner_text banner_white_on_black_text" style="text-align: '.$text_align.'; margin-top: '.$subtitle_margin_top.'px; margin-bottom: '.$subtitle_margin_bottom.'px">'.$subtitle.'</p></div>';
									} else {
										$banner_simple_height .= '<div><p class="banner_text" style="text-align: '.$text_align.'; margin-top: '.$subtitle_margin_top.'px; margin-bottom: '.$subtitle_margin_bottom.'px">'.$subtitle.'</p></div>';
									}
								} else {
									if ($banner_white_on_black_text == 'no') {
										$banner_simple_height .= '<div><p class="banner_text" style="text-align: '.$text_align.'">'.$subtitle.'</p></div>';
									} else {
										$banner_simple_height .= '<div><p class="banner_text banner_white_on_black_text" style="text-align: '.$text_align.'">'.$subtitle.'</p></div>';
									}
								}
						} else {
							if ($title_placement == 'bottom') {
								if ($banner_white_on_black_text == 'no') {
									$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								} else {
									$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
								}
							}
						}

						if ($has_call_to_action == 'yes') {
							if ($banner_white_on_black_text == 'no') {
								$banner_simple_height .= '<div><p class="banner_call_to_action" style="text-align: '.$text_align.'">'.$call_to_action.'</p></div>';
							} else {
								$banner_simple_height .= '<div><p class="banner_call_to_action banner_white_on_black_text" style="text-align: '.$text_align.'">'.$call_to_action.'</p></div>';
							}
						}

						if ($has_html_text == 'yes') {
							$banner_simple_height .= $html_text;
						}
					}

					$banner_simple_height .= '</div>
				</div>
			</div>';

	if ($text_placement == 'outer') {
			if ($has_subtitle == 'yes') {
					if ($title_placement == 'bottom') {
						if ($banner_white_on_black_text == 'no') {
							$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
						} else {
							$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
						}
					}
						if ($subtitle_has_margin == 'yes') {
							if ($banner_white_on_black_text == 'no') {
								$banner_simple_height .= '<div><p class="banner_text" style="text-align: '.$text_align.'; margin-top: '.$subtitle_margin_top.'px; margin-bottom: '.$subtitle_margin_bottom.'px">'.$subtitle.'</p></div>';
							} else {
								$banner_simple_height .= '<div><p class="banner_text banner_white_on_black_text" style="text-align: '.$text_align.'; margin-top: '.$subtitle_margin_top.'px; margin-bottom: '.$subtitle_margin_bottom.'px">'.$subtitle.'</p></div>';
							}
						} else {
							if ($banner_white_on_black_text == 'no') {
								$banner_simple_height .= '<div><p class="banner_text" style="text-align: '.$text_align.'">'.$subtitle.'</p></div>';
							} else {
								$banner_simple_height .= '<div><p class="banner_text banner_white_on_black_text" style="text-align: '.$text_align.'">'.$subtitle.'</p></div>';
							}
						}
			} else {
				if ($title_placement == 'bottom') {
					if ($banner_white_on_black_text == 'no') {
						$banner_simple_height .= '<div><h3 style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					} else {
						$banner_simple_height .= '<div><h3 class="banner_white_on_black_text" style="font-size: '.$title_size.'px; text-align: '.$text_align.'; margin-top: '.$margin_outer_text.'px; margin-bottom: '.$margin_bottom_outer_title.'px">'.$title.'</h3></div>';
					}
				}
			}
				if ($has_call_to_action == 'yes') {
					if ($banner_white_on_black_text == 'no') {
						$banner_simple_height .= '<div><p class="banner_call_to_action" style="text-align: '.$text_align.'">'.$call_to_action.'</p></div>';
					} else {
						$banner_simple_height .= '<div><p class="banner_call_to_action banner_white_on_black_text" style="text-align: '.$text_align.'">'.$call_to_action.'</p></div>';
					}
				}
				if ($has_html_text == 'yes') {
					$banner_simple_height .= $html_text;
				}
	}

	if ($with_bullet == 'yes') {
		$banner_simple_height .= '<div class="shortcode_banner_simple_height_bullet" style="background:'.$bullet_bg_color.'; color:'.$bullet_text_color.'"><span>'.$bullet_text.'</span></div>';
	}

	if ($has_badge == 'yes') {
		if ($badge_custom_size == 'yes') {
			if ($badge_has_border_radius == 'yes') {
				if ($badge_has_small_text == 'yes') {
					if ($badge_small_text_placement == 'top') {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; border-radius:'.$badge_border_radius.'; background:'.$badge_color.'; color:'.$badge_text_color.'"><span>'.$badge_small_text.'<p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
					} else {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; border-radius:'.$badge_border_radius.'; background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p>'.$badge_small_text.'</span></div>';
					}
				} else {
					$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; border-radius:'.$badge_border_radius.'; background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
				}
			} else {
				if ($badge_has_small_text == 'yes') {
					if ($badge_small_text_placement == 'top') {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; background:'.$badge_color.'; color:'.$badge_text_color.'"><span>'.$badge_small_text.'<p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
					} else {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p>'.$badge_small_text.'</span></div>';
					}
				} else {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="width:'.$badge_size_width.'px; height:'.$badge_size_height.'px; background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
				}
			}
		} else {
			if ($badge_has_border_radius == 'yes') {
				if ($badge_has_small_text == 'yes') {
					if ($badge_small_text_placement == 'top') {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; border-radius:'.$badge_border_radius.'; color:'.$badge_text_color.'"><span>'.$badge_small_text.'<p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
					} else {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; border-radius:'.$badge_border_radius.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p>'.$badge_small_text.'</span></div>';
					}
				} else {
					$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; border-radius:'.$badge_border_radius.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
				}
			} else {
				if ($badge_has_small_text == 'yes') {
					if ($badge_small_text_placement == 'top') {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; color:'.$badge_text_color.'"><span>'.$badge_small_text.'<p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
					} else {
						$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p>'.$badge_small_text.'</span></div>';
					}
				} else {
				$banner_simple_height .= '<div class="shortcode_banner_simple_height_badge" style="background:'.$badge_color.'; color:'.$badge_text_color.'"><span><p style="font-size:'.$badge_text_size.'px !important; color:'.$badge_text_color.'">'.$badge_text.'</p></span></div>';
				}
			}
		}
	}
	
	$banner_simple_height .= '</div></a href>';
	
	return $banner_simple_height;
}

add_shortcode('banner_officesupplies', 'banner_simple_height_officesupplies');

function vc_banner_officesupplies() {
	vc_map(array(
	   "name"			=> "Banner",
	   "category"		=> 'Content',
	   "description"	=> "Place Banner",
	   "base"			=> "banner",
	   "class"			=> "",
	   "icon"			=> "banner",

	   
	   "params" 	=> array(
	      
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Title",
				"param_name"	=> "title",
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Hover Effect (White On Black)",
				"param_name"	=> "banner_white_on_black_text",
				"value"			=> array(
					"No"	=> "no",
					"Yes"		=> "yes"
				),
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Title Placement",
				"param_name"	=> "title_placement",
				"value"			=> array(
					"Bottom"	=> "bottom",
					"Top"		=> "top",
					"Outer Top"	=> "outer-top"
				),
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Add Subtitle",
				"param_name"	=> "has_subtitle",
				"value"			=> array(
					"Yes"		=> "yes",
					"No"		=> "no"
				),
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Subtitle",
				"param_name"	=> "subtitle",
				"admin_label"	=> FALSE,
				"dependency" 	=> Array('element' => "has_subtitle", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Add Call to Action",
				"param_name"	=> "has_call_to_action",
				"value"			=> array(
					"No"		=> "no",
					"Yes"		=> "yes"
				),
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Call to Action Text",
				"param_name"	=> "call_to_action",
				"admin_label"	=> FALSE,
				"dependency" 	=> Array('element' => "has_call_to_action", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Text Placement",
				"param_name"	=> "text_placement",
				"value"			=> array(
					"Inner"		=> "inner",
					"Outer"		=> "outer"
				),
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Edit Container Padding",
				"param_name"	=> "has_container_padding_inner",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Container Padding Values",
				"param_name"	=> "container_padding_inner",
				"admin_label"	=> FALSE,
				"dependency" 	=> Array('element' => "has_container_padding_inner", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Text Placement",
				"param_name"	=> "text_placement",
				"value"			=> array(
					"Inner"		=> "inner",
					"Outer"		=> "outer"
				),
			),

			array (
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Title Top Margin",
				"param_name"	=> "margin_outer_text",
			),

			array (
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Title Bottom Margin",
				"param_name"	=> "margin_bottom_outer_title",
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Subtitle Margin",
				"param_name"	=> "subtitle_has_margin",
				"dependency" 	=> Array('element' => "has_subtitle", 'value' => array('yes')),
				"value"			=> array(
					"No"		=> "no",
					"Yes"		=> "yes"
				),
			),

			array (
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Subtitle Top Margin",
				"param_name"	=> "subtitle_margin_top",
				"dependency" 	=> Array('element' => "subtitle_has_margin", 'value' => array('yes'))
			),

			array (
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Subtitle Bottom Margin",
				"param_name"	=> "subtitle_margin_bottom",
				"dependency" 	=> Array('element' => "subtitle_has_margin", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Text Alignment",
				"param_name"	=> "text_align",
				"value"			=> array(
					"Left"		=> "left",
					"Center"	=> "center",
					"Right"		=> "right"
				),
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "URL",
				"param_name"	=> "link_url",
			),

			array(
				"type"			=> "checkbox",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Open link in new tab?",
				"param_name"	=> "new_tab",
				"value"			=> array(
					"Yes"			=> "true",
				),
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Title Size",
				"param_name"	=> "title_size",
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Title Color",
				"param_name"	=> "title_color",
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Subtitle Color",
				"param_name"	=> "subtitle_color",
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Inner Stroke Thickness",
				"param_name"	=> "inner_stroke",
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Add An Icon or Image",
				"param_name"	=> "has_image",
				"value"			=> array(
					"No"		=> "no",
					"Yes"		=> "yes"
				),
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Image Path",
				"param_name"	=> "image",
				"dependency" 	=> Array('element' => "has_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Image Width",
				"param_name"	=> "image_width",
				"dependency" 	=> Array('element' => "has_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Image Height",
				"param_name"	=> "image_height",
				"dependency" 	=> Array('element' => "has_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Border Radius",
				"param_name"	=> "has_border_radius",
				"value"			=> array(
					"No"		=> "false",
					"Yes"		=> "true"
				),
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Border Radius Values",
				"param_name"	=> "border_radius",
				"dependency" 	=> Array('element' => "has_border_radius", 'value' => array('true'))
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Inner Stroke Color",
				"param_name"	=> "inner_stroke_color",
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Background Color",
				"param_name"	=> "bg_color",
			),
			
			array(
				"type"			=> "attach_image",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Background Image",
				"param_name"	=> "bg_image",
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Height",
				"param_name"	=> "height",
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Separator Padding",
				"param_name"	=> "sep_padding",
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Separator Color",
				"param_name"	=> "sep_color",
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Add HTML Text",
				"param_name"	=> "has_html_text",
				"value"			=> array(
					"No"		=> "no",
					"Yes"		=> "yes"
				),
			),

			array(
				"type"			=> "textarea",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "HTML Text",
				"param_name"	=> "html_text",
				"dependency" 	=> Array('element' => "has_html_text", 'value' => array('yes'))
			),
			
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "With Bullet",
				"param_name"	=> "with_bullet",
				"value"			=> array(
					"Yes"			=> "yes",
					"No"			=> "no"
				),
				"std"			=> "no",
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Bullet Text",
				"param_name"	=> "bullet_text",
				"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Bullet Background Color",
				"param_name"	=> "bullet_bg_color",
				"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Bullet Text Color",
				"param_name"	=> "bullet_text_color",
				"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Add Badge",
				"param_name"	=> "has_badge",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Has Custom Size",
				"param_name"	=> "badge_custom_size",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Size Width",
				"param_name"	=> "badge_size_width",
				"dependency" 	=> Array('element' => "badge_custom_size", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Size Height",
				"param_name"	=> "badge_size_height",
				"dependency" 	=> Array('element' => "badge_custom_size", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Has Border Radius",
				"param_name"	=> "badge_has_border_radius",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Border Radius",
				"param_name"	=> "badge_border_radius",
				"dependency" 	=> Array('element' => "badge_has_border_radius", 'value' => array('yes'))
			),
			
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Text",
				"param_name"	=> "badge_text",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Text Size",
				"param_name"	=> "badge_text_size",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Text Color",
				"param_name"	=> "badge_text_color",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Has Small Text",
				"param_name"	=> "badge_has_small_text",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Small Text Placement",
				"param_name"	=> "badge_small_text_placement",
				"value"			=> array(
					"Top"			=> "top",
					"Bottom"		=> "bottom"
				),
				"dependency" 	=> Array('element' => "badge_has_small_text", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Small Text",
				"param_name"	=> "badge_small_text",
				"dependency" 	=> Array('element' => "badge_has_small_text", 'value' => array('yes'))
			),
			
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Badge Background Color",
				"param_name"	=> "badge_color",
				"dependency" 	=> Array('element' => "has_badge", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Add Distinct Background Image",
				"param_name"	=> "has_background_image",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Background Image Path",
				"param_name"	=> "background_image",
				"dependency" 	=> Array('element' => "has_background_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Background Image Size",
				"param_name"	=> "background_image_size",
				"dependency" 	=> Array('element' => "has_background_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Background Image Position",
				"param_name"	=> "background_image_position",
				"dependency" 	=> Array('element' => "has_background_image", 'value' => array('yes'))
			),

			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class" 		=> "hide_in_vc_editor",
				"admin_label" 	=> true,
				"heading"		=> "Add Custom Background Container Class",
				"param_name"	=> "has_background_custom_class",
				"value"			=> array(
					"No"			=> "no",
					"Yes"			=> "yes"
				),
				"std"			=> "no",
			),

			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "hide_in_vc_editor",
				"admin_label"	=> true,
				"heading"		=> "Background Custom Container Class",
				"param_name"	=> "background_custom_class",
				"dependency" 	=> Array('element' => "has_background_custom_class", 'value' => array('yes'))
			),

	   )
	   
	));
}

add_action('wp_loaded', 'vc_banner_officesupplies');


// Free Shipping for Expensive Products.
  
add_action( 'woocommerce_before_add_to_cart_quantity', 'freeshipping_display_badge_if_checkbox', 50 );
  
function freeshipping_display_badge_if_checkbox() {

    global $product;

    if ( $product->is_type( 'simple' ) ) {
	    if ( $product->is_on_sale() ) {
	    	if ($product->get_sale_price() >= 499) {
	    		echo '<p class="free-shipping-details">Acest produs beneficiază de livrare gratuită!</p>';
	    	}
		} else {
		    if ($product->get_regular_price() >= 499) {
		        echo '<p class="free-shipping-details">Acest produs beneficiază de livrare gratuită!</p>';
		    }
		}
	} else {
		if ( $product->is_type( 'variable' ) ) {
			if ($product->get_variation_price($product->get_variation_id()) >= 499) {
				echo '<p class="free-shipping-details">Acest produs beneficiază de livrare gratuită!</p>';
			}
		}
	}
}


// Price Discount & Regular Price Information.

add_filter( 'woocommerce_format_sale_price', 'marketplace_price_sale_information', 10, 3 );

function marketplace_price_sale_information( $price, $regular_price, $sale_price ) {

	if ( is_product() ) {

		    $regular_price = floatval( strip_tags($regular_price) );
	   		$sale_price = floatval( strip_tags($sale_price) );

	    	$percentage = round( ( $regular_price - $sale_price ) / $regular_price * 100 ).'%';
	    	$discount = $regular_price - $sale_price;
	   		$percentage_text = ' ( ' . $percentage . ' ) ';

	    	return '<ins>' . wc_price( $sale_price ) . '</ins>' . '<span class="price_sale_discount">Discount: ' . $discount . ' Lei ' . $percentage_text . '</span>' . '<del><span class="price_regular_before_discount">Preţul Anterior:&nbsp;</span>' . wc_price( $regular_price ) . '</del>';

    } else {

    	return $price;

    }

}


// Enable SKU Search Function.

function marketplace_product_search_join( $join, $query ) {

    if ( ! $query->is_main_query() || is_admin() || ! is_search() || ! is_woocommerce() ) {
        return $join;
    }
 
    global $wpdb;
 
    $join .= " LEFT JOIN {$wpdb->postmeta} marketplace_post_meta ON {$wpdb->posts}.ID = marketplace_post_meta.post_id ";
 
    return $join;
}
 
add_filter( 'posts_join', 'marketplace_product_search_join', 10, 2 );
 
 
function marketplace_product_search_where( $where, $query ) {
    if ( ! $query->is_main_query() || is_admin() || ! is_search() || ! is_woocommerce() ) {
        return $where;
    }
 
    global $wpdb;
 
    $where = preg_replace(
        "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
        "({$wpdb->posts}.post_title LIKE $1) OR (marketplace_post_meta.meta_key = '_sku' AND marketplace_post_meta.meta_value LIKE $1)", $where );
 
    return $where;
}
 
add_filter( 'posts_where', 'marketplace_product_search_where', 10, 2 );




add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'mmx_remove_select_text');

function mmx_remove_select_text( $args ){
	$args['show_option_none'] = '';
	return $args; }


// Variable Product Prices Manipulation.

// // Disable Variation Prices.

// add_filter( 'woocommerce_variable_sale_price_html', 'marketplace_variation_price_format', 10, 2 );
// add_filter( 'woocommerce_variable_price_html', 'marketplace_variation_price_format', 10, 2 );

// function marketplace_variation_price_format( $price, $product ) {

// 	if (is_product()) {
//    		return $product->get_price();
//  	} else {

//         $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
//         $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

//         $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
//         sort( $prices );
//         $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

//         if ( $price !== $saleprice ) {
//         	$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
//         }

//         return $price;
//     }

// }

// // Show Variation Price.

// add_filter('woocommerce_show_variation_price', function() {return true;});

// function woocommerce_template_single_price() {

//     global $product;

// 	    if ( ! $product->is_type('variable') ) { 
// 	        woocommerce_get_template( 'single-product/price.php' );
// 	    }

// }

// New Image Size.

add_image_size( 'variation_thumb', 136, 60 );
add_image_size( 'variation_thumb_tall', 136, 89 );
add_image_size( 'variation_thumb_small', 100, 81 );