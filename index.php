<?php
/*
Plugin Name: Cm-bottin-management
*/
ini_set('max_execution_time', 300);

define("JOOMLA_DB", "SiteCorpoBeta");
define("WP_DB", "SiteCorpoWP");
define("OLD_DB", "ref_db");

//CHEMIN
define('ROOT', plugin_dir_path(__FILE__));
require_once(ROOT . 'controllers/list.php');
require_once(ROOT . 'controllers/create.php');
require_once(ROOT . 'controllers/update.php');

function axial_bottin_import_plugin_setup_menu(){
    //add_menu_page('Import Bottin', 'Import Bottin', 'manage_options', 'axial_bottin_import-plugin', 'axial_bottin_import_init');

    //Principal menu item
        add_menu_page('Gestion Bottin', //Titre de la page
        'Gestion Bottin', //Titre du menu
        'manage_options', //capabilité
        'bottin_index', //menu slug
        'bottin_index', //function
    'dashicons-phone' // icon
        );

    //IMPORT BOTTIN

    add_submenu_page(bottin_index,
        'Import Bottin',
        'Import Bottin',
        'manage_options',
        'axial_bottin_import-plugin',
        'axial_bottin_import_init');//function

    //BOTTIN BIGENRE

        //submenu
        add_submenu_page(bottin_index,
        'Liste Bigenre',
        'Liste des bigenres',
        'manage_options',
        'get_table_bigenre',
        'get_table_bigenre');//function

        //submenu CACHÉ
        add_submenu_page(null,
        'Ajouter',
        'Ajouter',
        'manage_options',
        'create_bigenre',
        'create_bigenre');//function

    //submenu CACHÉ
        add_submenu_page(null,
        'Update bottin bigenre',
        'Update',
        'manage_options',
        'update_table_bigenre',
        'update_table_bigenre');//function

    //BOTTIN DÉPARTEMENT SERVICE

        //submenu
        add_submenu_page(bottin_index,
        'Bottin Département Service',
        'Liste des départements et services',
        'manage_options',
        'get_table_dept',
        'get_table_dept');//function

        //submenu CACHÉ
        add_submenu_page(null,
        'Ajouter',
        'Ajouter',
        'manage_options',
        'create_dept',
        'create_dept');//function

        //submenu CACHÉ
        add_submenu_page(null,
        'Update bottin deptServ',
        'Update',
        'manage_options',
        'update_table_dept',
        'update_table_dept');//function

    //BOTTIN EMAIL GÉNÉRIQUE

        //submenu
        add_submenu_page(bottin_index,
        'Bottin email générique',
        'Liste des courriels génériques',
        'manage_options',
        'get_table_email_generique',
        'get_table_email_generique');//function

    //submenu CACHÉ
        add_submenu_page(null,
        'Ajouter',
        'Ajouter',
        'manage_options',
        'create_email_generique',
        'create_email_generique');//function

        //submenu CACHÉ
        add_submenu_page(null,
        'Update bottin deptServ',
        'Update',
        'manage_options',
        'update_table_email',
        'update_table_email');//function
}


function bottin_index(){

?>
<h1>GESTION DU BOTTIN</h1></br>
<h3>
<a href="<?php echo admin_url('admin.php?page=axial_bottin_import-plugin') ?>">Importer le bottin</a></br>
<a href="<?php echo admin_url('admin.php?page=get_table_bigenre') ?>">Liste des bigenres</a></br>
<a href="<?php echo admin_url('admin.php?page=get_table_dept') ?>">Liste des départements et services</a></br>
<a href="<?php echo admin_url('admin.php?page=get_table_email_generique') ?>">Liste des courriels générique</a></br>
</h3>
<?php
}

function get_table_bigenre() {

        $title = "Bigenre";
        $table = "bottin_bigenre";
        $fields = array("femelle", "male", "bigenre");
        $urlUpdate = "update_table_bigenre";
        $urlCreate = "create_bigenre";

        get_table_content($title, $table, $fields, $urlUpdate, $urlCreate);
}

function get_table_dept() {

        $title = "Départements et services";
        $table = "bottin_dept_service";
        $fields = array("from_ad", "to_bottin");
        $urlUpdate = "update_table_create";
        $urlCreate = "create_dept";

        get_table_content($title, $table, $fields, $urlUpdate, $urlCreate);
}

function get_table_email_generique() {

        $title = "Courriels génériques";
        $table = "bottin_email_generique";
        $fields = array("prenom_nom", "generique");
        $urlUpdate = "update_table_email";
        $urlCreate = "create_email_generique";

        get_table_content($title, $table, $fields, $urlUpdate, $urlCreate);
}

function update_table_bigenre(){

        $title = "Bigenre";
        $table = "bottin_bigenre";
        $fields = array("femelle", "male", "bigenre");
        $url = "get_table_bigenre";

        get_update_content($title, $table, $fields, $url);
}

function update_table_dept(){

        $title = "Départements et services";
        $table = "bottin_dept_service";
        $fields = array("from_ad", "to_bottin");
        $url = "get_table_dept";

        get_update_content($title, $table, $fields, $url);
}

function update_table_email(){

        $title = "Courriels génériques";
        $table = "bottin_email_generique";
        $fields = array("prenom_nom", "generique");
        $url = "get_table_email_generique";

        get_update_content($title, $table, $fields, $url);
}

function create_bigenre(){

        $title = "Bigenre";
        $table = "bottin_bigenre";
        $fields = array("femelle", "male", "bigenre");
        $url = "get_table_bigenre";

        get_create_content($title, $table, $fields, $url);

}

function create_dept(){

        $title = "Départements et services";
        $table = "bottin_dept_service";
        $fields = array("from_ad", "to_bottin");
        $url = "get_table_dept";

        get_create_content($title, $table, $fields, $url);
}

function create_email_generique(){

        $title = "Courriels génériques";
        $table = "bottin_email_generique";
        $fields = array("prenom_nom", "generique");
        $url = "get_table_email_generique";

        get_create_content($title, $table, $fields, $url);
}
		