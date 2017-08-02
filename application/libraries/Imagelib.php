<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imagelib {

    /**
     * CI Singleton
     *
     * @var object
     */
    protected $CI;

    /**
     * Class constructor
     *
     * Loads the Image_mylib file.
     *
     * @uses	CI_Lang::$is_loaded
     *
     * @return	void
     */
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('directory');
        log_message('info', 'Imagelib Class Initialized');
    }

    /**
     * Upload a image
     * @param    input file, directory, array
     * @return	array
     */
    public function upload_one($input_name, $directory, $image = array(), $thumbnail = array()) {
        $result = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES[$input_name]['tmp_name'] != '') {
                if (!directory_exist($directory)) {
                    create_directory($directory);
                }

                $config = array(
                    'upload_path' => UPLOADPATH . $directory . '/',
                    'allowed_types' => isset($image['allowed_types']) ? $image['allowed_types'] : 'gif|jpg|png|jpeg',
                    'max_size' => isset($image['max_size']) ? $image['max_size'] : '2048', // 2MB
                    'max_width' => isset($image['max_width']) ? $image['max_width'] : '1920',
                    'max_height' => isset($image['max_height']) ? $image['max_height'] : '1200',
                    'encrypt_name' => TRUE
                );
                $this->CI->load->library('upload', $config);

                if ($this->CI->upload->do_upload($input_name)) {
                    $result = $this->CI->upload->data();
                    //Thumbnail
                    if (count($thumbnail) > 0) {
                        $this->thumbnail($directory, $result, $thumbnail);
                    }
                } else {
                    $result['error'] = $this->CI->upload->display_errors();
                }
            }
        }

        return $result;
    }

    /**
     * Upload multi image
     * @param    input file, directory, array
     * @return	array
     */
    public function upload_multi($input_name, $directory, $image = array(), $thumbnail = array()) {
        $result = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $files = $_FILES;

            $cpt = count($_FILES[$input_name]['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES[$input_name]['name'] = $files[$input_name]['name'][$i];
                $_FILES[$input_name]['type'] = $files[$input_name]['type'][$i];
                $_FILES[$input_name]['tmp_name'] = $files[$input_name]['tmp_name'][$i];
                $_FILES[$input_name]['error'] = $files[$input_name]['error'][$i];
                $_FILES[$input_name]['size'] = $files[$input_name]['size'][$i];

                $result[] = $this->upload_one($input_name, $directory, $image, $thumbnail);
            }
        }
        return $result;
    }
        
    /**
     * Delete image
     * @param    directory, image_path
     * @return	boolean
     */
    public function delete($folder = '', $file_path = '') {
        if($folder && $file_path) {
            $path = UPLOADPATH . $folder;
            if(file_exists(UPLOADPATH . $folder . '/' . $file_path)) {
                @unlink(UPLOADPATH . $folder . '/' . $file_path);
                if(file_exists(UPLOADPATH . $folder . '/thumbnail/' . $file_path)) {
                    @unlink(UPLOADPATH . $folder . '/thumbnail/' . $file_path);
                }
            }
        }
        return true;
    }
    /**
     * Creat thumbnail
     * @param    input file, directory, array
     * @return	boolean
     */
    private function thumbnail($directory, $image, $thumbnail) {
        if (!directory_exist($directory . '/thumbnail')) {
            create_directory($directory . '/thumbnail');
        }

        $image_src = UPLOADPATH . $directory . '/' . $image['file_name'];
        $image_dest = UPLOADPATH . $directory . '/thumbnail/' . $image['file_name'];

        switch ($image['image_type']) {
            case 'jpg':
            case 'jpeg':
                $image_data = imagecreatefromjpeg($image_src);
                break;
            case 'png':
                $image_data = imagecreatefrompng($image_src);
                break;
            case 'gif':
                $image_data = imagecreatefromgif($image_src);
                break;
            default:
                return false;
                break;
        }
        if ($image_data == false)
            return false;

        $thumb_quality = isset($thumbnail['quality']) ? $thumbnail['quality'] : 90;
        $thumb_width = isset($thumbnail['width']) ? $thumbnail['width'] : 220;
        $thumb_height = isset($thumbnail['height']) ? $thumbnail['height'] : 180;
        $thumb_rate = $thumb_width / $thumb_height;
        $image_rate = $image['image_width'] / $image['image_height'];

        if ($image_rate >= $thumb_rate) {
            $square_size_y = $image['image_height'];
            $square_size_x = $square_size_y * $thumb_rate;
            $x = ($image['image_width'] - $square_size_x) / 2;
            $y = 0;
        } else {
            $square_size_x = $image['image_width'];
            $square_size_y = $square_size_x / $thumb_rate;
            $y = ($image['image_height'] - $square_size_y) / 2;
            $x = 0;
        }

        $canvas = imagecreatetruecolor($thumb_width, $thumb_height);

        if (imagecopyresampled($canvas, $image_data, 0, 0, $x, $y, $thumb_width, $thumb_height, $square_size_x, $square_size_y)) {
            switch ($image['image_type']) {
                case 'jpg':
                case 'jpeg':
                    return imagejpeg($canvas, $image_dest, $thumb_quality);
                    break;
                case 'png':
                    return imagepng($canvas, $image_dest);
                    break;
                case 'gif':
                    return imagegif($canvas, $image_dest);
                    break;
                default:
                    return false;
                    break;
            }
        } else {
            return false;
        }
        return true;
    }
    
}
// End Library