<?php

function isAuthorized() {
    global $db, $CNF;

    session_start();
    $cookie_id   = check_string($_COOKIE["user_id"],"digits");
    $cookie_hash = check_string($_COOKIE["hash"],"string");

    if (isset($cookie_id) and isset($cookie_hash)) {
        $db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
        $db -> query("SET NAMES utf8");
        $query_auth = $db -> query("SELECT `uid`,`login`,`lastname`,`firstname`,`settings` FROM users WHERE `gid`=1 AND `uid`='$cookie_id' AND `pass_hash`='$cookie_hash'");
        if ($db -> num_rows($query_auth) == 1) {
            $auth = $db -> fetch_assoc($query_auth);
            return $auth;
        }
    }

    return false;
};

function isKnownUser($username, $userpass = null) {
    global $db, $CNF;

//    echo $username;
    if (strlen($username)>0) {
        $db = new DBLayer($CNF["db_host"],$CNF["db_user"],$CNF["db_pass"],$CNF["db_name"]);
        $db -> query("SET NAMES utf8");
        $sql_pass = ($userpass != null) ? "`status_id` !=4 AND `pass`='$userpass'" : '`status_id` !=4';
        $query = $db -> query("SELECT `uid`,`login`,`lastname`,`firstname`,`middlename` FROM users WHERE `login`='$username' AND $sql_pass");
        if ($db -> num_rows($query) > 0) {
            $auth = $db -> fetch_assoc($query);
            return $auth;
        }
    }

    return false;
}

function authorize() {
    header("Location: http://".$_SERVER["HTTP_HOST"]."/auth.php");
};

function getAreas() {
    global $db, $permissions;

    $permissions_sql = (isset($permissions["area"])) ? "`id`=".$permissions["area"] : "1";
//    echo "SELECT `id`,`name` FROM areas WHERE `deleted` is null AND $permissions_sql ORDER BY `order`";
    $query_areas  = $db -> query("SELECT `id`,`name` FROM areas WHERE `deleted` is null AND $permissions_sql ORDER BY `order`");
    while($areas_res  = $db -> fetch_row($query_areas))
        $result[$areas_res[0]] = $areas_res[1];
    return (isset($result))? $result: null;
}

function getAdmins($deleted = false) {
    global $db;

    $deleted = $deleted ? "" : " AND `status_id`!='4'";
    $query = $db -> query("SELECT * FROM users WHERE `gid`=1$deleted ORDER BY `post_id`");

    while($res = $db -> fetch_assoc($query)) {
        $result[$res['uid']] = $res;
        $result[$res['uid']]['settings'] = json_decode($res['settings'],true);
    }

    return (isset($result))? $result: false;
}

function getUsers($deleted = false) {
    global $db;

    $deleted = $deleted ? "1" : "`status_id`!='4'";
    $query = $db -> query("SELECT * FROM users WHERE $deleted ORDER BY `lastname`");
    while($res = $db -> fetch_assoc($query))
        $result[$res['uid']] = $res;

    return (isset($result))? $result: false;
}

function getUserByUsername($username) {
    global $db;

    $query = $db -> query("SELECT * FROM users WHERE `login`='$username'");
    $result = $db -> fetch_assoc($query);

    return (isset($result))? $result: false;
}

function getUsersListByDept($dept_id) {
    global $db;

    $query = $db -> query("SELECT `uid` FROM users WHERE `status_id`!='4' AND `dept_id`='$dept_id'");
    while($res = $db -> fetch_row($query))
        $result[] = $res[0];

    return (isset($result))? $result: false;
}

function getPosts() {
    global $db;

    $query = $db -> query("SELECT `id`,`name` FROM posts WHERE `deleted` is null ORDER BY `name`");
    while($posts_res  = $db -> fetch_row($query))
        $result[$posts_res[0]] = $posts_res[1];
    return (isset($result))? $result: false;
}

function checkRequest($str, $default = false) {
    $result = (isset($_REQUEST[$str])) ?  checkString($_REQUEST[$str]) : $default;
    return $result;
}

