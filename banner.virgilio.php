<?php
/*
Plugin Name: Virgilio Widget
Plugin Script: banner.virgilio.php
Description: Grazie a questo widget é possibile visualizzare il banner virgilio sulla sidebar
Version: 1.0
License: GPL 2.0
Author: Giuseppe Frattura
*/

class virgilio_widget extends WP_Widget
{
	public function __construct() 
    {
		parent::WP_Widget( 'virgilio_widget', 'Virgilio', array('description' => 'Grazie a questo widget é possibile visualizzare il banner virgilio sulla sidebar'));
	}
	
	public function form( $instance )
	{
		$defaults = array( 
            'ad_user' => 'Inserisci il tuo id virgilio',
            'ad_site' => 'Inserisci lid del tuo sito',
            'ad_space'=> 'Inserisci il valore ad_Space',
            'sign'    => 'Si'
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_user' ); ?>">
				Ad_User:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad_user' ); ?>" name="<?php echo $this->get_field_name( 'ad_user' ); ?>" value="<?php echo $instance['ad_user']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_site' ); ?>">
				Ad_Site:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad_site' ); ?>" name="<?php echo $this->get_field_name( 'ad_site' ); ?>" value="<?php echo $instance['ad_site']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_space' ); ?>">
				Ad_Space:
			</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad_space' ); ?>" name="<?php echo $this->get_field_name( 'ad_space' ); ?>" value="<?php echo $instance['ad_space']; ?>" />
		</p>	            
		
		<p>	
			<label for="<?php echo $this->get_field_id( 'sign' ); ?>">
				Mostrare la firma del'autore?
			</label>	
			<input class="widefat" type="radio" id="<?php echo $this->get_field_id( 'sign' ); ?>" name="<?php echo $this->get_field_name( 'sign' ); ?>" value='Si' />Si
			<input class="widefat" type="radio" id="<?php echo $this->get_field_id( 'sign' ); ?>" name="<?php echo $this->get_field_name( 'sign' ); ?>" value='No' />No
		</p>
		
		<?php
	}
	
	public function widget( $args, $instance )
	{
		extract( $args );
		?>
			<div class="Virgilio-widget">
			<script type="text/javascript">
				adsignals_ad_user = "<?php echo $instance['ad_user']; ?>";
				adsignals_ad_site = "<?php echo $instance['ad_site']; ?>";
				adsignals_ad_space = "<?php echo $instance['ad_space']; ?>";
				adsignals_ad_width = "300";
				adsignals_ad_height = "250";
				var baJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
				document.write(unescape("%3Cscript src='" + baJsHost + "t.adsignals.com/advertiser.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<?php	
				if($instance['sign']=='Si') echo 'Virgilio Banner Widget creato da <a href="http://www.giuseppefrattura.it">Giuseppe Frattura</a>';
			?>
			</div>
		<?php
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['ad_user'] = strip_tags( $new_instance['ad_user'] );
		$instance['ad_site'] = strip_tags( $new_instance['ad_site'] );
		$instance['ad_space'] = strip_tags( $new_instance['ad_space'] );
		$instance['sign'] = strip_tags( $new_instance['sign'] );

		return $instance;
	}                     
}

function virgilio_widgets()
{
	register_widget( 'virgilio_widget' );
}

add_action( 'widgets_init', 'virgilio_widgets' );
?>