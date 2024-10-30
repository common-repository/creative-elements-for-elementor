<?php

/**
 * Team Widget.
 *
 * @since 1.0.0
 *
 */

namespace CreativeEle\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class CE_Team extends Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);

        wp_register_style('ce-team', CREATIVE_ELE_DIR_URL . 'assets/css/team.min.css', false, CREATIVE_ELE_VERSION);
    }

    public function get_name()
    {
        return 'ce-team';
    }

    public function get_title()
    {
        return __('Team', 'creative-ele');
    }

    public function get_icon()
    {
        return 'ce ce-avatar';
    }

    public function get_categories()
    {
        return ['ce-widget-category'];
    }

    public function get_keywords()
    {
        return ['creative', 'team', 'person', 'people'];
    }

    public function get_style_depends()
    {
        return ['ce-team'];
    }

    /**
     * Register Team widget controls.
     *
     */

    protected function _register_controls()
    {

        $this->start_controls_section(
            'team_section',
            [
                'label' => __('Team', 'creative-ele'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'team_member_image',
            [
                'label' => __('Image', 'creative-ele'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'team_member_image_size',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'team_member_name',
            [
                'label' => __('Name', 'creative-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Golam Kibria',
            ]
        );

        $this->add_control(
            'member_designation',
            [
                'label' => __('Designation', 'creative-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Wordpress Developer',
            ]
        );

        $this->add_control(
            'member_about',
            [
                'label' => __('About', 'creative-ele'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __('Some text about the member...', 'creative-ele'),
            ]
        );

        $this->end_controls_section();

        // Social Media Links

        $this->start_controls_section(
            'ce_member_social_link',
            [
                'label' => __('Social Links', 'creative-ele'),
            ]
        );

        $this->add_control(
            'show_social_links',
            [
                'label' => __('Show Social Links', 'creative-ele'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'creative-ele'),
                'label_off' => __('Hide', 'creative-ele'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ce_social_title',
            [
                'label' => __('Title', 'creative-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Facebook',
            ]
        );

        $repeater->add_control(
 
            'ce_social_link',
            [
                'label' => __( 'Link', 'creative-ele' ),
                'type' => Controls_Manager::TEXT,

            ]
        );

        $repeater->add_control(
            'ce_social_icon',
            [
                'label' => __('Icon', 'creative-ele'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'ce_icon_color',
            [
                'label' => __('Icon Color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUES}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUES}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_background',
            [
                'label' => __('Icon Background', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'background-color: {{VALUES}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'color: {{VALUES}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_hover_background',
            [
                'label' => __('Icon Hover Background', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#25CCF7',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'background-color: {{VALUES}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_border',
            [
                'label' => __('Icon Border', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_border_color',
            [
                'label' => __('Icon border color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'border-color: {{VALUES}}',
                ],
            ]
        );

        $repeater->add_control(
            'ce_icon_hover_border_color',
            [
                'label' => __('Icon Hover border color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#25CCF7',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'border-color: {{VALUES}}',
                ],
            ]
        );

        $this->add_control(
            'ce_team_social_link_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ce_social_title' => __('Facebook', 'creative-ele'),
                        'ce_social_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                        'ce_social_link' => __('#', 'creative-ele'),
                    ],
                    [
                        'ce_social_title' => __('Twitter', 'creative-ele'),
                        'ce_social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'ce_social_link' => __('#', 'creative-ele'),
                    ],
                    [
                        'ce_social_title' => __('LinkedIn', 'creative-ele'),
                        'ce_social_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-brands',
                        ],
                        'ce_social_link' => __('#', 'creative-ele'),
                    ],
                ],
                'title_field' => '{{{ ce_social_title }}}',
                'condition' => [
                    'show_social_links' => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tabs();

        $this->end_controls_section();

        /**
         *
         * Style Tab
         *
         * General Style
         *
         */

        $this->start_controls_section(
            'ce_team_general_style',
            [
                'label' => __('General', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Gradient Style
        $this->add_control(
            'gradient_style',
            [
                'label' => __('Gradient', 'creative-ele'),
                'type' => Controls_Manager::SELECT,
                'default' => 'gs_default',
                'options' => [
                    'gs_one' => __('Style 1', 'creative-ele'),
                    'gs_two' => __('Style 2', 'creative-ele'),
                    'gs_three' => __('Style 3', 'creative-ele'),
                    'gs_four' => __('Style 4', 'creative-ele'),
                    'gs_five' => __('Style 5', 'creative-ele'),
                    'gs_default' => __('Default', 'creative-ele'),
                ],
            ]
        );

        // Background Color
        $this->add_control(
            'team_background_color',
            [
                'label' => __('Background', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .team-single' => 'background-color: {{VALUES}}',
                ],
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'team_border_radius',
            [
                'label' => __('Border Radius', 'creative-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'top' => 8,
                    'left' => 8,
                    'bottom' => 8,
                    'right' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Drop Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ce_box_shadow',
                'label' => __('Box Shadow', 'creative-ele'),
                'fields_options' => [
                    'box_shadow_type' => [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 25,
                            'spread' => 0,
                            'color' => 'rgba(0,0,0,0.1)',
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} .team-single',
            ]
        );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'ce_team_image_style',
            [
                'label' => __('Image', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ce_team_image_spacing',
            [
                'label' => __('Bottom Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .colorbg' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'creative-ele'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                        ],
                    ],
                    'color' => [
                        'default' => '#333333',
                    ],
                ],
                'selector' => '{{WRAPPER}} .p_photo img',
            ]
        );

        $this->add_responsive_control(
            'border-radius',
            [
                'label' => __('Border Radius', 'creative-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'unit' => '%',
                    'top' => 100,
                    'left' => 100,
                    'bottom' => 100,
                    'right' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_photo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Style
        $this->start_controls_section(
            'ce_team_name_style',
            [
                'label' => __('Name', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'team_name_margin',
            [
                'label' => __('Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'team_name_color',
            [
                'label' => __('Color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .p_name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_name_typography',
                'selector' => '{{WRAPPER}} .p_name',
            ]
        );

        $this->end_controls_section();

        // Designation Style
        $this->start_controls_section(
            'ce_team_designation_style',
            [
                'label' => __('Designation', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'team_designation_margin',
            [
                'label' => __('Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'team_designation_color',
            [
                'label' => __('Color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#636e72',
                'selectors' => [
                    '{{WRAPPER}} .p_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_designation_typography',
                'selector' => '{{WRAPPER}} .p_title',
            ]
        );

        $this->end_controls_section();

        // About Style
        $this->start_controls_section(
            'ce_team_about_style',
            [
                'label' => __('About', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'team_about_margin',
            [
                'label' => __('Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_info' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'team_about_color',
            [
                'label' => __('Color', 'creative-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .p_about' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_about_typography',
                'selector' => '{{WRAPPER}} .p_about',
            ]
        );

        $this->end_controls_section();

        // Social Icon Style
        $this->start_controls_section(
            'ce_team_social_icon_style',
            [
                'label' => __('Social Icon', 'creative-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ce_team_social_icon_bm',
            [
                'label' => __('Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .s_icon_wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ce_team_social_icon_hm',
            [
                'label' => __('Icon Spacing', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .s_icon_wrapper li' => 'margin: 0 {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ce_social_icon-size',
            [
                'label' => __('Font Size', 'creative-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .s_icon_wrapper li i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'ce_team_social_icons_padding',
            [
                'label' => __('Padding', 'creative-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                ],

                'selectors' => [
                    '{{WRAPPER}} .s_icon_wrapper li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Team widget output on the frontend.
     *
     */

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        echo '<div class="team-single">';

        // Gradient Style
        echo '<span class="colorbg ' . esc_attr( $settings['gradient_style'] ) . ' "></span>';

        // Member Avatar
        echo '<figure class="p_photo">';
        echo Group_Control_Image_Size::get_attachment_image_html($settings, 'team_member_image_size', 'team_member_image');
        echo '</figure>';

        // Member Info
        echo '<div class="p_info">';
        if ($settings['team_member_name'] !== "") {
            echo '<h5 class="p_name">' . esc_html( $settings['team_member_name'] ) . '</h5>';
        }
        if ($settings['member_designation'] !== "") {
            echo '<h6 class="p_title">' . esc_html( $settings['member_designation'] ) . '</h6>';
        }
        if ($settings['member_designation'] !== "") {
            echo '<span class="p_about">' . esc_html( $settings['member_about'] ) . '</span>';
        }
        echo '</div>';

        // Social Links
        if ($settings['show_social_links'] == "yes") {
            echo '<ul class="s_icon_wrapper">';
            foreach ($settings['ce_team_social_link_list'] as $sociallink):

                echo '<li class="elementor-repeater-item-' . esc_attr( $sociallink['_id'] ) . '" >
								<a href="' . esc_url( $sociallink['ce_social_link'] ) . ' " >';
                \Elementor\Icons_Manager::render_icon($sociallink['ce_social_icon'], ['aria-hidden' => 'true']);
                echo '</a></li>';
            endforeach;
            echo '</ul>';
        }

        echo '</div>';
    }

}