function checkString($str) {
    return preg_replace("/[^\p{L}0-9\n\_\-\(\)\:\.\/\,\#\"\?!=\\\\~^$%&*+@{}| ]/u", "", $str);
}


// --- Проверка введённых данных
function check_string($str,$type) {
	switch ($type)
	{
		case 'digits':
			$string = preg_replace("/[^0-9]/", "", $str); // только цифры
			break;
        case 'boolean':
			$string = preg_replace("/[^0-1]/", "", $str); // только 0 и 1
			break;
        case 'digits-list':
			$string = preg_replace("/[^0-9,]*/", "", $str); // цифры через запятую
			break;
		case 'text':
            // (UTF-8) Только буквы, цифры, переносы строк, символы: +-/\$*_():;.,!@ пробел
			$string = preg_replace("/[^\p{L}0-9\n\+\-\/\$\*\_\(\)\:\.\;\/\,?!@ ]/u", "", $str);
			break;
		case 'json':
			$string = preg_replace("/[^\p{L}0-9\\\n\_\-\(\)\:\.\/\,\#\"\?!@{} ]/u", "", $str); // (UTF-8) Только буквы, цифры, переносы строк, символы: _-():;.,#"?!@{} пробел
			break;
		case 'string':
			$string = preg_replace("/[^\p{L}0-9\_ ]/u", "", $str); // (UTF-8) Только буквы, цифры, символ "_", пробел
			break;
		case 'date':
			//$check = preg_match("/^[0-9]{2}(\\.[0-9]{2})(\\.[0-9]{4})$/",$str); // dd.mm.YYYY
			$check = preg_match("/^[0-9]{4}(\-[0-9]{2})(\-[0-9]{2})$/",$str); // YYYY-mm-dd
			//$check = preg_match("^(((?<![3-9])[0-9]|(?<=3)[0-1]){1,2}(?!\d)[,\s-]*)*$",$str);
			if ($check == 1) { $string = true; } else $string = false;
			break;
		case 'email':
			$check = preg_match("/^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9-]+)*(\\.[A-Za-z]{2,})$/",$str);
			if ($check == 1) { $string = true; } else $string = false;
			break;
		case 'money':
			$string = preg_replace("/[^\p{L}0-9\_ ]/u", "", $str); // оставить только цифры, а точку заменить на запятую
			break;
	};
	return $string;
}

// Шаблонизатор
function tmplt_gen($p) {
	$p_handle = fopen($p, "r");
	$p_contents = fread($p_handle, filesize($p));
	fclose($p_handle);
	return $p_contents;
}

function eval_script($p) {
	$p_handle = fopen($p, "r");
	$p_contents = fread($p_handle, filesize($p));
	fclose($p_handle);
	eval($p_contents);
}

function build_options($data, $selected) {
    $options = "";
    foreach($data as $k=>$v) {
        $sel = ($selected == $k) ? " selected" : "";
        $options .= "<option value='$k'$sel>$v</option>";
    };
    return $options;
}

// Стандартная таблица вывода списка документов
function table_bills($data)
{
    global $clients,$sellers;
    $client_name = $clients[$data['client_id']];
    if (substr_count($client_name, "ООО ")>0)
        $client_name = str_replace("ООО ", "<span class='prefix'>ООО</span> ", $client_name);
    if (substr_count($client_name, "\"")>0)
        $client_name = str_replace("\"", "<span class='quot'>\"</span>", $client_name);

    $seller_name = $sellers[$data['seller_id']];
    if (substr_count($seller_name, "ООО ")>0)
        $seller_name = str_replace("ООО ", "<span class='prefix'>ООО</span> ", $seller_name);
    if (substr_count($seller_name, "\"")>0)
        $seller_name = str_replace("\"", "<span class='quot'>\"</span>", $seller_name);

    $page = '
			<tr>
				<td>';
    if ($data['filename'])
    {
        $filetype = substr($data['filename'],15);
        if ((strlen($filetype) <= 0) or
            (!file_exists("img/".$filetype."_icon.png")))
            $filetype = "unknown";

        $page .= '<a href="/bills/files/'.$data['filename'].'"><img src="img/'.$filetype.'_icon.png" class="icon"></a>';
    };

    $page .= '<a href="/bills/?stage=mod&id='.$data['id'].'"><span class="numchar">№&nbsp;</span>'.$data['number'].'</a>
				</td>
				<td class="r-align">'.$data['date'].'</td>
				<td>'.$client_name.'</td>
				<td title="'.$data['seller_details'].'">'.$seller_name.'</td>
				<td class="r-align">'.number_format($data['summ'], 2, ',', ' ').'<span class="valchar">&nbsp;руб.</span></td>
				<td title="'.$data['content'].'">'.$data['comment'].'</td>
			</tr>';
    return $page;
}

