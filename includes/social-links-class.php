<?php
class Social_Links_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(

            'description' => __('Outputs social icons linked to profiles','sl_domain')
        );
        parent::__construct( 'social_links_widget', __('Social Links Widget','sl_domain'), $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        $links=array(
            'facebook'=>esc_attr($instance['facebook_link']),
            'twitter'=>esc_attr($instance['twitter_link']),
            'linkedin'=>esc_attr($instance['linkedin_link']),
            'google'=>esc_attr($instance['google_link'])


        );
        $icons=array(
            'facebook'=>esc_attr($instance['facebook_icon']),
            'twitter'=>esc_attr($instance['twitter_icon']),
            'linkedin'=>esc_attr($instance['linkedin_icon']),
            'google'=>esc_attr($instance['google_icon']),
        );
        $icon_width=$instance['icon_width'];
        echo $args['before_widget'];
        $this->getSocialLinks($links,$icons,$icon_width);
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
    $this->getForm($instance);
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance=array(
            'facebook_link'=>(!empty($new_instance['facebook_link']))?strip_tags($new_instance['facebook_link']):'',
            'twitter_link'=>(!empty($new_instance['twitter_link']))?strip_tags($new_instance['twitter_link']):'',
            'linkedin_link'=>(!empty($new_instance['linkedin_link']))?strip_tags($new_instance['linkedin_link']):'',
             'google_link'=>(!empty($new_instance['google_link']))?strip_tags($new_instance['google_link']):'',
             'facebook_icon'=>(!empty($new_instance['facebook_icon']))?strip_tags($new_instance['facebook_icon']):'',
             'twitter_icon'=>(!empty($new_instance['twitter_icon']))?strip_tags($new_instance['twitter_icon']):'',
             'linkedin_icon'=>(!empty($new_instance['linkedin_icon']))?strip_tags($new_instance['linkedin_icon']):'',
             'google_icon'=>(!empty($new_instance['google_icon']))?strip_tags($new_instance['google_icon']):'',
             'icon_width'=>(!empty($new_instance['icon_width']))?strip_tags($new_instance['icon_width']):''
        );
        return $instance;
    }
    public function getForm($instance){
        if(isset($instance['facebook_link'])){
            $facebook_link=esc_attr($instance['facebook_link']);
        }
        else{
            $facebook_link='http://www.facebook.com';
        }
        if(isset($instance['twitter_link'])){
            $twitter_link=esc_attr($instance['twitter_link']);
        }
        else{
            $twitter_link='https://www.twitter.com';
        }
        if(isset($instance['linkedin_link'])){
            $linkedin_link=esc_attr($instance['linkedin_link']);
        }
        else{
            $linkedin_link='http://www.linkedin.com';
        }
        if(isset($instance['google_link'])){
            $google_link=esc_attr($instance['google_link']);
        }
        else{
            $google_link='http://www.facebook.com';
        }
        if(isset($instance['facebook_icon'])){
            $facebook_icon=esc_attr($instance['facebook_icon']);
        }
        else{
            $facebook_icon=plugins_url().'/social-links/img/facebook.png';
        }
        if(isset($instance['twitter_icon'])){
            $twitter_icon=esc_attr($instance['twitter_icon']);
        }
        else{
            $twitter_icon=plugins_url().'/social-links/img/twitter.png';
        }
        if(isset($instance['linkedin_icon'])){
            $linkedin_icon=esc_attr($instance['linkedin_icon']);
        }
        else{
            $linkedin_icon=plugins_url().'/social-links/img/linkedin.png';
        }
        if(isset($instance['google_icon'])){
            $google_icon=esc_attr($instance['google_icon']);
        }
        else{
            $google_icon=plugins_url().'/social-links/img/google.png';
        }
        if(isset($instance['icon_width'])){
            $icon_width=esc_attr($instance['icon_width']);
        }
        else{
            $icon_width=32;
        }
        ?>

<p><label for="<?php $this->get_field_id('facebook_link');?>"><?php _e('Facebook Link');?></label>
<input class="widefat" id="<?php echo $this->get_field_id('facebook_link');?>" name="<?php echo $this->get_field_name('facebook_link');?>" type="text" value="<?php echo esc_attr($facebook_link);?>"></p>
<p><label for="<?php $this->get_field_id('twitter_link');?>"><?php _e('Twitter Link');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitter_link');?>" name="<?php echo $this->get_field_name('twitter_link');?>" type="text" value="<?php echo esc_attr($twitter_link);?>"></p>
<p><label for="<?php $this->get_field_id('linkedin_link');?>"><?php _e('Linkedin Link');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('linkedin_link');?>" name="<?php echo $this->get_field_name('linkedin_link');?>" type="text" value="<?php echo esc_attr($linkedin_link);?>"></p>
<p><label for="<?php $this->get_field_id('google_link');?>"><?php _e('Google Link');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('google_link');?>" name="<?php echo $this->get_field_name('google_link');?>" type="text" value="<?php echo esc_attr($google_link);?>"></p>
        <p><label for="<?php $this->get_field_id('facebook_icon');?>"><?php _e('Facebook Icon');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_icon');?>" name="<?php echo $this->get_field_name('facebook_icon');?>" type="text" value="<?php echo esc_attr($facebook_icon);?>"></p>
        <p><label for="<?php $this->get_field_id('twitter_icon');?>"><?php _e('Twitter Icon');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_icon');?>" name="<?php echo $this->get_field_name('twitter_icon');?>" type="text" value="<?php echo esc_attr($twitter_icon);?>"></p>
        <p><label for="<?php $this->get_field_id('linkedin_icon');?>"><?php _e('Linkedin Icon');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin_icon');?>" name="<?php echo $this->get_field_name('linkedin_icon');?>" type="text" value="<?php echo esc_attr($linkedin_icon);?>"></p>

        <p><label for="<?php $this->get_field_id('google_icon');?>"><?php _e('Google Icon');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('google_icon');?>" name="<?php echo $this->get_field_name('google_icon');?>" type="text" value="<?php echo esc_attr($google_icon);?>"></p>
<p><label for="<?php $this->get_field_id('icon_width');?>"><?php _e('Icon width');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('icon_width');?>" name="<?php echo $this->get_field_name('icon_width');?>" type="text" value="<?php echo esc_attr($icon_width);?>"></p>
<?php
}
    public function getSocialLinks($links,$icons,$icon_width){
        ?>
<div class="social_links">
    <a target="_blank" href="<?php echo esc_attr($links['facebook']);?>"><img width="<?php echo esc_attr($icon_width);?>" src="<?php echo esc_attr($icons['facebook']);?>"></a>
    <a target="_blank" href="<?php echo esc_attr($links['twitter']);?>"><img width="<?php echo esc_attr($icon_width);?>" src="<?php echo esc_attr($icons['twitter']);?>"></a>
    <a target="_blank" href="<?php echo esc_attr($links['linkedin']);?>"><img width="<?php echo esc_attr($icon_width);?>" src="<?php echo esc_attr($icons['linkedin']);?>"></a>
    <a target="_blank" href="<?php echo esc_attr($links['google']);?>"><img width="<?php echo esc_attr($icon_width);?>" src="<?php echo esc_attr($icons['google']);?>"></a>
</div>
<?php
    }
}