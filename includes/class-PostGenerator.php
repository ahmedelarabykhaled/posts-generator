<?php

class PostGenerator extends WP_Widget{

    function __construct(){
        parent::__construct(
            'postgenerator_widget', // Base ID
            esc_html__( 'Posts Generator', 'pg_domain'), // Name
            array( 'description' => esc_html__( 'Widget to display ..... ', 'pg_domain' )) // Args
          );
    }

    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );


    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        // $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Categories' );
        // $issue_year = isset($instance['issue_year']) ? $instance['issue_year'] :'';
        // $description = isset($instance['description']) ? $instance['description'] :'';
        // echo "<div class='widget'>";
        // echo "<h3>$title</h3>";
        // echo "<h3>$issue_year</h3>";
        // echo "<h3>$description</h3>";
        // echo "</div>";
        echo '<a href="#">
        <img src="'.esc_url($instance['image_uri']).'" />
        </a>';
  
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */    
    public function form($instance){

        // echo "<hr>"; 
        // print_r($instance);      

        $instance = wp_parse_args( (array) $instance, array('display_year' => '','records'=>''));

        $display_year = isset($instance['display_year']) ? (bool) $instance['display_year'] : false;
        $records      = isset($instance['records'])      ? $instance['records'] : '';
        
        echo "<hr>";
        print_r($instance);
        echo "<hr>";
        print_r($instance['records']);
        echo "<hr>";  
        
        // $record_id   = isset($instance['record_id'])? $instance['record_id'] : '';
        // $title       = isset($instance['title'])? $instance['title'] :'';
        // $issue_year  = isset($instance['issue_year']) ? $instance['issue_year'] :'';
        // $description = isset($instance['description']) ? $instance['description'] :'';        
        ?>

        <?php if($records): ?>
        <style>
        .pg-records-table table, .pg-records-table th, .pg-records-table td{
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }
        </style>
        <div class="pg-records-table widefat">
        <hr>
            <table>
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach($records as $record):?>
            <tr>
                <td><?php echo $record['title'] ?></td>
                <td><?php echo $record['issue_year'] ?></td>
                <td><?php echo $record['description'] ?></td>
                <td>Remove Action</td>
            </tr>
            <?php endforeach ?>
            </table>
        <hr> 
        </div>
        <?php endif?>
        <p>
            <input 
                type="checkbox" 
                class="checkbox" 
                id="<?php echo $this->get_field_id( 'display_year' ); ?>" 
                name="<?php echo $this->get_field_name( 'display_year' ); ?>"
                <?php checked( $display_year ); ?> 
            /><label for="<?php echo $this->get_field_id( 'display_year' ); ?>"><?php _e( 'Display Issue Year' ); ?></label><br />


        <!-- Record Data -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input 
                class="widefat" 
                type="text" 
                placeholder="Title..."
                id="<?php echo $this->get_field_id( 'title' ); ?>"
                name="<?php echo $this->get_field_name( 'title' ); ?>" 
                value="<?php echo esc_attr( $title ); ?>" />

            <input 
                type="hidden" 
                name="<?php echo $this->get_field_name( 'record_id' ); ?>" 
                value="<?php echo uniqid(); ?>"   
            />

            <label for="<?php echo $this->get_field_name( 'issue_year' ); ?>"><?php _e( 'Issue Year:' ); ?></label>
            <input 
                class="widefat" 
                type="number"
                min="1900"
                max="2100"
                step="1" 
                id="<?php echo $this->get_field_name( 'issue_year' ); ?>"
                name="<?php echo $this->get_field_name( 'issue_year' ); ?>" 
                value="<?php echo esc_attr( $issue_year )?>"
            >
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e('Description:'); ?></label>
            <textarea 
                class="widefat" 
                cols="30"
                rows="2"
                id="<?php echo $this->get_field_name( 'description' ); ?>"
                name="<?php echo $this->get_field_name( 'description' ); ?>" 
            ><?php echo esc_attr( $description )?></textarea>
        </p>

       <input type="file" name="<?php echo $this->get_field_name('file'); ?>" id="">
        
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['display_year'] = (!empty($new_instance['display_year'])) ? 1 : 0 ;
        $instance['file']         = (!empty($new_instance['file'])) ? $new_instance['file'] : $_FILES['file'] ;


        // $record_id   = ( !empty( $new_instance['record_id'])) ? strip_tags( $new_instance['record_id'] )    : '';        
        $title       = ( !empty( $new_instance['title']))     ? strip_tags( $new_instance['title'] )        : '';
        $issue_year  = ( !empty( $new_instance['issue_year']))  ? strip_tags( $new_instance['issue_year'])  : '';
        $description = ( !empty( $new_instance['description'])) ? strip_tags( $new_instance['description']) : '';

        // Newly added record
        $record_data = array(
            "title"       => $title,
            "issue_year"  => $issue_year,
            "description" => $description
        );

        if(!$title || !$issue_year || !$description){
            $instance['records'] = $old_instance['records'];
            return $instance;
        }

        // Appending record to widget records
        if ($old_instance['records']){
            array_push($old_instance['records'],$record_data);
            $instance['records'] = $old_instance['records'];
        }else{
            $instance['records'] = array($record_data);
        }
        return $instance;
    }


    private function generate_record_id($records){
        if(empty($records)){
            return 0;
        }
        
        // else return id = last id +1
    }
}

