<?php
	$installer = $this;
    $installer->startSetup();

    $installer->addEntityType('checkoutexd_creditcard', array(
        //entity_mode is the URI you'd pass into a Mage::getModel() call
        'entity_model'    => 'checkoutexd/creditcard',

        //table refers to the resource URI complexworld/eavblogpost
        //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
        'table'           =>'checkoutexd/creditcard',
    ));

    $installer->createEntityTables(
        $this->getTable('checkoutexd/creditcard')
    );

    $this->addAttribute('checkoutexd_creditcard', 'customer_id', array(
        'type'              => 'varchar',
        'label'             => 'Customer Id',
        'input'             => 'text',
        'required'          => true,
        // 'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'name', array(
        //the EAV attribute type, NOT a MySQL varchar
        'type'              => 'varchar',
        'label'             => 'Name',
        'input'             => 'text',
        'class'             => '',
        'backend'           => '',
        'frontend'          => '',
        'source'            => '',
        'required'          => true,
        'user_defined'      => true,
        'default'           => '',
        // 'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'type', array(
        'type'              => 'varchar',
        'label'             => 'Type',
        'input'             => 'test',
        'required'          => true,
        // 'unique'            => true,
        // 'option' => array(
        //     'value' => array( 
        //             ''   => array( '--Please Select--' ),
        //             'AE'   => array( 'American Express' ),
        //             'VI'   => array( 'Visa' ),
        //             'MC' => array( 'MasterCard' ),
        //             'DI' => array( 'Discover' ),
        //         )
        // ),
        /**
         * This will set the default values,
         * as "array" data type is being used to set proper default value
         */
        // 'default' => array(
        //     ''
        // ),
    ));

    $this->addAttribute('checkoutexd_creditcard', 'number', array(
        'type'              => 'varchar',
        'label'             => 'Number',
        'input'             => 'text',
        'required'          => true,
        'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'exp_year', array(
        'type'              => 'varchar',
        'label'             => 'Expiration Date Year',
        'input'             => 'text',
        'required'          => true,
        // 'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'exp_month', array(
        'type'              => 'varchar',
        'label'             => 'Expiration Date Month',
        'input'             => 'text',
        'required'          => true,
        // 'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'verify_number', array(
        'type'              => 'varchar',
        'label'             => 'Verification Number',
        'input'             => 'text',
        'required'          => true,
        // 'unique'            => true,
    ));

    $this->addAttribute('checkoutexd_creditcard', 'comment', array(
        'type'              => 'text',
        'label'             => 'Comment',
        'input'             => 'textarea',

    ));

    $this->addAttribute('checkoutexd_creditcard', 'status', array(
        'type'              => 'int',
        'label'             => 'Status',
        'input'             => 'boolean',
        'required'          => false,
    ));

    $installer->endSetup();