// Стандартная таблица вывода списка пользователей
function table_users($data)
{
    global $areas,$depts,$posts,$filter;
    $uid        = $data['uid'];
    $lastname   = $data['lastname'];
    $firstname  = $data['firstname'];
    $middlename = $data['middlename'];
    $status     = $data['status_id'];

    $page = "<tr class='status_$status' data-id='$uid'>
				<td class='user-status'><img src='/stat/img/new_status_$status.png'></td>
				<td class='user-fio'>
				    <a href='/users/?stage=mod&uid=$uid$filter' title='$lastname $firstname $middlename'>$lastname $firstname</a>
				</td>
				<td>".$data['login']."</td>
				<td class='center hidden'>".$data['pass']."</td>
				<td>".$areas[$data['area_id']]."</td>
				<td>".$depts[$data['dept_id']]."</td>
				<td>".$posts[$data['post_id']]."</td>
				<td title='".$data['modiff_uid']."'>".$data['modiff_fmt']." </td>
			  </tr>";
    return $page;
}

function preview_user($data) {
    global $depts,$posts;

    $dept = $depts[$data['dept_id']];
    $post = $posts[$data['post_id']];
    $page = "
    <h3 style='font-weight: normal; margin: 0; color: #666; font-size: 105%; text-align:
        left;'>Карточка пользователя: $data[lastname] $data[firstname] $data[middlename]</h3>

    <hr style='border: 1px solid; border-color: #ddd transparent transparent; margin: 10px 0;'>

    <table style='margin: 0 10px; font-family: monospace; '>
        <tr>
            <td style='font-weight: bold; width: 25%'>Сотрудник:</td>
            <td>$data[lastname] $data[firstname] $data[middlename]</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>Отдел:</td>
            <td>$dept</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>Должность:</td>
            <td>$post</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>E-mail:</td>
            <td><a href='mailto: $data[email]'>$data[email]</a></td>
        </tr>
            <tr><td style='font-weight: bold'>Телефон:</td>
            <td>$data[phone]</td>
        </tr>";

    if ($data['skud'] > 0)
        $page .= "<tr>
            <td style='font-weight: bold'>Пропуск:</td>
            <td>$data[skud]</td>
        </tr>";

    $page .= "<tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>Логин Windows:</td>
            <td>$data[login]</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>Логин AExpres:</td>
            <td>$data[login_ae]</td>
        </tr>
        <tr>
            <td style='font-weight: bold'>Пароль:</td>
            <td>$data[pass]</td>
        </tr>
    </table>
    <hr style='border: 1px solid; border-color: #ddd transparent transparent; margin: 10px 0;'>
    <h3 style='font-weight: normal; margin-bottom: 5px ; font-size: 105%; color: #c00; text-align: left;'>Внимание!</h3>

    <p style='color: #000'>За сохранность своих учётных данных отвечает сам сотрудник.
    <br>
    Запрещается передавать свои учётные данные кому-либо (кроме руководства).</p>";
    return $page;
}

function switch_pages($stage,$page_num,$pages,$filter)
{
    $page = '<div class="pagenumbers">';
    if ($page_num > 0) $page .= '<a class="page out" href=index.php?stage='.$stage.$filter.'&page_num=0>«</a>';
    for ($i=0; $i<$pages; $i++)  {
        if ($page_num == $i)
            $page .= '<span class="page current">'.($i+1).'</span>';
		else
            $page .= '<a class="page" href=index.php?stage='.$stage.$filter.'&page_num='.$i.'>'.($i+1).'</a>';
    };
    if ($page_num < ($pages-1)) $page .= '<a class="page out" href=index.php?stage='.$stage.$filter.'&page_num='.($pages-1).'>»</a>';
    $page .= '</div>';
    return $page;
}


