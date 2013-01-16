
    <li class="nav-header">Профиль</li>
    <H4 style="text-align: center">Привет, <?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?></H4>
            <?php
            if (empty($user_data['profile']) === false) {
                echo '<img style="display: block; margin-left: auto; margin-right: auto" class="img-polaroid" src="' . $base_url . $user_data['profile'] . '" alt="' . $user_data['username'] . '\'s Profile Image">';
            }
            ?>

            <li>
                <a href="<?php echo $base_url; ?>logout.php">Выйти</a>
            </li>
            <li>
                <a href="<?php echo $base_url; ?>profile/<?php echo $user_data['username'];?>">Личный кабинет</a>
            </li>
            <li>
                <a href="<?php echo $base_url; ?>changepassword.php">Сменить пароль</a>
            </li>
            <li>
                <a href="<?php echo $base_url; ?>settings.php">Настройки</a>
            </li>
            <li>
            <?php
            if (request_count($session_user_id) > 0) {
            ?>
                <a href="<?php echo $base_url; ?>request.php">Друзья [<?php echo request_count($session_user_id); ?>]</a>
            <?php
            }else{
            ?>
                <a href="<?php echo $base_url; ?>friendlist.php">Друзья</a>
            <?php
            }
            ?>
            </li>

