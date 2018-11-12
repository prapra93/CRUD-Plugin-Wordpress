<?php
function get_update_content($title, $table, $fields, $url) {

        global $wpdb;

        $id = $_GET["id"];
        $nbFields = sizeof($fields);

        for ($ind = 0; $ind < $nbFields; $ind++) {
        $sqlFields .= $fields[$ind];
                if ($ind < $nbFields - 1) {
                        $sqlFields .= ',';

                }
                $tableHeader .= "<th>$fields[$ind]</th>";
        }

        //UPDATE
        if (isset($_POST['update'])) {
                for ($ind3 = 0; $ind3 < $nbFields; $ind3++){
                        $dataPost = $_POST[$fields[$ind3]];
                        $wpdb->update(//UPDATE
                                $table,//FROM
                                array($fields[$ind3] => $dataPost, 'date_modified' => current_time('mysql', false)),
                                array('id' => $id)//WHERE
                        );

                }
        }

    //Supprimer
        else if (isset($_POST['delete'])) {
                $wpdb->query($wpdb->prepare("UPDATE $table SET isDeleted = true WHERE id = %s", $id));
        } else {
                $rows = $wpdb->get_results($wpdb->prepare("SELECT $sqlFields FROM $table WHERE id=%s", $id));
                foreach ($rows as $row) {
                        for ($ind2 = 0; $ind2 < $nbFields; $ind2++) {
                                $dataPost = $row->{$fields[$ind2]};
                                $tableContent .= '<td><input size="60" type="text" name="' . $fields[$ind2] . '" value="' . $dataPost . '"></td>';
                        }
                }
        }
?>

<div class="wrap">
        <h2><?php echo $title;  ?></h2>
        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>La donnée sélectionnée dans <?php echo $title;  ?> a été supprimé</p></div>
            <a href="<?php echo admin_url("admin.php?page=$url") ?>">Retour dans la liste de bottin <?php echo $title ?></a>
        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Bottin <?php echo $title;  ?> mise à jour</p></div>
            <a href="<?php echo admin_url("admin.php?page=$url") ?>">Retour dans la liste de bottin <?php echo $title ?></a>
        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                        <tr><?php echo $tableHeader;  ?></tr>
                        <tr><?php echo $tableContent;  ?></tr>
                </table>
        <input type='submit' name="update" value='Sauvegarder' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Supprimer' class='button' onclick="return confirm('Êtes-vous sûr de vouloir supprimer <?php echo $bigenre; ?>?')">
            </form>
        <?php } ?>
    </div>
<?php
}
?>