function table_supply($data)
{
    $status_class = '';
    $status = ($data['use']>0) ? $data['full'] / $data['use']: 10;
    if ($status>1.3)
        $status_class .= 'good';
    else if ($status>0.65)
        $status_class .= 'warn';
        else $status_class .= 'bad';
    global $areas, $models, $filter, $cartridge4u_id;
    if ($cartridge4u_id[$data["model"]]>0)
        $buy_link = "<a href='http://www.cartridge4u.ru/?action=buy_now&BUYproducts_id=".$cartridge4u_id[$data["model"]]."'
				    target='_blank' class='buy' title='Заказать'><img src='/stat/img/buy.png'></a>";
    $page = "<tr class1='$status_class'>
                <td class='center'><img src='/stat/img/supply_status_$status_class.png'></td>
				<td><a
				    href='./?stage=mod&id=".$data["id"].$filter."'>".$models[$data["model"]]."</a>&nbsp;<a
				    href='javascript: replace(".$data["id"].")' class='replace' title='Заменить'><img
				    src='/stat/img/arrow_refresh_2.png'></a>$buy_link</td>
				<td class='c-align $status_class'>".$data['full']."</td>
				<td class='c-align notify'>".$data['use']."</td>
				<td>".$areas[$data['area']]."</td>
				<td>".$data['comment']."</td>
			  </tr>";
    return $page;
}

function switchLayout($text) {
    $a = array (
        'й' => 'q', 'ц' => 'w', 'у' => 'e', 'к' => 'r', 'е' => 't', 'н' => 'y', 'г' => 'u', 'ш' => 'i', 'щ' => 'o',
        'з' => 'p', 'х' => '[', 'ъ' => ']', 'ф' => 'a', 'ы' => 's', 'в' => 'd', 'а' => 'f', 'п' => 'g', 'р' => 'h',
        'о' => 'j', 'л' => 'k', 'д' => 'l', 'ж' => ';', 'э' => '\'','я' => 'z', 'ч' => 'x', 'с' => 'c', 'м' => 'v',
        'и' => 'b', 'т' => 'n', 'ь' => 'm', 'б' => ',', 'ю' => '.', 'q' => 'й', 'w' => 'ц', 'e' => 'у', 'r' => 'к',
        't' => 'е', 'y' => 'н', 'u' => 'г', 'i' => 'ш', 'o' => 'щ', 'p' => 'з', '[' => 'х', ']' => 'ъ', 'a' => 'ф',
        's' => 'ы', 'd' => 'в', 'f' => 'а', 'g' => 'п', 'h' => 'р', 'j' => 'о', 'k' => 'л', 'l' => 'д', ';' => 'ж',
        '\''=> 'э', 'z' => 'я', 'x' => 'ч', 'c' => 'с', 'v' => 'м', 'b' => 'и', 'n' => 'т', 'm' => 'ь', ',' => 'б',
        '.' => 'ю',
        'Й' => 'Q', 'Ц' => 'W', 'У' => 'E', 'К' => 'R', 'Е' => 'T', 'Н' => 'Y', 'Г' => 'U', 'Ш' => 'I', 'Щ' => 'O',
        'З' => 'P', 'Х' => '[', 'Ъ' => ']', 'Ф' => 'A', 'Ы' => 'S', 'В' => 'D', 'А' => 'F', 'П' => 'G', 'Р' => 'H',
        'О' => 'J', 'Л' => 'K', 'Д' => 'L', 'Ж' => ';', 'Э' => '\'','?' => 'Z', 'Ч' => 'X', 'С' => 'C', 'М' => 'V',
        'И' => 'B', 'Т' => 'N', 'Ь' => 'M', 'Б' => ',', 'Ю' => '.', 'Q' => 'Й', 'W' => 'Ц', 'E' => 'У', 'R' => 'К',
        'T' => 'Е', 'Y' => 'Н', 'U' => 'Г', 'I' => 'Ш', 'O' => 'Щ', 'P' => 'З', '{' => 'Х', '}' => 'Ъ', 'A' => 'Ф',
        'S' => 'Ы', 'D' => 'В', 'F' => 'А', 'G' => 'П', 'H' => 'Р', 'J' => 'О', 'K' => 'Л', 'L' => 'Д', ':' => 'Ж',
        '\"'=> 'Э', 'Z' => '?', 'X' => 'ч', 'C' => 'С', 'V' => 'М', 'B' => 'И', 'N' => 'Т', 'M' => 'Ь', '<' => 'Б',
        '>' => 'Ю', );
    return strtr($text,$a);
}

