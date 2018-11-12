<?php

function get_create_content($title, $table, $fields, $url){

        global $wpdb;
        $nbFields = sizeof($fields);

        for ($ind = 0; $ind < $nbFields; $ind++) {
        $sqlFields .= $fields[$ind];
                if ($ind < $nbFields - 1) {
                        $sqlFields .= ',';

                }
                $tableHeader .= "<th>$fields[$ind]</th>";
        }

        for ($ind2 = 0; $ind2 < $nbFields; $ind2++) {
                $dataPost = $_POST[$fields[$ind2]];
                $dataNew .= "'" . $_POST[$fields[$ind2]] . "'";
                        if ($ind2 < $nbFields - 1) {
                                $dataNew .= ',';
                        }
                $tableContent .= '<td><input size="60" type="text" name="' . $fields[$ind2] . '" value="' . $dataPost . '"></td>';
        }

        $dataNew .= "," . "'" . current_time('mysql', false) . "'";
        $sqlFields .= ",date_creation";
    if (isset($_POST['insert'])) {
                $wpdb->query("INSERT INTO $table ($sqlFields) VALUES ($dataNew)");
        }
?>

<div class="wrap">
                <h2>Ajouter un nouveau <?php echo $title; ?></h2>
                <?php if ($_POST['insert']) { ?>
                        <div class="updated"><p>Nouveau <?php echo $title; ?> inséré</p></div>
                        <a href="<?php echo admin_url("admin.php?page=$url") ?>">Retour dans la liste de bottin <?php echo $title; ?></a>
                <?php } else { ?>
                        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <table class='wp-list-table widefat fixed'>
                                        <tr><?php echo $tableHeader; ?></tr>
                                        <tr><?php echo $tableContent; ?></tr>
                                </table>
								<input type='submit' name="insert" value='Ajouter' class='button'>
                        </form>
                        <a href="<?php echo admin_url("admin.php?page=$url") ?>">Retour dans la liste de bottin <?php echo $title; ?></a>
                <?php } ?>
        </div>
<?php
}
?>
