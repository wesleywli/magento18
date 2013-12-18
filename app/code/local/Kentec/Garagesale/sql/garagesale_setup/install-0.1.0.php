<?php
	$installer = $this;
    $installer->startSetup();

    $installer->addEntityType('garagesale_garagesaleitempost', array(
        //entity_mode is the URI you'd pass into a Mage::getModel() call
        'entity_model'    => 'garagesale/garagesaleitempost',

        //table refers to the resource URI complexworld/eavblogpost
        //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
        'table'           =>'garagesale/garagesaleitempost',
    ));

    $installer->createEntityTables(
        $this->getTable('garagesale/garagesaleitempost')
    );

    $this->addAttribute('garagesale_garagesaleitempost', 'title', array(
        //the EAV attribute type, NOT a MySQL varchar
        'type'              => 'varchar',
        'label'             => 'Title',
        'input'             => 'text',
        'class'             => '',
        'backend'           => '',
        'frontend'          => '',
        'source'            => '',
        'required'          => true,
        'user_defined'      => true,
        'default'           => '',
        'unique'            => false,
    ));
    $this->addAttribute('garagesale_garagesaleitempost', 'content', array(
        'type'              => 'text',
        'label'             => 'Content',
        'input'             => 'textarea',
    ));
    $this->addAttribute('garagesale_garagesaleitempost', 'date', array(
        'type'              => 'datetime',
        'label'             => 'Post Date',
        'input'             => 'datetime',
        'required'          => false,
    ));

    $this->addAttribute('garagesale_garagesaleitempost', 'image', array(
        'type'              => 'varchar',
        'label'             => 'Post Image',
        'input'             => 'media_image',
        'required'          => false,
    ));

    $installer->endSetup();