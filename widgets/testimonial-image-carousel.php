<?php

use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use ElementorPro\Modules\Carousel\Widgets\Base;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Testimonial_Image_Carousel extends Base {

    public function get_name() {
        return 'testimonial-image-carousel';
    }

    public function get_title() {
        return __( 'Testimonial Image Carousel', 'pcgelementor-extended' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_keywords() {
        return [ 'testimonial', 'carousel', 'image' ];
    }

    protected function _register_controls() {
        parent::_register_controls();

        $this->start_injection( [
            'of' => 'slides',
        ] );

        $this->add_control(
            'skin',
            [
                'label' => __( 'Skin', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'pcgelementor-extended' ),
                    'bubble' => __( 'Bubble', 'pcgelementor-extended' ),
                ],
                'prefix_class' => 'elementor-testimonial--skin-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image_inline',
                'options' => [
                    'image_inline' => __( 'Image Inline', 'pcgelementor-extended' ),
                    'image_stacked' => __( 'Image Stacked', 'pcgelementor-extended' ),
                    'image_above' => __( 'Image Above', 'pcgelementor-extended' ),
                    'image_left' => __( 'Image Left', 'pcgelementor-extended' ),
                    'image_right' => __( 'Image Right', 'pcgelementor-extended' ),
                ],
                'prefix_class' => 'elementor-testimonial--layout-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'pcgelementor-extended' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'pcgelementor-extended' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'pcgelementor-extended' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'pcgelementor-extended' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-testimonial--align-',
            ]
        );

        $this->end_injection();

        $this->start_controls_section(
            'section_skin_style',
            [
                'label' => __( 'Bubble', 'pcgelementor-extended' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'skin' => 'bubble',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Padding', 'pcgelementor-extended' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'right' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__footer' => 'padding-top: {{TOP}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__footer' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'pcgelementor-extended' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border',
            [
                'label' => __( 'Border', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'border-style: solid',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-testimonial__content:after' => 'border-color: transparent {{VALUE}} {{VALUE}} transparent',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label' => __( 'Border Width', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__content, {{WRAPPER}} .elementor-testimonial__content:after' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__content:after' => 'margin-top: -{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__content:after' => 'margin-bottom: -{{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_injection( [
            'at' => 'before',
            'of' => 'section_navigation',
        ] );

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', 'pcgelementor-extended' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_gap',
            [
                'label' => __( 'Gap', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__footer,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__footer' => 'margin-top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__footer' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__footer' => 'padding-right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__footer' => 'padding-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Text Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__text' => 'color: {{VALUE}}',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__text',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'name_title_style',
            [
                'label' => __( 'Name', 'pcgelementor-extended' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __( 'Text Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__name' => 'color: {{VALUE}}',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__name',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'heading_title_style',
            [
                'label' => __( 'Title', 'pcgelementor-extended' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__title' => 'color: {{VALUE}}',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial__title',
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image', 'pcgelementor-extended' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => __( 'Size', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__content:after' => 'top: calc( {{text_padding.TOP}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px );',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_stacked:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked.elementor-testimonial--align-left .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-left .elementor-testimonial__content:after' => 'left: calc( {{text_padding.LEFT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); right:auto;',

                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_stacked:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_stacked.elementor-testimonial--align-right .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-right .elementor-testimonial__content:after' => 'right: calc( {{text_padding.RIGHT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); left:auto;',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-right) .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-left .elementor-testimonial__content:after' => 'left: calc( {{text_padding.LEFT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); right:auto;',

                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above:not(.elementor-testimonial--align-center):not(.elementor-testimonial--align-left) .elementor-testimonial__content:after,
					{{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-right .elementor-testimonial__content:after' => 'right: calc( {{text_padding.RIGHT}}{{text_padding.UNIT}} + ({{SIZE}}{{UNIT}} / 2) - 8px ); left:auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_gap',
            [
                'label' => __( 'Gap', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-left .elementor-testimonial__image + cite, 
					body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-left .elementor-testimonial__image + cite,
					body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__image + cite, 
					body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__image + cite' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',

                    'body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_inline.elementor-testimonial--align-right .elementor-testimonial__image + cite, 
					body:not(.rtl) {{WRAPPER}}.elementor-testimonial--layout-image_above.elementor-testimonial--align-right .elementor-testimonial__image + cite,
					body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_inline .elementor-testimonial__image + cite,
					body.rtl {{WRAPPER}}.elementor-testimonial--layout-image_above .elementor-testimonial__image + cite' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left:0;',

                    '{{WRAPPER}}.elementor-testimonial--layout-image_stacked .elementor-testimonial__image + cite, 
					{{WRAPPER}}.elementor-testimonial--layout-image_left .elementor-testimonial__image + cite,
					{{WRAPPER}}.elementor-testimonial--layout-image_right .elementor-testimonial__image + cite' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'image_border',
            [
                'label' => __( 'Border', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-style: solid',
                ],
            ]
        );

        $this->add_control(
            'image_border_color',
            [
                'label' => __( 'Border Color', 'pcgelementor-extended' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'image_border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_width',
            [
                'label' => __( 'Border Width', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'image_border' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'pcgelementor-extended' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->end_injection();

        $this->update_responsive_control(
            'width',
            [
                'selectors' => [
                    '{{WRAPPER}}.elementor-arrows-yes .elementor-main-swiper' => 'width: calc( {{SIZE}}{{UNIT}} - 40px )',
                    '{{WRAPPER}} .elementor-main-swiper' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->update_responsive_control(
            'slides_per_view',
            [
                'condition' => null,
            ]
        );

        $this->update_control(
            'slides_to_scroll',
            [
                'condition' => null,
            ]
        );

        $this->remove_control( 'effect' );
        $this->remove_responsive_control( 'height' );
        $this->remove_control( 'pagination_position' );
    }

    protected function add_repeater_controls( Repeater $repeater ) {
        $repeater->add_control(
            'content',
            [
                'label' => __( 'Content', 'pcgelementor-extended' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Logo', 'pcgelementor-extended' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'cover',
            [
                'label' => __( 'Cover', 'pcgelementor-extended' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Name', 'pcgelementor-extended' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'John Doe', 'pcgelementor-extended' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'pcgelementor-extended' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'CEO', 'pcgelementor-extended' ),
            ]
        );
    }

    protected function get_repeater_defaults() {
        $placeholder_image_src = Utils::get_placeholder_image_src();

        return [
            [
                'content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pcgelementor-extended' ),
                'name' => __( 'John Doe', 'pcgelementor-extended' ),
                'title' => __( 'CEO', 'pcgelementor-extended' ),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
                'cover' => [
                    'url' => $placeholder_image_src,
                ],
            ],
            [
                'content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pcgelementor-extended' ),
                'name' => __( 'John Doe', 'pcgelementor-extended' ),
                'title' => __( 'CEO', 'pcgelementor-extended' ),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
                'cover' => [
                    'url' => $placeholder_image_src,
                ],
            ],
            [
                'content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pcgelementor-extended' ),
                'name' => __( 'John Doe', 'pcgelementor-extended' ),
                'title' => __( 'CEO', 'pcgelementor-extended' ),
                'image' => [
                    'url' => $placeholder_image_src,
                ],
                'cover' => [
                    'url' => $placeholder_image_src,
                ],
            ],
        ];
    }

    private function print_cite( $slide, $location ) {
        if ( empty( $slide['name'] ) && empty( $slide['title'] ) ) {
            return '';
        }

        $skin = $this->get_settings( 'skin' );
        $layout = 'bubble' === $skin ? 'image_inline' : $this->get_settings( 'layout' );
        $locations_outside = [ 'image_above', 'image_right', 'image_left' ];
        $locations_inside = [ 'image_inline', 'image_stacked' ];

        $print_outside = ( 'outside' === $location && in_array( $layout, $locations_outside ) );
        $print_inside = ( 'inside' === $location && in_array( $layout, $locations_inside ) );

        $html = '';
        if ( $print_outside || $print_inside ) {
            $html = '<cite class="elementor-testimonial__cite">';
            if ( ! empty( $slide['name'] ) ) {
                $html .= '<span class="elementor-testimonial__name">' . $slide['name'] . '</span>';
            }
            if ( ! empty( $slide['title'] ) ) {
                $html .= '<span class="elementor-testimonial__title">' . $slide['title'] . '</span>';
            }
            $html .= '</cite>';
        }

        return $html;
    }

    protected function print_slide( array $slide, array $settings, $element_key ) {
        $this->add_render_attribute( $element_key . '-testimonial', [
            'class' => 'elementor-testimonial',
        ] );

        if ( ! empty( $slide['image']['url'] ) ) {
            $this->add_render_attribute( $element_key . '-image', [
                'src' => $this->get_slide_image_url( $slide, $settings ),
                'alt' => ! empty( $slide['name'] ) ? $slide['name'] : '',
            ] );
        }

        if ( ! empty( $slide['cover']['url'] ) ) {
            $this->add_render_attribute( $element_key . '-cover', [
                'src' => $this->get_slide_cover_url( $slide, $settings ),
                'alt' => ! empty( $slide['name'] ) ? $slide['name'] : '',
            ] );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( $element_key . '-testimonial' ); ?>>
            <div class="elementor-row">
                <div class="elementor-element elementor-column elementor-col-50 elementor-top-column">
                    <?php if ( $slide['cover']['url'] ) : ?>
                        <div class="elementor-testimonial__cover">
                            <img <?php echo $this->get_render_attribute_string( $element_key . '-cover' ); ?>>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="elementor-element elementor-column elementor-col-50 elementor-top-column elementor-testimonial__content__wrap">
                    <?php if ( $slide['content'] ) : ?>
                        <div class="elementor-testimonial__content">
                            <div class="elementor-testimonial__text">
                                <?php echo $slide['content']; ?>
                            </div>
                            <?php echo $this->print_cite( $slide, 'outside' ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="elementor-testimonial__footer">
                        <?php if ( $slide['image']['url'] ) : ?>
                            <div class="elementor-testimonial__image">
                                <img <?php echo $this->get_render_attribute_string( $element_key . '-image' ); ?>>
                            </div>
                        <?php endif; ?>
                        <?php echo $this->print_cite( $slide, 'inside' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function render() {
        $this->print_slider();
    }

    protected function get_slide_cover_url( $slide, array $settings ) {
        $image_url = Group_Control_Image_Size::get_attachment_image_src( $slide['cover']['id'], 'image_size', $settings );

        if ( ! $image_url ) {
            $image_url = $slide['cover']['url'];
        }

        return $image_url;
    }
}
