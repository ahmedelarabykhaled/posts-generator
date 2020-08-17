<?php

class PostGenerator extends WP_Widget
{

    function __construct()
    {
        // wp_enqueue_script('media-upload');
        // wp_enqueue_media();
        parent::__construct(
            'postgenerator_widget', // Base ID
            esc_html__('Posts Generator', 'pg_domain'), // Name
            array('description' => esc_html__('Widget to display ..... ', 'pg_domain')) // Args
        );
    }

    public $args = array(
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget' => '</div></div>'
    );


    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <hr>;
            <?php print_r($instance);?>
            <?php Global $hook_suffix; echo $hook_suffix?>
        <hr>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     * @see WP_Widget::form()
     *
     */
    public function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('display_year' => '', 'records' => ''));

        $display_year = isset($instance['display_year']) ? (bool)$instance['display_year'] : false;
        $records = isset($instance['records']) ? $instance['records'] : '';
        ?>
        <p>
            <input
                type="checkbox"
                class="checkbox"
                id="<?php echo $this->get_field_id('display_year'); ?>"
                name="<?php echo $this->get_field_name('display_year'); ?>"
                <?php checked($display_year); ?>
            /> <label for="<?php echo $this->get_field_id('display_year'); ?>"><?php _e('Display Issue Year'); ?></label>
        </p>
        <?php           
        ?>
        <style>
            /* Style the buttons that are used to open and close the accordion panel */
            .accordion {
                background-color: #eee;
                color: #444;
                cursor: pointer;
                padding: 18px;
                width: 100%;
                text-align: left;
                border: none;
                outline: none;
                transition: 0.4s;
            }
            
            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
            .active, .accordion:hover {
                background-color: #ccc;
            }
            
            /* Style the accordion panel. Note: hidden by default */
            .panel {
                padding: 0 18px;
                background-color: white;
                display: none;
                overflow: hidden;
            }
  
        </style>
        <script>
            var acc = document.getElementsByClassName("accordion");
            let i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function (e) {
                    /* Toggle between adding and removing the "active" class,
                    to highlight the button that controls the panel */
                    e.preventDefault();
                    this.classList.toggle("active");

                    /* Toggle between hiding and showing the active panel */
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
        </script>
        <script>
            let removeBtns = document.getElementsByClassName('remove-btn');
            for(let j = 0; j < removeBtns.length; j++){
                removeBtns[j].addEventListener("click",function(e){
                    e.preventDefault();
                    let childNodes = removeBtns[j].parentNode.querySelectorAll('input,textarea');
                    childNodes.forEach(function(element){
                        element.value = '';
                        // var event = new Event('change');
                        // element.dispatchEvent(event);
                    })
                    // removeBtns[j].parentNode.remove();
                })
            }
            console.log(removeBtns);            
        </script>
        <?php foreach ($records as $key=>$record):?>
        <hr>
        <div>
            <button class="remove-btn">Remove</button>
            <button class="accordion"><?php echo $record['title']?></button>
            <div class="panel">
                <p class="post-generator-data">
                    <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
                    <input
                        class="widefat title"
                        type="text"
                        placeholder="Title..."
                        name="<?php echo $this->get_field_name('title[]'); ?>"
                        value="<?php echo esc_attr($record['title']); ?>"
                    />
                    <label for="<?php echo $this->get_field_name('issue_year'); ?>"><?php _e('Issue Year:'); ?></label>
                    <input
                        class="widefat"
                        type="number"
                        min="1900"
                        max="2100"
                        step="1"
                        name="<?php echo $this->get_field_name('issue_year[]'); ?>"
                        value="<?php echo esc_attr($record['issue_year']) ?>"
                    >
                    <label for="<?php echo $this->get_field_name('description[]'); ?>"><?php _e('Description:'); ?></label>
                    <textarea
                        class="widefat"
                        cols="30"
                        rows="2"
                        name="<?php echo $this->get_field_name('description[]'); ?>"
                    ><?php echo esc_attr($record['description']) ?></textarea>
                    <input
                        type="text"
                        name= <?php echo $this->get_field_name('file_url[]'); ?>
                        class="fileURL widefat"
                        value="<?php echo $record['file_url']?>"
                    >
                </p>
            </div>
        </div>
        <?php endforeach?>
        <hr><br>
        <h3>Add New Record</h3>
        <!-- Record Data -->
        <p class="post-generator-data">
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
            <input
                class="widefat title"
                type="text"
                placeholder="Title..."
                id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title[]'); ?>"
                value="<?php echo esc_attr($title); ?>"
            />
            <label for="<?php echo $this->get_field_name('issue_year'); ?>"><?php _e('Issue Year:'); ?></label>
            <input
                class="widefat"
                type="number"
                min="1900"
                max="2100"
                step="1"
                id="<?php echo $this->get_field_name('issue_year'); ?>"
                name="<?php echo $this->get_field_name('issue_year[]'); ?>"
                value="<?php echo esc_attr($issue_year) ?>"
            >
            <label for="<?php echo $this->get_field_name('description[]'); ?>"><?php _e('Description:'); ?></label>
            <textarea
                class="widefat"
                cols="30"
                rows="2"
                id="<?php echo $this->get_field_name('description'); ?>"
                name="<?php echo $this->get_field_name('description[]'); ?>"
            ><?php echo esc_attr($description) ?></textarea>
            <p>
                <label for="">File URL: </label>
                <div class="media-widget-control">
                    <div class="media-widget-preview media_gallery">
                        <div class="attachment-media-view">
                            <!-- <button type="button" class="upload_image_button placeholder button-add-media ">Add File</button> -->
                            <div class="widefat fileURL"></div>
                            
                            <input
                                type="text"
                                name= <?php echo $this->get_field_name('file_url[]'); ?>
                                class="fileURL widefat"
                                value=""
                            >
                        </div>
                    </div>
                </div>
            </p>
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public function update($new_instance, $old_instance)
    {
        // parse arrays to records associative array
        $records = array();
        foreach($new_instance['title'] as $key => $title){
            $issue_year  = $new_instance['issue_year'][$key];
            $description = $new_instance['description'][$key];
            $file_url    = $new_instance['file_url'][$key];
            if($title){
                array_push($records,array(
                    'title'       => $title,
                    'issue_year'  => $issue_year,
                    'description' => $description,
                    'file_url'    => $file_url
                ));
            }
            
        }
        $new_instance['records'] = $records;
        return $new_instance;
    }

}

