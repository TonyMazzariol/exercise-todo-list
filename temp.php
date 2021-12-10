                    <div>
                    <?php
                        foreach ($a as $key) {
                            if ($key['todo_text'] === $temp_text['todo_text']) { ?>
                                <div><?= $key['user_name'] ?></div>
                                <form method='GET' action='delete_modify.php'>
                                    <input name='user_id_temp' type='hidden' value='<?= $key['user_list_id'] ?>'>
                                    <input name='todo_id_temp' type='hidden' value='<?= $key['todo_list_id'] ?>'>
                                    <input type='submit' name='delete_user_link' value='Supprimer utilisateur'>
                                </form>                            
                            <?php } 
                        } ?>
                    </div>