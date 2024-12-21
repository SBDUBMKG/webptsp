<?php
// application/helpers/menu_helper.php

if (!function_exists('get_categories_with_submenus')) {
    function get_categories_with_submenus()
    {
        // Get the CodeIgniter instance
        $CI = &get_instance();

        // Load the database library
        $CI->load->database();

        // Execute the query to retrieve categories with their submenus
        $query = $CI->db->query("
            SELECT 
                kategori.id_kategori_menu AS category_id,
                kategori.kategori_menu AS category_name,
                kategori.kategori_menu_en AS category_name_en,
                kategori.uri AS uri_menu,
                menu.uri AS uri_submenu,
                menu.id AS submenu_id,
                menu.menu AS submenu_name,
                menu.menu_en AS submenu_name_en
            FROM 
                tbl_kategori_menu_frontend AS kategori
            LEFT JOIN 
                tbl_menu_frontend AS menu ON kategori.id_kategori_menu = menu.id_kategori_menu
            ORDER BY 
                kategori.urutan, menu.urutan
        ");

        // Organize the results into an associative array
        $categories = array();
        foreach ($query->result_array() as $row) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $category_name_en = $row['category_name_en'];
            $uri_menu = $row['uri_menu'];
            $uri_submenu = $row['uri_submenu'];
            $submenu_id = $row['submenu_id'];
            $submenu_name = $row['submenu_name'];
            $submenu_name_en = $row['submenu_name_en'];

            if (!isset($categories[$category_id])) {
                // Create a new category if it doesn't exist
                $categories[$category_id] = array(
                    'category_name' => $category_name,
                    'category_name_en' => $category_name_en,
                    'uri_menu' => $uri_menu,
                    'submenus' => array()
                );
            }

            // Add the submenu to the category
            $categories[$category_id]['submenus'][] = array(
                'submenu_id' => $submenu_id,
                'submenu_name' => $submenu_name,
                'submenu_name_en' => $submenu_name_en,
                'uri_submenu' => $uri_submenu,
            );
        }

        return $categories;
    }
}
?>