function isAdmin($userlist, $user_id) {
    $result = $userlist[$user_id]['gid'] == 1;
    return $result;
}

function getFullname($userlist, $user_id) {
    $result = $userlist[$user_id]['lastname']." ".$userlist[$user_id]['firstname'];
    return $result;
}

function getPermissions($user_id, $users_list) {
    $permission_json = $users_list[$user_id]["permissions"];
    $result = json_decode($permission_json, true);
    return $result;
}

function getBurnedUsersCount() {
    global $db;

    $query = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS cnt FROM users WHERE `status_id`='1'");
    $result = $db -> result($query);
    return $result;
}

function getBurnedTicketsCount($user_id) {
    global $db;

    $query = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS cnt
                                FROM helpdesk
                                    WHERE (`performers` IS NULL OR `performers`='' OR `performers` LIKE '%$user_id%')
                                        AND `status`='1'
                                          AND `deleted` IS NULL");
    $result = $db -> result($query);
    return $result;
}

function getBurnedSupplyCount() {
    global $db;

    $query = $db -> query("SELECT SQL_NO_CACHE COUNT(*) AS cnt FROM supply WHERE (`full` < `use` * 0.65) AND `deleted`='0'");
    $result = $db -> result($query);

    return $result;
}

function getBurnedCounts($user_id){

    $result = array(
        "users"    => getBurnedUsersCount(),
        "supply"   => getBurnedSupplyCount(),
        "helpdesk" => getBurnedTicketsCount($user_id)
    );

    return $result;
};

function checkWorkstation($workstation, $ip) {
    global $db;

    $query = $db -> query("SELECT `id` FROM `workstations` WHERE `name`='$workstation'");
    $result = $db -> result($query);

    if ($result == 0) {
        if ($ip == "")
            $query = $db -> query("INSERT INTO `workstations` (`name`) VALUES ('$workstation')");
        else
            $query = $db -> query("INSERT INTO `workstations` (`name`, `ip`) VALUES ('$workstation', '$ip')");

        $result = $db -> insert_id();
    }

    return "$result";
};

function logonWorkstation($workstation, $ip) {
    global $db;

    if (strlen($ip) > 0) {
        $query = "UPDATE `workstations` SET `ip`='$ip' WHERE `id`='$workstation'";
        $db -> query($query);
        $query = "INSERT INTO `sessions_workstations` ( `id`, `ip`, `time`) VALUES  ('$workstation', '$ip', NOW())
                                            ON DUPLICATE KEY UPDATE  `id`='$workstation', `ip`='$ip', `time`=NOW()";
    } else {
        $query = "INSERT INTO `sessions_workstations` ( `id`, `time`) VALUES  ('$workstation', NOW())
                                                ON DUPLICATE KEY UPDATE  `id`='$workstation', `time`=NOW()";
    }
    $result = $db -> query($query);

    return $result;
}


function logoffWorkstation($workstation) {
    global $db;

    $query = "DELETE FROM `sessions_workstations` WHERE `id`='$workstation'";
    $result = $db -> query($query);

    return $result;
}

