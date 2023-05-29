<?php

//use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Essential box Widget.
 *
 * Elementor widget that inserts a box 
 *
 * @since 1.0.0
 */
class Essential_Elementor_box_Widget extends \Elementor\Widget_Base { 
  

  	/**
	 * Get widget name.
	 *
	 * Retrieve Card widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'card';
	}


	/**
	 * Get widget title.
	 *
	 * Retrieve Card widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Essenial box', 'essential-box-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Card widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-header';
	}


	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://google.com/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Card widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Card widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'card', 'box', 'my box', 'essential' ];
	}



	/**
	 * Register Card widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() { 
		// our control function code goes here.

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'essential-box-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Card title', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Your card title here', 'essential-box-widget' ),
			]
		);


		$this->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Card Description', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block'   => true,
				'placeholder' => esc_html__( 'Your card description here', 'essential-box-widget' ),
			]
		);	

		$this->add_control(
      		'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'label_block'   => true,
				'placeholder' => esc_html__( 'Your card Icon here', 'essential-box-widget' ),
			]
    	);

    	$this->add_control(
			'btn_icon_color',
			[
				'label' => __( 'Icon Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#54595F',
			]
    	);
    	
		$this->add_control(
			'btn_hover_icon_color',
			[
				'label' => __( 'Icon Hover Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#B12B2B',
			]
		);
    
	    $this->add_control(
			'btn_text_color',
			[
				'label' => __( 'Text Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#54595F',
			]
	    );

	    $this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6EC1E4',
			]
	    );
    
		$this->add_control(
			'btn_hover_text_color',
			[
				'label' => __( 'Text Hover Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#B12B2B',
			]
		);

		$this->add_control(
			'bg_hover_color',
			[
				'label' => __( 'Background Hover Color', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#61CE70',
			]
		);

		$this->add_control(
			'btn_class',
			[
				'label' => __( 'Class', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'title' => __( 'Enter Button Class', 'essential-box-widget' ),
			]
		);

		$this->add_control(
			'btn_id',
			[
				'label' => __( 'ID', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'title' => __( 'Enter Button ID', 'essential-box-widget' ),
			]
		);

		$this->add_control(
			'mask_image',
			[
				'label' => __( 'Mask Image', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
        		'default' => [ 'url' => '', //Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' => esc_html__( 'Border Style', 'essential-box-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'' => esc_html__( 'Default', 'textdomain' ),
					'none' => esc_html__( 'None', 'textdomain' ),
					'solid'  => esc_html__( 'Solid', 'textdomain' ),
					'dashed' => esc_html__( 'Dashed', 'textdomain' ),
					'dotted' => esc_html__( 'Dotted', 'textdomain' ),
					'double' => esc_html__( 'Double', 'textdomain' ),
				],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
				],
			]
		);


		$this->add_control(
		  'text_align',
		  [
		    'label' => __( 'Alignment',  'essential-box-widget' ),
		    'type' => \Elementor\Controls_Manager::CHOOSE,
		    'options' => [
		      'left' => [
		        'title' => __( 'Left',  'essential-box-widget' ),
		        'icon' => 'fa fa-align-left',
		      ],
		      'center' => [
		        'title' => __( 'Center',  'essential-box-widget' ),
		        'icon' => 'fa fa-align-center',
		      ],
		      'right' => [
		        'title' => __( 'Right',  'essential-box-widget' ),
		        'icon' => 'fa fa-align-right',
		      ],
		    ],
		    'default' => 'center',
		    'toggle' => true,
		  ]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Card widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() { 
		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();
		
		// get the individual values of the input
		$card_title = $settings['card_title'];
		$card_description = $settings['card_description'];
		$card_btn_icon = $settings['btn_icon'];
		$card_btn_icon_color = $settings['btn_icon_color'];
		$card_btn_hover_icon_color = $settings['btn_hover_icon_color'];
		$card_btn_text_color = $settings['btn_text_color'];
		$card_bg_color = $settings['bg_color'];
		$card_btn_hover_text_color = $settings['btn_hover_text_color'];
		$card_bg_hover_color = $settings['bg_hover_color'];
		$card_btn_class = $settings['btn_class'];
		$card_btn_id = $settings['btn_id'];
		//$btn_text = ! empty( $settings['btn_text'] ) ? $settings['btn_text'] : 'Learn More';
		$card_mask_image = $settings['mask_image'];
		$card_border_style = $settings['border_style'];
		$card_text_align = $settings['text_align']; ?>

        <!-- Start rendering the output -->
        <div class="card">
            <h3 class="card_title"><?php echo $card_title;  ?></h3>
            <p class="card__description"><?php echo $card_description;  ?></p>

            <p class="card_btn_icon"><?php //echo $card_btn_icon;  ?></p>
            <p class="card_btn_icon_color"><?php echo $card_btn_icon_color;  ?></p>
            <p class="card_btn_hover_icon_color"><?php echo $card_btn_hover_icon_color;  ?></p>
            <p class="card_btn_text_color"><?php echo $card_btn_text_color;  ?></p>
            <p class="card_bg_color"><?php echo $card_bg_color;  ?></p>
            <p class="card_btn_hover_text_color"><?php echo $card_btn_hover_text_color;  ?></p>
            <p class="card_bg_hover_color"><?php echo $card_bg_hover_color;  ?></p>
            <p class="card_btn_class"><?php echo $card_btn_class;  ?></p>
            <p class="card_btn_id"><?php echo $card_btn_id;  ?></p>
			<?php if(!empty($card_btn_icon['value'])) {
			if($card_btn_icon['library']=="svg") { ?>
				<img src="<?php echo esc_attr( $card_btn_icon['value']['url'] ); ?>" style="height:16px;" />
			<?php } else { ?>
				<i class="<?php echo esc_attr( $card_btn_icon['value'] ); ?>" aria-hidden="true"></i>
			<?php  } } ?>
			<p class="card_btn_id"><?php echo $card_mask_image['url'];  ?></p>
			<p class="card_btn_id"><?php echo $card_border_style;  ?></p>
			<p class="card_btn_id"><?php echo $card_text_align;  ?></p>

        </div>
        <!-- End rendering the output -->
        <?php
	}						
}