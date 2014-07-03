<?php

ini_set("display_errors",1);
error_reporting(E_ALL ^E_NOTICE);
session_start();
require_once("../subs.php");
require_once("../conf.inc.php");
require_once("../lib/dblayer.php");

if ($admin_login = isAuthorized()) {

        /*  Получаем параметры в виде JSON-объекта и преобразуем в асс.массив
         *  Обязательный параметр - 'action'
         * */
        $result['msg'] = "Unknown error";

        switch ($_POST["action"]) {

            /* В зависимости от территории и отдела генерируем префикс
             * и ищем свободный номер телефона с этим префиксом
             * */
            case 'getTel':
                $area = $_POST["area"];
                $dept = $_POST["dept"];

                $prefixes_result = $db -> query("SELECT `prefix`, `dept_id` FROM `users_tel_prefixes` WHERE `area_id`='$area'");

                if ($prefixes_result) {
                    while ($prefix_row = $db -> fetch_row($prefixes_result)) {
                        $prefix_row[1] = explode(',',$prefix_row[1]);
                        if (array_search($dept,$prefix_row[1]) > -1 ) {
                            $prefix = $prefix_row[0];
                            break;
                        };
                    };

                    if (isset($prefix)) {
                        $prefix__ = $prefix."__";
                        $query_using = "SELECT `phone` FROM `users` WHERE NOT `status_id` IN ('4','6') AND `phone` LIKE '$prefix__' ORDER BY `phone`";
                        $using_result = $db -> query($query_using);
                        if ($using_result)  {
                            $using = array();
                            while ($using_row = $db -> fetch_row($using_result))
                                $using[] = $using_row[0];

                            $reserved_result = $db -> query("SELECT `tel` FROM users_tel_reserved");
                            if ($reserved_result)  {
                                $reserved = array();
                                while ($reserved_row = $db -> fetch_row($reserved_result))
                                    $reserved[] = $reserved_row[0];

                                $nonfree = array_merge($using,$reserved);

                                for ($i=1; $i<100; $i++) {
                                    $z = $i < 10 ? '0': '';
                                    $isFree = !((array_search($prefix.$z.$i,$nonfree) > -1));
                                    if ($isFree) {
                                        $result['tel'] = $prefix.$z.$i;
                                        $result['success'] = true;
                                        break;
                                    };
                                };
                            } else $result['msg'] = "Не могу получить список зарезервированных номеров :(";
                        } else $result['msg'] = "Не могу получить список занятых номеров :(";
                    } else $result['msg'] = "Не могу подобрать префикс :(<br>Проверьте правильность указания территории и отдела";
                } else $result['msg'] = "Не могу получить информацию о префиксах :(";

                break;

            // Получаем Список должностей текущего отдела
            case 'getSiblingPosts':
                $dept = $_POST["dept"];
                $posts_result = $db -> query("SELECT `posts_list` FROM `depts` WHERE `id`='$dept'");
                if ($posts_result) {
                    $post_row = $db -> fetch_row($posts_result)[0];
                    $sibling_posts_result = $db -> query("SELECT `id`, `name` FROM `posts` WHERE `id` IN ($post_row)");
                    if ($sibling_posts_result) {
                        $sibling_posts = [];
                        while ($sibling_posts_row = $db -> fetch_row($sibling_posts_result))
                            $sibling_posts[$sibling_posts_row[0]] = $sibling_posts_row[1];
                        $result['success'] = true;
                        $result['posts'] = $sibling_posts;
                    }
                };

                break;

            case 'upload_foto' :
                $admin_id = $_COOKIE["admin_id"];
                $photos_path = "./photos/";
                $uid = $_POST['user_id'];
                $fileName = $uid.$_POST['file_ext'];
                $serverFile = $photos_path.$fileName;
                $encodedData = $_POST['photo'];
                $decodedData = base64_decode(substr($encodedData, strpos($encodedData,",")));

                $query_old_photo = $db -> query("SELECT `photo` FROM users WHERE `uid`=$uid");
                $old_filename = $db -> fetch_assoc($query_old_photo)['photo'];
                if (isset($old_filename)) $old_filepath = $photos_path . $old_filename;
                if (file_exists($old_filepath)) unlink($old_filepath);
                file_put_contents($serverFile, $decodedData);
                $query_upd = $db -> query("UPDATE `users` SET `photo`='$fileName',`modiff`=NOW(),`modiff_uid`='$admin_id' WHERE `uid`=$uid");

                if ($query_upd) {
                    $result['success'] = true;
                    unset($result['msg']);
                }

                break;

            case 'delete_foto' :
                $admin_id = $_COOKIE["admin_id"];
                $photos_path = "./photos/";
                $uid = $_POST['user_id'];

                $query_old_photo = $db -> query("SELECT `photo` FROM users WHERE `uid`=$uid");
                $old_filename = $db -> fetch_assoc($query_old_photo)['photo'];
                if (isset($old_filename)) $old_filepath = $photos_path . $old_filename;
                if (file_exists($old_filepath)) unlink($old_filepath);
                $query_upd = $db -> query("UPDATE `users` SET `photo`= null,`modiff`=NOW(),`modiff_uid`='$admin_id' WHERE `uid`=$uid");

                if ($query_upd) {
                    $result['success'] = true;
                    unset($result['msg']);
                }

                break;

            case 'getUserInfo' :
                require_once("../vendor/autoload.php"); // Twig инициализация
                Twig_Autoloader::register();
                $loader = new Twig_Loader_Filesystem("../templates/users"); // Twig папка с шаблонами
                $twig   = new Twig_Environment($loader, array("cache" => "",)); // Twig no cache



                $uid = $_POST['user_id'];
                $query_info = "SELECT
                                    u.`uid`,
                                    DATE_FORMAT(u.`modiff`,'%d.%m.%Y %H:%i:%s') as `modiff`,
                                    (SELECT CONCAT(`lastname`,' ',`firstname`) FROM users WHERE `uid`=u.`modiff_uid`) AS `modiff_user`,
                                    u.`status_id`,
                                    (SELECT `name` FROM users_statuses WHERE users_statuses.`id`=u.`status_id`) AS `status`,
                                    u.`lastname`,
                                    u.`firstname`,
                                    u.`middlename`,
                                    u.`login`,
                                    u.`login_ae`,
                                    u.`pass`,
                                    u.`photo`,
                                    u.`phone` as `tel`,
                                    u.`skud`,
                                    u.`email`,
                                    u.`comment`,
                                    u.`area_id`,
                                    (SELECT `name` FROM areas WHERE areas.`id`=u.`area_id`) AS `area`,
                                    (SELECT `name` FROM depts WHERE depts.`id`=u.`dept_id`) AS `dept`,
                                    (SELECT `name` FROM posts WHERE posts.`id`=u.`post_id`) AS `post`,
                                    (SELECT `name` FROM organizations WHERE organizations.`id`=u.`organization_id`) AS `organization`,
                                    (SELECT `workstation` FROM `sessions_users` WHERE `id`='$uid') as `workstation_id`,
                                    (SELECT `ip` FROM `workstations` WHERE `id`=`workstation_id`) as `logon_ip`,
                                    (SELECT `name` FROM `workstations` WHERE `id`=`workstation_id`) as `workstation`,
                                    (SELECT `domain` FROM `sessions_users` WHERE `id`='$uid') as `domain`,
                                    (SELECT `time` FROM `sessions_users` WHERE `id`='$uid') as `logon_time`
                                        FROM users AS u WHERE u.`uid`='$uid'";
                if ($query_info_res = $db -> query($query_info))
                    $user_data = $db -> fetch_assoc($query_info_res);

                $user_data['users']       = getUsers();
                $user_data['permissions'] = getPermissions($admin_login["uid"], $user_data['users']);
                $result['user_info'] = $twig->render('user_info.twig', $user_data);
                break;

        }

/*  Возвращаем результат также в виде JSON-объекта.
 *  В случае безошибочного получения результата,
 *  Делаем $result['success'] = true;
 *  Остальные параметры - опциональные
 *  */

    print_r(json_encode($result));
}