function logonUser($user, $domain, $workstation) {
    global $db;

    $query = "INSERT INTO `sessions_users` ( `id`, `domain`, `workstation`, `time`) VALUES  ('$user', '$domain', '$workstation', NOW())
                                           ON DUPLICATE KEY UPDATE `id`='$user', `domain`='$domain', `workstation`='$workstation', `time`=NOW()";
    $result = $db -> query($query);

    return $result;
}

function logoffUser($user) {
    global $db;

    $query = "DELETE FROM `sessions_users` WHERE `id`='$user'";
    $result = $db -> query($query);

    return $result;
}

function createUser($username) {
    global $db;

    $query = "INSERT INTO `users` (`login`,`status_id`, `modiff`) VALUES  ('$username', '1', NOW())";
    $db -> query($query);

    return $db -> insert_id();
}

function getComputers($area_filter, $rows_count = 0, $page = 0, $order_by = "name", $order_desc = 0) {
    global $db, $IP;

    $limit = $where = "";

    if ($area_filter > 0 and $area_filter != 2) $where = " WHERE `ip` LIKE '192.168.$IP[$area_filter]%'";
    if ($rows_count > 0 ) $limit = " LIMIT ".($rows_count * $page).",$rows_count";

//    echo $order_by;
    $order_desc = ($order_desc==1) ? " DESC " : null;

    switch ($order_by) {
        case "name":
        case "":
            $order_by = "substring_index(`name`,'-',1) $order_desc,
                         substring_index(`name`,'-',2) $order_desc,
                         substring_index(`name`,'-',-1) + 0 $order_desc";
            $sql = "SELECT * FROM `workstations` $where ORDER BY $order_by$limit";
        break;

        case "user":
            $order_by = "`user` is null, `user` $order_desc";
            $sql = "SELECT *, (
                        SELECT (
                            SELECT lastname FROM users u WHERE s.id=u.uid
                        ) FROM sessions_users s WHERE s.workstation=w.id LIMIT 1
                    ) as `user` FROM `workstations` w$where ORDER BY $order_by$limit";
        break;

        case "ip":
            $order_by = "   `ip` is null,
                            substring_index(substring_index(`ip`,'.',-4),'.',1) + 0 $order_desc,
                            substring_index(substring_index(`ip`,'.',-3),'.',1) + 0 $order_desc,
                            substring_index(substring_index(`ip`,'.',-2),'.',1) + 0 $order_desc,
                            substring_index(substring_index(`ip`,'.',-1),'.',1) + 0 $order_desc";
            $sql = "SELECT * FROM `workstations` $where ORDER BY $order_by$limit";
        break;
    };

//    echo $sql;
    $query = $db -> query($sql);
    while($res = $db -> fetch_assoc($query))
        $result[$res['id']] = $res;

    return (isset($result))? $result: false;
}

function getComputersCount($area_filter) {
    global $db, $IP;
    $where = "`ip` LIKE '192.168.$IP[$area_filter]%'";
    $query_pages_count = $db -> query("SELECT COUNT(*) AS `cnt` FROM `workstations` WHERE $where");
    $pages_count = $db -> result($query_pages_count) + 0;
    return $pages_count;

}

function getOnlineComputers() {
    global $db;

    $query = $db -> query("SELECT * FROM `sessions_workstations`");
    while($res = $db -> fetch_assoc($query))
        $result[$res['id']] = $res;

    return (isset($result))? $result: false;
}

function getOnlineUsers() {
    global $db;

    $query = $db -> query("SELECT * FROM `sessions_users`");
    while($res = $db -> fetch_assoc($query))
        $result[$res['id']] = $res;

    return (isset($result))? $result: false;
}

function getOnlineUsersByComputers() {
    global $db;

    $query = $db -> query("SELECT * FROM `sessions_users`");
    while($res = $db -> fetch_assoc($query))
        $result[$res['workstation']] = $res;

    return (isset($result))? $result: false;
}

function getUsersFlags() {
    global $db;

    $sql = "SELECT `id`,`name` FROM `users_flags` WHERE `deleted` is null ORDER BY `order`";
    $query  = $db -> query($sql);
    while($res = $db -> fetch_row($query))
        $result[$res[0]] = $res[1];
    return (isset($result))? $result: null;
}

