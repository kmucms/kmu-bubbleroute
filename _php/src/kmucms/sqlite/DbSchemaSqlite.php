<?php

namespace kmucms\sqlite;

class DbSchemaSqlite{

  private bool $errors       = false;
  private string $errorMessage = '';
  private string $dbFile;
  private array $dbSchema;
  private auxiliaryPrivate\DbStructureSqlite $dbStructure;

  public function __construct(string $dbFile, array $dbSchema){
    $this->dbFile      = $dbFile;
    $this->dbSchema    = $dbSchema;
    $this->dbStructure = new auxiliaryPrivate\DbStructureSqlite($dbFile);
    $this->db          = new DbSqlite($dbFile);
  }

  public function update(){
    $db = new DbSqlite($this->dbFile);
    if(!in_array('db_schema_info', $this->dbStructure->getTableNames())){ //is new
      $schemaInfoTable = $this->getTableSql('db_schema_info', ['columns' => [['name' => 'k'], ['name' => 'v']]]);
      $this->dbStructure->doExecute($schemaInfoTable);
      $db->addRow('db_schema_info', ['k' => 'version', 'v' => '0']);
    }
    if(intval($this->dbSchema['version']) <= intval($db->getRow("select v from db_schema_info where k='version'")['v'])){//version in updatearray is smaller than current db version
      return;
    }
    $this->renameTablesAndColumns();
    foreach($this->dbSchema['tables'] as $table){
      if(in_array($table['name'], $this->dbStructure->getTableNames())){//does table exist
        if(!$this->isTableSameAsExistent($table)){
          //create new table
          $tempTableName = $this->getTempTableName();
          $newTableSql   = $this->getTableSql($tempTableName, $table);
          $this->dbStructure->doExecute($newTableSql);
          //copy data 
          $this->copyData($table['name'], $tempTableName);
          $this->dbStructure->removeTable($table['name']);
          $this->dbStructure->renameTable($tempTableName, $table['name']);
        }
      }else{//table did not exist
        $sql = $this->getTableSql($table['name'], $table);
        $this->dbStructure->doExecute($sql);
      }
    }
  }

  /*
  public function hasErrors(): bool{
    return $this->errors;
  }

  public function getErrorMessage(): string{
    return $this->errorMessage;
  }
  */

  private function getTempTableName(){
    $i      = 1;
    $name   = 'temptable';
    $tables = $this->dbStructure->getTableNames();

    $tempName = $name . $i;

    while(in_array($tempName, $tables)){
      $i++;
      $tempName = $name . $i;
    }

    return $tempName;
  }

  private function getTableSql($tableName, $tableSchema){
    $columns = "id INTEGER PRIMARY KEY AUTOINCREMENT ";
    foreach($tableSchema['columns'] as $column){
      $name    = $column['name'];
      $type    = $column['type'] ?? 'string';
      $default = isset($column['default']) ? "default '{$column['default']}'" : '';
      $columns .= ", $name $type $default";
    }

    $res = "create table IF NOT EXISTS $tableName ( $columns );";

    return $res;
  }

  private function isTableSameAsExistent(array $tableSchema){
    if(!in_array($tableSchema['name'], $this->dbStructure->getTableNames())){
      return false;
    }
    $tabCol = $this->dbStructure->getColumnsInfo($tableSchema['name']);
    foreach($tableSchema['columns'] as $column){
      if(!isset($tabCol[$column['name']])){
        return false;
      }
      $colinfo = $tabCol[$column['name']];
      if($colinfo['type'] != ($column['type'] ?? 'string')){
        return false;
      }
      if(isset($column['default']) && "'{$column['default']}'" != $colinfo['dflt_value']){
        return false;
      }
    }
    return true;
  }

  private function copyData($oldTableName, $newTableName){
    $colOld = $this->dbStructure->getColumnNames($oldTableName);
    $colNew = $this->dbStructure->getColumnNames($newTableName);
    $common = array_intersect($colOld, $colNew);
    $cols   = implode(',', $common);
    $this->dbStructure->doExecute("INSERT INTO $newTableName($cols) SELECT $cols FROM $oldTableName;");
  }

  private function renameTablesAndColumns(){
    if(!isset($this->dbSchema['rename'])){
      return;
    }
    foreach($this->dbSchema['rename']['tables'] as $from => $to){
      $this->dbStructure->renameTable($from, $to);
    }
    foreach($this->dbSchema['rename']['columns'] as $table => $col){
      foreach($col as $from => $to){
        $this->dbStructure->renameColumn($from, $to);
      }
    }
  }

}
