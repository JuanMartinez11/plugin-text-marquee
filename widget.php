<?php
class wp_tm_widget extends WP_Widget {

    function __construct(){
        // Constructor del Widget.
        $widget_ops = array('classname' => 'wptm_widget', 'description' => "Dynamic marquee text" );
        $this->WP_Widget('wptm_widget', "Text Marquee", $widget_ops);
    }

    function widget($args,$instance){
        // Contenido del Widget que se mostrará en la Sidebar
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $class = substr(str_shuffle($permitted_chars), 0, 10);
        echo $before_widget;
        ?>
        <style>
             .scroll-<?=$class?> {
             top: 0;
             white-space: nowrap;
             <?php
             if($instance["wptm_orientation"] == 'vertical'){
              ?>               
             -webkit-transform: rotate(-90deg);
             -webkit-transform-origin: 50% 50%;
             -moz-transform-origin: 50% 50%;
             <?php
                }
             ?>
             /* overflow: hidden; */
             background: transparent;
             z-index: 99 !important;
             color: <?=$instance["wptm_color"]?>;	
             font-size: <?=$instance["wptm_size"]?>px;
                     }
                     <?php
             if($instance["wptm_orientation"] == 'vertical'){
              ?>               
             .container-scroll-<?=$class?>{
                    top: 0;
                    white-space: nowrap;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: <?=$instance["wptm_height"]?>vh;
                    width: <?=$instance["wptm_width"]?>px;
                     }
             <?php
                }else{
             ?>           
           .container-scroll-<?=$class?>{
               position: relative;
               width:100%;
               max-width:100%;	
               overflow: hidden;		
               height: <?=$instance["wptm_height"]?>px;  
             }
             <?php
                }
             ?>
           
         </style>
        <div class="container-scroll-<?=$class?>">
	            <div class="scroll-<?=$class?>"><?=$instance["wptm_text"]?></div>
        </div>
        <!--Script Marquee-->
        <script>
            jQuery(document).ready(function() {
            
                var text_ = jQuery(".scroll-<?=$class?>").text();
                for(var i=0; i<999; i++){
                        jQuery(".scroll-<?=$class?>").append("&nbsp;"+text_);
                    }
                jQuery(".scroll-<?=$class?>").bind('beforeStarting', function () {                        
                    }).marquee({
                    speed: '<?=$instance["wptm_speed"]?>',
                    gap: 50,
                    delayBeforeStart: 0,
                    direction: 'left',
                    duplicated: false,
                    pauseOnHover: true,
                    startVisible:true
                });  
                });
	    </script>
        <?php
          echo $after_widget;
    }

    function update($new_instance, $old_instance){
        // Función de guardado de opciones
        $instance = $old_instance;
        $instance["wptm_text"] =        strip_tags($new_instance["wptm_text"]);
        $instance["wptm_orientation"] = strip_tags($new_instance["wptm_orientation"]);
        $instance["wptm_speed"] =       strip_tags($new_instance["wptm_speed"]);
        $instance["wptm_width"] =       strip_tags($new_instance["wptm_width"]);
        $instance["wptm_height"] =      strip_tags($new_instance["wptm_height"]);
        $instance["wptm_size"] =        strip_tags($new_instance["wptm_size"]);
        $instance["wptm_color"] =       strip_tags($new_instance["wptm_color"]);
        return $instance;
    }

    function form($instance){
        // Formulario de opciones del Widget, que aparece cuando añadimos el Widget a una Sidebar
        extract( $instance );
        ?>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_text'); ?>">Message</label>
           <textarea class="widefat" id="<?php echo $this->get_field_id('wptm_text'); ?>" name="<?php echo $this->get_field_name('wptm_text'); ?>"><?php echo esc_attr($instance["wptm_text"]); ?></textarea>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_speed'); ?>">Speed</label>
           <input class="widefat" id="<?php echo $this->get_field_id('wptm_speed'); ?>" name="<?php echo $this->get_field_name('wptm_speed'); ?>" type="number" value="<?php echo esc_attr($instance["wptm_speed"]); ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_width'); ?>">Width</label>
           <input class="widefat" id="<?php echo $this->get_field_id('wptm_width'); ?>" name="<?php echo $this->get_field_name('wptm_width'); ?>" type="number" value="<?php echo esc_attr($instance["wptm_width"]); ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_height'); ?>">Height</label>
           <input class="widefat" id="<?php echo $this->get_field_id('wptm_height'); ?>" name="<?php echo $this->get_field_name('wptm_height'); ?>" type="number" value="<?php echo esc_attr($instance["wptm_height"]); ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_size'); ?>">Font Size</label>
           <input class="widefat" id="<?php echo $this->get_field_id('wptm_size'); ?>" name="<?php echo $this->get_field_name('wptm_size'); ?>" type="number" value="<?php echo esc_attr($instance["wptm_size"]); ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wptm_color'); ?>">Color</label>
           <input class="widefat" id="<?php echo $this->get_field_id('wptm_color'); ?>" name="<?php echo $this->get_field_name('wptm_color'); ?>" type="text" value="<?php echo esc_attr($instance["wptm_color"]); ?>" />
        </p>
        <p>
            <label>
                <input type="radio" value="horizontal" name="<?php echo $this->get_field_name( 'wptm_orientation' ); ?>" <?php checked( $wptm_orientation, 'horizontal' ); ?> id="<?php echo $this->get_field_id( 'wptm_orientation' ); ?>" />
                Horizontal
            </label>
        </p>
        <p>
            <label>
                <input type="radio" value="vertical" name="<?php echo $this->get_field_name( 'wptm_orientation' ); ?>" <?php checked( $wptm_orientation, 'vertical' ); ?> id="<?php echo $this->get_field_id( 'wptm_orientation' ); ?>" />
                Vertical
            </label>
        </p>
        <?php
    }
}

?>