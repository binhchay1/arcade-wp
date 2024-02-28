<?php
class Admin_Form
{
    const ID = 'config-seo';

    public function init()
    {
        add_action('admin_menu', array($this, 'add_menu_page'), 1);
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_ajax_save_category', array($this, 'save_category'));
    }

    public function get_id()
    {
        return self::ID;
    }

    public function admin_enqueue_scripts($hook_suffix)
    {
        if (strpos($hook_suffix, $this->get_id()) === false) {
            return;
        }

        wp_enqueue_style('config-admin-form-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', BINHCHAY_ADMIN_VERSION);
        wp_enqueue_script(
            'config-admin-form-bs',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            BINHCHAY_ADMIN_VERSION,
            true
        );

        wp_enqueue_script(
            'config-admin-form-bs',
            'https://code.jquery.com/jquery-3.7.1.slim.js'
        );

        echo '
        <style>
            .button-submit {
                border: 1px solid black !important;
            }

            .post-title {
                font-weight: bold !important;
                font-size: 19px !important;
            }

            #alert-post {
                display: none;
            }
        </style>';
    }

    public function add_menu_page()
    {
        add_menu_page(
            esc_html__('Set Category', $this->get_id()),
            esc_html__('Set Category', $this->get_id()),
            'manage_options',
            $this->get_id(),
            array(&$this, 'load_view_post'),
            'dashicons-feedback'
        );
    }

    public function load_view_post()
    {
        $categories = get_categories();
        $nonce = wp_create_nonce("get_game_nonce");
        $link = admin_url('admin-ajax.php');

        echo '<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>';
        echo '<script>
            let listCategory = ' . json_encode($categories) . ';
            let array = Object.keys(listCategory);
            let dataCategory = {};
        </script>';
        echo '<div class="container mt-5">';
        echo "<div class='alert' role='alert' id='alert-post'></div>";
        echo '<ul class="list-group ul-post">';
        foreach ($categories as $category) {
            echo '<li class="list-group-item item-post">
                <span class="post-title">' . $category->name . '</span>
                <span>
                <textarea name="' . $category->slug . '"></textarea>
                </span>
                <script>
                let area_' . str_replace('-', '_', $category->slug) . ' = CKEDITOR.replace("' . $category->slug . '");
                area_' . str_replace('-', '_', $category->slug) . '.on("change", function( evt ) {
                    dataCategory.' . str_replace('-', '_', $category->slug) . ' = String(evt.editor.getData());
                });
                </script>
                </li>';
        }
        echo '</ul>';
        echo '<button class="btn btn-success mt-4" type="button" id="save-category">Save</button>';
        echo '</div>';

        echo '<script>
        jQuery(document).ready( function() {
            jQuery("#save-category").on("click", function(e) {
                e.preventDefault();
                console.log(dataCategory)
        
                jQuery.post("' . $link . '", 
                    {
                        "action": "save_category",
                        "data": dataCategory,
                        "nonce": "' . $nonce . '"
                    }, 
                    function(response) {
                        setInterval(function () {
                            let alert = document.getElementById("alert-post");
                            alert.classList.add("alert-success");
                            alert.style.display = "block";
                            alert.innerHTML = "Save successfully!";
                        }, 3000);
                    }
                );
            })
        });

        function toObject(arr) {
            var rv = {};
            for (var i = 0; i < arr.length; ++i)
              rv[i] = arr[i];
            return rv;
          }
        </script>';
    }

    public function save_category()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], "get_game_nonce")) {
            exit("Please don't fucking hack this API");
        }

        global $wpdb;
        $data = $_REQUEST['data'];

        foreach ($data as $key => $val) {
            $slug = str_replace("_", "-", $key);
            $getCategory = get_category_by_slug($slug);
            $queryGet = "SELECT * FROM " . $wpdb->prefix . 'category_custom WHERE category_id = "' . $getCategory->term_id . '"';
            $result = $wpdb->query($queryGet);
            if ($result == 0) {
                $query = 'INSERT INTO ' . $wpdb->prefix . 'category_custom (`category_id`, `content`) VALUES ';
                $query .= ' ("' . $getCategory->term_id . '", "' . htmlentities($val) . '")';
            } else {
                $query = 'UPDATE ' . $wpdb->prefix . 'category_custom';
                $query .= ' SET `content` = "' . htmlentities($val) . '" WHERE category_id = "' . $getCategory->term_id . '"';
            }

            $wpdb->query($query);
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result;
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}
