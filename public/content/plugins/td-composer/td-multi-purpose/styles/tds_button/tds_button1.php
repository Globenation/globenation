<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_button1 extends td_style {

    private $unique_style_class;
	private $atts = array();
	private $index_style;

	function __construct( $atts, $index_style = '') {
		$this->atts = $atts;
		$this->index_style = $index_style;
	}

	private function get_css() {

		$compiled_css = '';

        $unique_style_class = $this->unique_style_class;

		$raw_css =
			"<style>

				/* @background_solid */
				body .$unique_style_class {
					background-color: @background_solid;
				}
				/* @background_gradient */
				body .$unique_style_class {
					@background_gradient
				}

				/* @background_hover_solid */
				body .$unique_style_class:before {
					background-color: @background_hover_solid;
				}
				/* @background_hover_gradient */
				body .$unique_style_class:before {
					@background_hover_gradient
				}
				body .$unique_style_class:hover:before {
					opacity: 1;
				}

				/* @text_color_solid */
				.$unique_style_class .tdm-btn-text,
				.$unique_style_class i {
					color: @text_color_solid;
				}
				/* @text_color_gradient */
				.$unique_style_class .tdm-btn-text,
				.$unique_style_class i {
					@text_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class .tdm-btn-text,
				.td-md-is-ios .$unique_style_class i {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class .tdm-btn-text,
				html[class*='ie'] .$unique_style_class i,
				.td-md-is-ios .$unique_style_class .tdm-btn-text,
				.td-md-is-ios .$unique_style_class i {
				    background: none;
					color: @text_color_gradient_1;
				}
				/* @text_hover_color */
				body .$unique_style_class:hover .tdm-btn-text,
				body .$unique_style_class:hover i {
					color: @text_hover_color;
				}
				/* @text_hover_gradient */
				body .$unique_style_class:hover .tdm-btn-text,
				body .$unique_style_class:hover i {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}

				/* @icon_color_solid */
				.$unique_style_class i {
					color: @icon_color_solid;
				    -webkit-text-fill-color: unset;
    				background: transparent;
				}
				/* @icon_color_gradient */
				.$unique_style_class i {
					@icon_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class i {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class i,
				.td-md-is-ios .$unique_style_class i {
				    background: none;
					color: @icon_color_gradient_1;
				}

				/* @icon_hover_color */
				body .$unique_style_class:hover i {
					color: @icon_hover_color;
				}
				/* @icon_hover_gradient */
				body .$unique_style_class:hover i {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}

				/* @button_width */
                .$unique_style_class {
                    min-width: @button_width;
                }
				/* @button_icon_size */
				.$unique_style_class i {
					font-size: @button_icon_size;
				}
				/* @icon_left_margin */
				.$unique_style_class i:last-child {
					margin-left: @icon_left_margin;
				}
				/* @icon_right_margin */
				.$unique_style_class i:first-child {
					margin-right: @icon_right_margin;
				}
				/* @border_radius */
				.$unique_style_class,
				.$unique_style_class:before {
					border-radius: @border_radius;
				}



				/* @f_btn_text */
				.$unique_style_class {
					@f_btn_text
				}
				/* @f_btn_text_line_height */
				.$unique_style_class {
					height: auto;
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts, $this->index_style );

        $compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

    /**
     * Callback pe media
     *
     * @param $res_ctx td_res_context
     */
    static function cssMedia( $res_ctx ) {

        // button width
        $button_width = $res_ctx->get_shortcode_att( 'button_width' );
        $res_ctx->load_settings_raw( 'button_width', $button_width );
        if( $button_width != '' ) {
            if( is_numeric( $button_width ) ) {
                $res_ctx->load_settings_raw( 'button_width', $button_width . 'px' );
            }
        }



        /*-- BACKGROUND-- */
        // background color
        $res_ctx->load_color_settings( 'background_color', 'background_solid', 'background_gradient', '', '', __CLASS__ );

        // background hover color
        $res_ctx->load_color_settings( 'background_hover_color', 'background_hover_solid', 'background_hover_gradient', '', '', __CLASS__ );



        /*-- TEXT -- */
        // text color
        $res_ctx->load_color_settings( 'text_color', 'text_color_solid', 'text_color_gradient', 'text_color_gradient_1', '', __CLASS__ );

        // text hover color
        $text_hover_color = $res_ctx->get_style_att( 'text_hover_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'text_hover_color', $text_hover_color);
        if ( !empty ($text_hover_color ) ) {
            $res_ctx->load_settings_raw( 'text_hover_gradient', 1 );
        }



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('button_icon_size' );
        $res_ctx->load_settings_raw( 'button_icon_size', $icon_size );
        if( $icon_size != '' ) {
            if( is_numeric( $icon_size ) ) {
                $res_ctx->load_settings_raw( 'button_icon_size', $icon_size . 'px' );
            }
        }

        // icon space
        $button_icon = $res_ctx->get_shortcode_att('button_tdicon' );
        if ( !empty ( $button_icon ) ) {
            $icon_space = $res_ctx->get_shortcode_att( 'button_icon_space' );

            if ( $res_ctx->get_shortcode_att( 'button_icon_position' ) === '') {
                if ( is_numeric( $icon_space ) ) {
                    $res_ctx->load_settings_raw( 'icon_left_margin', $icon_space . 'px' );
                } else {
                    $res_ctx->load_settings_raw( 'icon_left_margin', $icon_space );
                }
            } else {
                if ( is_numeric( $icon_space ) ) {
                    $res_ctx->load_settings_raw( 'icon_right_margin', $icon_space . 'px' );
                } else {
                    $res_ctx->load_settings_raw( 'icon_right_margin', $icon_space );
                }
            }
        }

        // icon color
        $res_ctx->load_color_settings( 'icon_color', 'icon_color_solid', 'icon_color_gradient', 'icon_color_gradient_1', '', __CLASS__ );

        // icon hover color
        $icon_hover_color = $res_ctx->get_style_att( 'icon_hover_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_hover_color', $icon_hover_color);
        if ( !empty ($icon_hover_color ) ) {
            $res_ctx->load_settings_raw( 'icon_hover_gradient', 1 );
        }



        /*-- BORDER -- */
        // border radius
        $border_radius = $res_ctx->get_style_att( 'border_radius', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' ) {
            if( is_numeric( $border_radius ) ) {
                $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
            }
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_btn_text', __CLASS__ );
        $res_ctx->load_settings_raw( 'f_btn_text_line_height', $res_ctx->get_style_att( 'f_btn_text_font_line_height', __CLASS__ ) );

    }

	function render( $index_style = '' ) {

		if ( ! empty( $index_style ) ) {
			$this->index_style = $index_style;
		}
        $this->unique_style_class = td_global::td_generate_unique_id();

        $icon = $this->get_shortcode_att( 'button_tdicon', $this->index_style );
        $icon_position = $this->get_shortcode_att( 'button_icon_position', $this->index_style );

        $target = '';
        if ( '' !== $this->get_shortcode_att('button_open_in_new_window', $this->index_style) ) {
            $target = ' target="_blank" ';
        }

		$button_url = $this->get_shortcode_att('button_url', $this->index_style);
		if ( '' == $button_url) {
			$button_url = '#';
		}

        $buffy_icon = '';
        if ( !empty( $icon ) ) {
            $buffy_icon .= '<i class="' . $icon . '"></i>';
        }

		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
		$buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' td-fix-index">';
		    $buffy .= '<a href="' . $button_url . '" class="' . self::get_class_style(__CLASS__) . ' tdm-btn ' . $this->get_shortcode_att('button_size', $this->index_style) . ' ' . $this->unique_style_class . '" ' . $target . '>';
                if ( $icon_position == 'icon-before' ) {
                    $buffy .= $buffy_icon;
                }

		        $buffy .= '<span class="tdm-btn-text">' . $this->get_shortcode_att('button_text', $this->index_style) . '</span>';

                if ( $icon_position == '' ) {
                    $buffy .= $buffy_icon;
                }
            $buffy .= '</a>';
		$buffy .= '</div>';

		return $buffy;
	}

	function get_style_att( $att_name ) {
		return $this->get_att( $att_name ,__CLASS__, $this->index_style );
	}

	function get_atts() {
		return $this->atts;
	}
}