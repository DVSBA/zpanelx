<?php

/**
 *
 * ZPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 * 
 * @package ZPanel
 * @version $Id$
 * @author Bobby Allen - ballen@zpanelcp.com
 * @copyright (c) 2008-2011 ZPanel Group - http://www.zpanelcp.com/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (ZPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
 		$mailserver_db = ctrl_options::GetSystemOption('mailserver_db');
		include('cnf/db.php');
		$z_db_user = $user;
		$z_db_pass = $pass;
		try {	
  			$mail_db = new db_driver("mysql:host=localhost;dbname=" . $mailserver_db . "", $z_db_user, $z_db_pass);
		} catch (PDOException $e) {
	
		}

		foreach ($deletedclients as $deletedclient){
       	 $sql = "SELECT * FROM x_mailboxes WHERE mb_acc_fk=" . $deletedclient . " AND mb_deleted_ts IS NULL";
	        $numrows = $zdbh->query($sql);
	        if ($numrows->fetchColumn() <> 0) {
	            $sql = $zdbh->prepare($sql);
	            $sql->execute();
	            while ($rowmailbox = $sql->fetch()) {
    				$result = $mail_db->query("SELECT accountid FROM hm_accounts WHERE accountaddress='" . $rowmailbox['mb_address_vc'] . "'")->Fetch();
					if ($result) {
						$msql = $mail_db->prepare("DELETE FROM hm_accounts WHERE accountaddress='" . $rowmailbox['mb_address_vc'] . "'");
						$msql->execute();
					}
	            }
			}
		}
?>