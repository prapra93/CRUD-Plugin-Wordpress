<?php

function get_table_content($title, $table, $fields, $urlUpdate, $urlCreate) {

        global $wpdb;
        $nbFields = sizeof($fields);

        $sqlFields = 'id,';
        for ($ind = 0; $ind < $nbFields; $ind++) {
        $sqlFields .= $fields[$ind];
                if ($ind < $nbFields - 1) {
                        $sqlFields .= ',';
                }
                $tableHeader .= "<th>$fields[$ind]</th>";
        }
        $tableHeader .= "<th>Modifier</th>";

        $query = ("SELECT $sqlFields from $table WHERE isDeleted = false ORDER BY $fields[0]");
        $rows = $wpdb->get_results($query);
        ?>

    <div class="wrap">
        <h2 class="hndle ui-sortable-handle"><?php echo $title; ?></h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                </br>
                <a href="<?php echo admin_url('admin.php?page=bottin_index') ?>">Retour dans l'index</a></br>
                <a href="<?php echo admin_url("admin.php?page=$urlCreate"); ?>">Ajouter un nouveau</a></br></br>
            </div>
            <br class="clear">
        </div>

        <table class='wp-list-table widefat fixed striped posts'>
        <tr>
                <?php
                echo $tableHeader;
                ?>
        </tr>
        <?php
    // Affichage de chacun des elements formate dans une table
        $ind2 = 0;
        foreach ($rows as $row) { ?>
                <tr>
				<?php
                $myRow = '<td class="manage-column ss-list-width">';
                for ($ind2 = 0; $ind2 < $nbFields; $ind2++) {
                        $myRow .= $row->{$fields[$ind2]} . "</td>";
                        if ($ind2 < $nbFields - 1) {
                                $myRow .= "<td>";
                        }
                }
                echo $myRow;
                ?>
                </td>
                <td><a href="<?php echo admin_url("admin.php?page=$urlUpdate&id=" . $row->id); ?>">Modifier</a></td>
                </tr>
                <?php
        }
        ?>
    </table>
        </div>

<?php
}
?>
