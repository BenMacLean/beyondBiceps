<?php

if (!class_exists('WPAdm_Method_Local_Backup')) {
    class WPAdm_Method_Local_Backup extends WPAdm_Method_Class {

        private $start = true;

        public function __construct($params)
        {
            parent::__construct($params);
            $this->init(
            array(
            'id' => uniqid('wpadm_method__local_backup__'),
            'stime' => time(),
            )
            );

            WPAdm_Core::log(__('Create Unique Id ','dropbox-backup') . $this->id);


            $name = get_option('siteurl');

            $name = str_replace("http://", '', $name);
            $name = str_replace("https://", '', $name);
            $name = str_ireplace( array( 'Ä',  'ä',  'Ö',  'ö', 'ß',  'Ü',  'ü', 'å'), 
                                  array('ae', 'ae', 'oe', 'oe', 's', 'ue', 'ue', 'a'), 
                                  $name );
            $name = preg_replace("|\W|", "_", $name);  
            if (isset($params['time']) && !empty($params['time'])) { // time  1432751372
                $this->time = date("Y-m-d H:i", $params['time']);
                $name .= '-' . wpadm_class::$type . '-' . date("Y_m_d_H_i", $params['time']);
            } else {
                $this->time = date("Y-m-d H:i");   //23.04.2015 13:45  
                $name .= '-' . wpadm_class::$type . '-' . date("Y_m_d_H_i");
            }
            $this->name = $name;

            // folder for backup
            $this->dir = DROPBOX_BACKUP_DIR_BACKUP . '/' . $name;
            if (($f = $this->checkBackup()) !== false) {
                $this->dir = DROPBOX_BACKUP_DIR_BACKUP . '/' . $f;
            }
            $error = WPAdm_Core::mkdir(DROPBOX_BACKUP_DIR_BACKUP);
            if (!empty($error)) {
                $this->result->setError($error);
                $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
            }
            $error = WPAdm_Core::mkdir($this->dir);
            if (!empty($error)) {
                $this->result->setError($error);
                $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
            }
        }
        public function checkBackup()
        {
            if (WPAdm_Running::getCommand('local_backup') !== false) {
                $archives = glob("{$this->dir}");
                if (empty($archives) && count($archives) <= 1) {
                    return false;
                }
                $n = count($archives);
                $f = "{$this->name}({$n})";
                return $f;
            }
            return false;
        }
        public function getResult()
        {

            $errors = array();

            $this->result->setResult(WPAdm_Result::WPADM_RESULT_SUCCESS);
            $this->result->setError('');
            WPAdm_Core::log(__('Start Backup process...','dropbox-backup'));

            # create db dump
            if (in_array('db', $this->params['types']) ) {
                $mysql_dump_file = DROPBOX_BACKUP_DIR_BACKUP . '/mysqldump.sql';
                if ( !WPAdm_Running::getCommandResult('db') ) {
                    WPAdm_Running::setCommandResult('db');
                    WPAdm_Core::log(__('Creating Database Dump','dropbox-backup'));
                    $error = WPAdm_Core::mkdir(DROPBOX_BACKUP_DIR_BACKUP);
                    if (!empty($error)) {
                        $this->result->setError($error);
                        $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
                        return $this->result; 
                    }
                    if (file_exists($mysql_dump_file) && !file_exists(WPAdm_Core::getTmpDir() . "/db")) {
                        unlink($mysql_dump_file);
                    }
                    $wp_mysql_params = $this->getWpMysqlParams();
                    
                    if ( isset($this->params['repair']) && ( $this->params['repair'] == 1 ) ) { 
                        require_once WPAdm_Core::getPluginDir() . '/modules/class-wpadm-mysqldump.php';
                        $mysql = new WPAdm_Mysqldump();
                        $mysql->host = $wp_mysql_params['host'];
                        $mysql->user = $wp_mysql_params['user']; 
                        $mysql->password = $wp_mysql_params['password'];
                         try {
                            $mysql->repair($wp_mysql_params['db']);
                         } catch (Exception $e) {
                            $this->result->setError( $e->getMessage() );
                            $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
                            return false;
                         } 
                        
                    }

                    if (isset($this->params['optimize']) && ($this->params['optimize']==1 ) ) {
                        $opt_db = WPAdm_Running::getCommandResultData('db', $proc_data);
                        if (!isset($opt_db['optimize'])) {
                            WPAdm_Core::log(__('Optimize Database Tables','dropbox-backup'));
                            $commandContext = new WPAdm_Command_Context();
                            $commandContext ->addParam('command','mysqloptimize')
                            ->addParam('host', $wp_mysql_params['host'])
                            ->addParam('db', $wp_mysql_params['db'])
                            ->addParam('user', $wp_mysql_params['user'])
                            ->addParam('password', $wp_mysql_params['password']);
                            $this->queue->clear()
                            ->add($commandContext);
                            unset($commandContext);
                        }
                    } 



                    $commandContext = new WPAdm_Command_Context();
                    $commandContext ->addParam('command','mysqldump')
                    ->addParam('host', $wp_mysql_params['host'])
                    ->addParam('db', $wp_mysql_params['db'])
                    ->addParam('user', $wp_mysql_params['user'])
                    ->addParam('password', $wp_mysql_params['password'])
                    ->addParam('tables', '')
                    ->addParam('to_file', $mysql_dump_file);
                    $res = $this->queue->add($commandContext)
                    ->save()
                    ->execute();
                    if (!$res) {
                        $log = str_replace(array('%domain', '%s'), array(SITE_HOME, $this->queue->getError() ), __('Website "%domain" returned an error during database dump creation: \'Dump of Database wasn\'t created: "%s"\'. To solve this problem, please check your database system logs or send to us your FTP access data. You can send to us support request using "Help" button on plugin page.','dropbox-backup') );
                        WPAdm_Core::log($log);
                        $errors[] = $log;
                    } elseif (0 == (int)filesize($mysql_dump_file)) {
                        $log = str_replace(array('%domain', '%dir'), array(SITE_HOME, DROPBOX_BACKUP_DIR_BACKUP), __('Website "%domain" returned an error during database dump creation: Database-Dump file is emplty. To solve this problem, please check permissions to folder: "%dir".','dropbox-backup') );
                        $errors[] = $log;
                        WPAdm_Core::log($log);
                    } else {
                        $size_dump = round( (filesize($mysql_dump_file) / 1024 / 1024) , 2);
                        $log = str_replace("%size", $size_dump , __('Database Dump was successfully created ( %size Mb) : ','dropbox-backup') ) ;
                        WPAdm_Core::log($log . $mysql_dump_file);
                    }
                    unset($commandContext);
                    WPAdm_Running::setCommandResult('db', true);
                }
            }

            if (count($errors) == 0) {
                $command_files_list = WPAdm_Running::getCommandResultData('files');
                if (in_array('files', $this->params['types']) && empty($command_files_list) ) {
                    $files = $this->createListFilesForArchive();
                    WPAdm_Running::setCommandResultData('files', $files);
                } else {
                    $files = $command_files_list;
                }
                if (isset($mysql_dump_file) && file_exists($mysql_dump_file) && filesize($mysql_dump_file) > 0) {
                    $files[] = $mysql_dump_file;
                }

                if (empty($files)) {
                    $errors[] = str_replace(array('%d'), array(SITE_HOME), __( 'Website "%d" returned an error during creation of the list of files for a backup: list of files for a backup is empty. To solve this problem, please check files and folders permissions for website "%d".' ,'dropbox-backup') );
                }

                // split the file list by 170kbayt lists, To break one big task into smaller
                $files2 = WPAdm_Running::getCommandResultData('files2');
                if (empty($files2)) {
                    $files2 = array();
                    $files2[0] = array();
                    $i = 0;
                    $size = 0;
                    foreach($files as $f) {
                        if ($size > 170000) {//~170kbyte
                            $i ++;
                            $size = 0;
                            $files2[$i] = array();
                        }
                        $f_size =(int)@filesize($f);
                        if ($f_size == 0 || $f_size > 1000000) {
                            WPAdm_Core::log('File ' . $f . ' Size ' . $f_size);
                        }
                        $size += $f_size;
                        $files2[$i][] = $f;
                    }
                    WPAdm_Running::setCommandResultData('files2', $files2);
                }


                WPAdm_Core::log(__('List of Backup-Files was successfully created','dropbox-backup') );
                $this->queue->clear();
                if ( !WPAdm_Running::getCommandResult('archive') ) {
                    WPAdm_Running::setCommandResult('archive');
                    $files_archive = WPAdm_Running::getCommandResultData('archive'); 
                    foreach($files2 as $files) {
                        $files_str = implode(',', $files);
                        if (!in_array($files_str, $files_archive)) {
                            $commandContext = new WPAdm_Command_Context();
                            $commandContext ->addParam('command', 'archive')
                            ->addParam('files', $files)
                            ->addParam('to_file', $this->dir . '/' . $this->name)
                            ->addParam('max_file_size', 900000)
                            ->addParam('remove_path', ABSPATH);

                            $this->queue->add($commandContext);
                            unset($commandContext);    
                        }
                    }
                    WPAdm_Core::log( __('Backup of Files was started','dropbox-backup') );
                    $this->queue->save()->execute();                   
                    WPAdm_Core::log( __('End of File Backup','dropbox-backup') );
                    WPAdm_Running::setCommandResult('archive', true); 
                }
                $files = glob($this->dir . '/'.$this->name . '*');
                $urls = array();
                $totalSize = 0;
                foreach($files as $file) {
                    $urls[] = str_replace(ABSPATH, '', $file);
                    $totalSize += @intval( filesize($file) );
                }
                $this->result->setData($urls);
                $this->result->setSize($totalSize);
                $this->result->setValue('md5_data', md5 ( print_r($this->result->toArray(), 1 ) ) );
                $this->result->setValue('name', $this->name );
                $this->result->setValue('time', $this->time);
                $this->result->setValue('type', 'local');
                $this->result->setValue('counts', count($urls) );
                $size = $totalSize / 1024 / 1024; /// MByte
                $size = round($size, 2);
                $log = str_replace("%s", $size , __('Backup Size %s Mb','dropbox-backup') ) ;
                WPAdm_Core::log($log);

                $remove_from_server = 0;
                #Removing TMP-files
                WPAdm_Core::rmdir($mysql_dump_file);

                #Removind old backups(if limit the number of stored backups)
                if ($this->params['limit'] != 0) {
                    WPAdm_Core::log( __('Limits of Backups ','dropbox-backup') . $this->params['limit'] ); 
                    WPAdm_Core::log( __('Removing of old Backups was started','dropbox-backup') );
                    $files = glob(DROPBOX_BACKUP_DIR_BACKUP . '/*');
                    if (count($files) > $this->params['limit']) {
                        $files2 = array();
                        foreach($files as $f) {
                            $fa = explode('-', $f);
                            if (count($fa) != 3) {
                                continue;
                            }
                            $files2[$fa[2]] = $f;

                        }
                        ksort($files2);
                        $d = count($files2) - $this->params['limit'];
                        $del = array_slice($files2, 0, $d);
                        foreach($del as $d) {
                            WPAdm_Core::rmdir($d);
                        }
                    }
                    WPAdm_Core::log( __('Removing of old Backups was Finished','dropbox-backup') ); 
                }
            }
            wpadm_class::setBackup(1);
            if (!empty($errors)) {
                $this->result->setError(implode("\n", $errors));
                $this->result->setResult(WPAdm_Result::WPADM_RESULT_ERROR);
                WPAdm_Core::rmdir($this->dir);
                wpadm_class::setStatus(0);
                wpadm_class::setErrors( implode(", ", $errors) );
            } else {
                wpadm_class::setStatus(1);
                WPAdm_Core::log( __('Backup creation was complete successfully!','dropbox-backup') );
            }
            wpadm_class::backupSend();

            return $this->result;

        }
        public function createListFilesForArchive() 
        {
            $folders = array();
            $files = array();

            $files = array_merge(
            $files,
            array(
            ABSPATH . '.htaccess',
            ABSPATH . 'index.php',
            ABSPATH . 'license.txt',
            ABSPATH . 'readme.html',
            ABSPATH . 'wp-activate.php',
            ABSPATH . 'wp-blog-header.php',
            ABSPATH . 'wp-comments-post.php',
            ABSPATH . 'wp-config.php',
            ABSPATH . 'wp-config-sample.php',
            ABSPATH . 'wp-cron.php',
            ABSPATH . 'wp-links-opml.php',
            ABSPATH . 'wp-load.php',
            ABSPATH . 'wp-login.php',
            ABSPATH . 'wp-mail.php',
            ABSPATH . 'wp-settings.php',
            ABSPATH . 'wp-signup.php',
            ABSPATH . 'wp-trackback.php',
            ABSPATH . 'xmlrpc.php',
            )
            );

            if (!empty($this->params['minus-path'])) {
                $minus_path = explode(",", $this->params['minus-path']);
                foreach($files as $k => $v) {
                    $v = str_replace(ABSPATH  , '',  $v);
                    if (in_array($v, $minus_path)) {
                        unset($files[$k]);
                        WPAdm_Core::log( __('Skip of File ','dropbox-backup') . $v);
                    }
                }
            }

            $folders = array_merge(
            $folders,
            array(
            ABSPATH . 'wp-admin',
            ABSPATH . 'wp-content',
            ABSPATH . 'wp-includes',
            )
            );
            if (!empty($this->params['plus-path'])) {
                $plus_path = explode(",", $this->params['plus-path']);
                foreach($plus_path as $p) {
                    if (empty($p)) {
                        continue;
                    }
                    $p = ABSPATH . $p;
                    if (file_exists($p)) {
                        if (is_dir($p)) {
                            $folders[] = $p;
                        } else{
                            $files[] = $p;
                        }
                    }
                }
            }

            $folders = array_unique($folders);
            $files = array_unique($files);

            foreach($folders as $folder) {
                if (!is_dir($folder)) {
                    continue;
                }
                $files = array_merge($files, $this->directoryToArray($folder, true));
            }
            return $files;
        }


        private function directoryToArray($directory, $recursive) {
            $array_items = array();

            $d = str_replace(ABSPATH, '', $directory);
            // Skip dirs 
            if (isset($this->params['minus-path'])) {
                $minus_path = explode(",", $this->params['minus-path']);
                if (in_array($d, $minus_path) ) {
                    WPAdm_Core::log(__('Skip of Folder ','dropbox-backup') . $directory);
                    return array();
                }
            } else {
                $minus_path = array();
            }

            $d = str_replace('\\', '/', $d);
            $tmp = explode('/', $d);
            $d1 = mb_strtolower($tmp[0]);
            unset($tmp[0]);
            $d2 = mb_strtolower(implode('/', $tmp));
            if (strpos($d2, 'cache') !== false && isset($tmp[0]) && !in_array($tmp[0], array('plugins', 'themes')) ) {
                WPAdm_Core::log(__('Skip of Cache-Folder ','dropbox-backup') . $directory);
                return array();
            }
            if(strpos($directory, 'wpadm_backups') !== false || strpos($directory, 'Dropbox_Backup') !== false) {
                return array();
            }

            if ($handle = opendir($directory)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (is_dir($directory. "/" . $file)) {
                            if($recursive) {
                                $array_items = array_merge($array_items, $this->directoryToArray($directory. "/" . $file, $recursive));
                            }

                            $file = $directory . "/" . $file;
                            if (!is_dir($file)) {
                                $ff = preg_replace("/\/\//si", "/", $file);
                                $f = str_replace(ABSPATH, '', $ff);
                                // skip "minus" dirs
                                if (!in_array($f, $minus_path)) {
                                    $array_items[] = $ff;
                                } else {
                                    WPAdm_Core::log(__('Skip of File ','dropbox-backup') . $ff);
                                }
                            }
                        } else {
                            $file = $directory . "/" . $file;
                            if (!is_dir($file)) {
                                $ff = preg_replace("/\/\//si", "/", $file);
                                $f = str_replace(ABSPATH, '', $ff);
                                // skip "minus" dirs
                                if (!in_array($f, $minus_path)) {
                                    $array_items[] = $ff;
                                } else {
                                    WPAdm_Core::log( __('Skip of Folder ','dropbox-backup') . $ff);
                                }
                            }
                        }
                    }
                }
                closedir($handle);
            }
            return $array_items;
        }


        /*
        * returns the elements of access to MySQL from WP options
        * return Array()
        */
        private function getWpMysqlParams()
        {
            $db_params = array(
            'password' => 'DB_PASSWORD',
            'db' => 'DB_NAME',
            'user' => 'DB_USER',
            'host' => 'DB_HOST',
            );

            $r = "/define\('(.*)', '(.*)'\)/";
            preg_match_all($r, file_get_contents(ABSPATH . "wp-config.php"), $m);
            $params = array_combine($m[1], $m[2]);
            foreach($db_params as $k=>$p) {
                $db_params[$k] = $params[$p];
            }
            return $db_params;
        }


        private function init(array $conf) {
            $this->id = $conf['id'];
            $this->stime = $conf['stime'];
            $this->queue = new WPAdm_Queue($this->id);
        }
    }
}
