<?php
	$installer = $this;
    $installer->startSetup();

    $installer->addEntityType('boxconfig_boxconfig', array(
        //entity_mode is the URI you'd pass into a Mage::getModel() call
        'entity_model'    => 'boxconfig/boxconfig',

        //table refers to the resource URI complexworld/eavblogpost
        //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
        'table'           =>'boxconfig/boxconfig',
    ));

    $installer->createEntityTables(
        $this->getTable('boxconfig/boxconfig')
    );

    $this->addAttribute('boxconfig_boxconfig', 'customer_id', array(
        'type'              => 'varchar',
        'label'             => 'Customer Id',
        'input'             => 'text',
        'required'          => true,
        'unique'            => true,
    ));

    $this->addAttribute('boxconfig_boxconfig', 'imei', array(
        //the EAV attribute type, NOT a MySQL varchar
        'type'              => 'varchar',
        'label'             => 'Imei',
        'input'             => 'text',
        'class'             => '',
        'backend'           => '',
        'frontend'          => '',
        'source'            => '',
        'required'          => true,
        'user_defined'      => true,
        'default'           => '',
        'unique'            => true,
    ));

    $this->addAttribute('boxconfig_boxconfig', 'mac_addr', array(
        'type'              => 'varchar',
        'label'             => 'Mac Addr',
        'input'             => 'text',
        'required'          => true,
        'unique'            => true,
    ));

    $this->addAttribute('boxconfig_boxconfig', 'comment', array(
        'type'              => 'text',
        'label'             => 'Comment',
        'input'             => 'textarea',
    ));

    // $this->addAttribute('boxconfig_boxconfig', 'created_time', array(
    //     'type'              => 'datetime',
    //     'label'             => 'Created Time',
    //     'input'             => 'datetime',
    //     'required'          => false,
    // ));

    // $this->addAttribute('boxconfig_boxconfig', 'update_time', array(
    //     'type'              => 'datetime',
    //     'label'             => 'Update Time',
    //     'input'             => 'datetime',
    //     'required'          => false,
    // ));

    $this->addAttribute('boxconfig_boxconfig', 'status', array(
        'type'              => 'int',
        'label'             => 'Status',
        'input'             => 'boolean',
        'required'          => false,
    ));

    $installer->endSetup();