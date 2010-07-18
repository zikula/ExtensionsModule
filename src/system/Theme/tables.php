<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */


/**
 * Populate tables array for modules module.
 *
 * This function is called internally by the core whenever the module is
 * loaded. It delivers the table information to the core.
 * It can be loaded explicitly using the ModUtil::dbInfoLoad() API function.
 *
 * @return       array       The table information.
 */
function theme_tables()
{
    // Initialise table array
    $dbtables = array();

    $dbtables['themes'] = DBUtil::getLimitedTablename('themes');
    $dbtables['themes_column'] = array ('id'             => 'z_id',
                                       'name'           => 'z_name',
                                       'type'           => 'z_type',
                                       'displayname'    => 'z_displayname',
                                       'description'    => 'z_description',
                                       'directory'      => 'z_directory',
                                       'version'        => 'z_version',
                                       'contact'        => 'z_contact',
                                       'admin'          => 'z_admin',
                                       'user'           => 'z_user',
                                       'system'         => 'z_system',
                                       'state'          => 'z_state',
                                       'xhtml'          => 'z_xhtml');

    $dbtables['themes_column_def'] = array('id'          => "I PRIMARY AUTO",
                                          'name'        => "C(64) NOTNULL DEFAULT ''",
                                          'type'        => "I1 NOTNULL DEFAULT 0",
                                          'displayname' => "C(64) NOTNULL DEFAULT ''",
                                          'description' => "C(255) NOTNULL DEFAULT ''",
                                          'directory'   => "C(64) NOTNULL DEFAULT ''",
                                          'version'     => "C(10) NOTNULL DEFAULT 0",
                                          'contact'     => "C(255) NOTNULL DEFAULT ''",
                                          'admin'       => "I1 NOTNULL DEFAULT 0",
                                          'user'        => "I1 NOTNULL DEFAULT 0",
                                          'system'      => "I1 NOTNULL DEFAULT 0",
                                          'state'       => "I1 NOTNULL DEFAULT 0",
                                          'xhtml'       => "I1 NOTNULL DEFAULT 1");

    return $dbtables;
}
