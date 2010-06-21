<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv2.1 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class Groups_Installer extends Zikula_Installer
{
    /**
     * initialise the groups module
     * This function is only ever called once during the lifetime of a particular
     * module instance
     * @return bool true if initialisation succesful, false otherwise
     */
    public function install()
    {
        // create the groups table
        if (!DBUtil::createTable('groups')) {
            return false;
        }

        // create the group membership table
        if (!DBUtil::createTable('group_membership')) {
            return false;
        }

        // create the groups applications table
        if (!DBUtil::createTable('group_applications')) {
            return false;
        }

        // set all our module vars
        $this->setVar('itemsperpage', 25);
        $this->setVar('defaultgroup', 1);
        $this->setVar('mailwarning', 0);
        $this->setVar('hideclosed', 0);

        // create the default data for the modules module
        $this->defaultdata();

        // Initialisation successful
        return true;
    }

    /**
     * upgrade the module from an old version
     *
     * This function must consider all the released versions of the module!
     * If the upgrade fails at some point, it returns the last upgraded version.
     *
     * @param        string   $oldVersion   version number string to upgrade from
     * @return       mixed    true on success, last valid version string or false if fails
     */
    public function upgrade($oldversion)
    {
        // Upgrade dependent on old version number
        switch ($oldversion)
        {
            case '2.1':
            // change value of defaultgroup from name to gid
                $gid = DBUtil::selectObjectByID('groups', ModUtil::getVar('Groups', 'defaultgroup'), 'name');
                $this->setVar('defaultgroup', $gid['gid']);

            case '2.2':
            case '2.3':
            // future upgrade routines
        }
        // Update successful
        return true;
    }

    /**
     * delete the groups module
     * This function is only ever called once during the lifetime of a particular
     * module instance
     * @return bool true if delete succesful, false otherwise */
    public function uninstall()
    {
        // Deletion not allowed
        return false;
    }

    /**
     * create the default data for the groups module
     *
     * This function is only ever called once during the lifetime of a particular
     * module instance
     *
     * @return       bool       false
     */
    public function defaultdata()
    {
        $records = array(array('name'        => $this->__('Users'),
                        'description' => $this->__('By default, all users are made members of this group.'),
                        'prefix'      => $this->__('usr')),
                array('name'        => $this->__('Administrators'),
                        'description' => $this->__('By default, all administrators are made members of this group.'),
                        'prefix'      => $this->__('adm')));

        DBUtil::insertObjectArray($records, 'groups', 'gid');

        // Insert Anonymous and Admin users
        $records = array(array('gid' => '1',
                        'uid' => '1'),
                array('gid' => '2',
                        'uid' => '2'));

        DBUtil::insertObjectArray($records, 'group_membership', 'gid', true);
    }
}