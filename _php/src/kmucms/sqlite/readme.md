
Helping classes for using sqlite db.

#WORKING WITH DB

//to make live easier i use allways tables with a column='id'

//file must exist
$db = new \kmucms\sqlite\DbSqlite('/path/to/file.sqli');

//read some rows
$row = $db->getRow("select * from page where id=5 limit 1");
$rows = $db->getRows("select * from page where id=5");
$rows = $db->getRows("select * from page where id=:id",['id'=>5]);
$row = $db->getRowById('page', 3);
$rows = $db->getRowByColumn('page', 'type', 'news'); // all rows with type='news'
$count = $db->getRowsCount('person', "first_name like 'a%'");

//manipulate some rows
$id = $db->addRow('person', ['first_name'=>'Max','last_name'=>'Maier']);
$db->setRow('person', $id, ['first_name'=>'Peter']);
$db->removeRow('person', $id);


#CREATING DB

Set version +1 if something has changed and schema needs an update.
"rename" section is performed first, so remove it if there is nothing to rename. 
Rename tables is the first renaming.
Rename columns is the second renaming, for columns use only the new table-names.

$schemaDescription = [
    'version' => 1,
    'name' => 'user',
    'tables' => [
        0 => [
            'name' => 'person',
            'columns' => [
                0 => [
                    'name' => 'first_name',
                    'type' => 'string',
                    'default' => 'Maxim',
                ],
                1 => [
                    'name' => 'last_name',
                    'type' => 'string',
                    'default' => 'Maier',
                ],
            ],
        ],
    ],
    'rename' => [
        'tables' => [
            'from' => 'to',
            'from2' => 'to2',
        ],
        'columns' => [
            'tablename' => [
                'from' => 'to',
                'from2' => 'to2',
            ],
        ],
    ],
];

$c = new kmucms\sqlite\DbSchemaSqlite(__DIR__.'/file.sqli', $schemaDescription);
$c->update();






