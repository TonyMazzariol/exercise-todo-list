<tr>
                    <th><?= $temp['user_list_id']?></th>
                    <th><?= $temp['user_name']?></th>
                    <th class='list_button'>
                        <form method='GET' action='delete_modify.php'>
                            <input name='user_id_temp' type='hidden' value="<?= $temp['user_list_id']?>">
                            <input type='submit' name='delete_user' value='Supprimer'>
                        </form>
                    </th>
                </tr>