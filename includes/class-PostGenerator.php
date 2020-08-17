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

        $delete_record_handler = plugins_url('posts-generator/includes/services/delete-record.php');
        $widget_base_id        = 'widget_'.$this->id_base;
        $current_widget_id     = strval(end(explode("-",$this->id)));
        ?>

        <!-- <input type="button" class="islam123_"  value="click">
        <input type="hidden" class="record_id" value="<?php echo $current_widget_id?>"> -->
        <?php if ($records): ?>
        <div class="pg-records-table widefat">
            <hr>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                <?php foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $current_widget_id .'-record-'.$key?>">
                        <td><?php echo $record['title'] ?></td>
                        <td><?php echo $record['issue_year'] ?></td>
                        <td><?php echo $record['description'] ?></td>
                        <td>
                            <a class="del-btn"><span class="dashicons dashicons-trash"></span></a>
                            <input type="hidden" class="record_id" value="<?php echo $key?>">
                            <input type="hidden" class="widget_base" value="<?php echo $widget_base_id?>">
                            <input type="hidden" class="current_widget_id" value="<?php echo $current_widget_id?>">

                            <!-- <a 
                                class="del-btn"
                                value ="<?php echo $key;?>"
                                onclick="deleteFile(
                                    <?=$key?>,
                                    '<?=$delete_record_handler?>',
                                    '<?=$widget_base_id?>',
                                    '<?=$current_widget_id?>'
                                    )"
                            ><span class="dashicons dashicons-trash"></span></a> -->
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
                    class="widefat title"
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
        </p>
        <p>
            <div class="media-widget-control">
                <div class="media-widget-preview media_gallery">
                    <div class="attachment-media-view">
                        <button type="button" class="upload_image_button placeholder button-add-media ">Add File</button>
                        <div class="widefat fileURL"></div>
                        <input
                            type="hidden"
                            name= <?php echo $this->get_field_name('file_url'); ?>
                            class="fileURL"
                            value="test-file-val"
                        >
                    </div>
                </div>
            </div>
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

