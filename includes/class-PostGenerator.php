<?php

class PostGenerator extends WP_Widget
{

    function __construct()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
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
        wp_enqueue_style('pg-main-style', plugins_url() . '/post-generator/assets/css/style.css');
        echo $args['before_widget'];
        ?>

        <div id="islam123">

            <div class="issue-year">
                <form action="">
                    <label for="issue_year">Issue Year:</label>
                    <select name="issue_year" id="issue_year">
                        <option value="1">11</option>
                        <option value="1">11</option>
                        <option value="1">11</option>
                        <option value="1">11</option>
                    </select>
                </form>
            </div>
        </div>
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

        // echo "<hr>"; 
        // print_r($instance);      

        $instance = wp_parse_args((array)$instance, array('display_year' => '', 'records' => ''));

        $display_year = isset($instance['display_year']) ? (bool)$instance['display_year'] : false;
        $records = isset($instance['records']) ? $instance['records'] : '';

        ?>

        <?php if ($records): ?>
        <div class="pg-records-table widefat">
            <hr>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($records as $key => $record): ?>
                    <tr>
                        <td><?php echo $record['title'] ?></td>
                        <td><?php echo $record['issue_year'] ?></td>
                        <td><?php echo $record['description'] ?></td>
                        <td>
                            <input 
                                type="button" 
                                value="X" 
                                onclick="deleteFile(<?=$key?>,'<?=plugins_url('posts-generator/includes/services/deleteFile.php')?>')">
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <hr>
        </div>
    <?php endif ?>
        <p>
            <input
                    type="checkbox"
                    class="checkbox"
                    id="<?php echo $this->get_field_id('display_year'); ?>"
                    name="<?php echo $this->get_field_name('display_year'); ?>"
                <?php checked($display_year); ?>
            /><label for="<?php echo $this->get_field_id('display_year'); ?>"><?php _e('Display Issue Year'); ?></label><br/>


            <!-- Record Data -->
        <p class="post-generator-data">
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
            <input
                    class="widefat"
                    type="text"
                    placeholder="Title..."
                    id="<?php echo $this->get_field_id('title'); ?>"
                    name="<?php echo $this->get_field_name('title'); ?>"
                    value="<?php echo esc_attr($title); ?>"/>

            <input
                    type="hidden"
                    name="<?php echo $this->get_field_name('record_id'); ?>"
                    value="<?php echo uniqid(); ?>"
            />

            <label for="<?php echo $this->get_field_name('issue_year'); ?>"><?php _e('Issue Year:'); ?></label>
            <input
                    class="widefat"
                    type="number"
                    min="1900"
                    max="2100"
                    step="1"
                    id="<?php echo $this->get_field_name('issue_year'); ?>"
                    name="<?php echo $this->get_field_name('issue_year'); ?>"
                    value="<?php echo esc_attr($issue_year) ?>"
            >
            <label for="<?php echo $this->get_field_name('description'); ?>"><?php _e('Description:'); ?></label>
            <textarea
                    class="widefat"
                    cols="30"
                    rows="2"
                    id="<?php echo $this->get_field_name('description'); ?>"
                    name="<?php echo $this->get_field_name('description'); ?>"
            ><?php echo esc_attr($description) ?></textarea>

            <input
                    type="text"
                    name= <?php echo $this->get_field_name('file_url'); ?>
                    class="fileURL"
                    value="">
            <button class="upload_image_button">Upload Image</button>
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

        $instance = array();

        $instance['display_year'] = (!empty($new_instance['display_year'])) ? 1 : 0;


        $title = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $issue_year = (!empty($new_instance['issue_year'])) ? strip_tags($new_instance['issue_year']) : '';
        $description = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
        $file_url = (!empty($new_instance['file_url'])) ? strip_tags($new_instance['file_url']) : '';

        // Newly added record
        $record_data = array(
            "title" => $title,
            "issue_year" => $issue_year,
            "description" => $description,
            "file_url" => $file_url
        );

        if (!$title || !$issue_year || !$description || !$file_url) {
            $instance['records'] = $old_instance['records'];
            return $instance;
        }

        // Appending record to widget records
        if ($old_instance['records']) {
            array_push($old_instance['records'], $record_data);
            $instance['records'] = $old_instance['records'];
        } else {
            $instance['records'] = array($record_data);
        }
        return $instance;
    }

}

