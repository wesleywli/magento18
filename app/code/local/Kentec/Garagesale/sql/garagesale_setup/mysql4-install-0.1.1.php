<?php
 $installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('garagesale/garagesaleitempost'))
    ->addColumn('Garagesalepost_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Garagesalepost ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
        ), 'Garagesalepost Title')
    ->addColumn('post', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
        ), 'Garagesalepost Body')
    ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        ), 'Garagesalepost Date')
    ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Timestamp')
    ->setComment('Kentec garagesale/garagesaleitempost entity table');
$installer->getConnection()->createTable($table);

$installer->endSetup(); 
