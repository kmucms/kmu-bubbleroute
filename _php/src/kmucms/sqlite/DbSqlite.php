<?php

namespace kmucms\sqlite;

class DbSqlite{

// <editor-fold defaultstate="expanded" desc="row manipulation">

  public function addRow(string $table, array $data = []): int{
    unset($data['id']);
    $this->beautifyAttributes($data);
    $atrStr = implode(',', array_keys($data));
    $valStr = ':' . implode(',:', array_keys($data));
    if($atrStr == ''){
      $valStr = '';
    }
    $sql = "INSERT INTO $table ($atrStr) VALUES ($valStr);";
    $this->doExecute($sql, $data);
    return $this->db->lastInsertRowID();
  }

  public function addOrIgnoreRow(string $table, array $data): int{
    $this->beautifyAttributes($data);
    $atrStr = implode(',', array_keys($data));
    $valStr = ':' . implode(',:', array_keys($data));
    $sql    = "INSERT or ignore INTO $table ($atrStr) VALUES ($valStr);";
    $this->doExecute($sql, $data);
    return $this->db->lastInsertRowID();
  }

  public function setRow($table, $id, $data){
    $data['id'] = $id;
    $this->beautifyAttributes($data);
    $key        = [];
    foreach(array_keys($data) as $k){
      $key[] = $k . ' = :' . $k;
    }
    $attributesStr = implode(',', $key);
    $sql           = "UPDATE $table SET $attributesStr WHERE id=:id;";
    $this->doExecute($sql, $data);
    return $id;
  }

  public function updateRow($table, $id, $data){
    return $this->setRow($table, $id, $data);
  }

  public function updateOrAddRow(string $table, int $id, array $data){
    $dataOld = $this->getRowById($table, $id);
    if(count($dataOld) > 0){
      return $this->updateRow($table, $id, $data);
    }
    unset($data['id']);
    return $this->addRow($table, $data);
  }

  public function updateRows($table, $data, $condition, $conditionData){
    
  }

  public function removeRow($table, $id){
    $sql = "delete from " . $table . " where id=:id";
    $this->doExecute($sql, ['id' => $id]);
  }

  public function removeRowsByCondition($table, $condition, $conditionData){
    $sql = "delete from " . $table . " where " . $condition;
    $this->doExecute($sql, $conditionData);
  }

  public function execute($sql, $data){
    
  }

  public function getRowById(string $table, int $id): array{
    return $this->getRowByColumn($table, 'id', $id);
  }

  public function getRowByColumn(string $table, string $columnName, string $columnValue): array{
    return $this->getRowByCondition($table, $columnName . '=:val', ['val' => $columnValue]);
  }

  /**
   *
   * @param string $table
   * @param string $condition sql-like syntag e.g. "email = :email and name = :name",
   * @param array $conditionData corresponds to condition e.g. ['email'=>$email, 'name'=>$name]
   * @return array
   */
  public function getRowByCondition(string $table, string $condition, array $conditionData, array $columns = []): array{

    $columnsSql = count($columns) > 0 ? implode(',', $columns) : '*';
    $sql        = "select $columnsSql from $table " . ($condition != '' ? " where " : " ") . $condition . " limit 1";
    $stmt       = $this->db->prepare($sql);
    foreach($conditionData as $k => $v){
      $stmt->bindValue(':' . $k, $v);
    }
    $results = $stmt->execute();
    $res     = $results->fetchArray(SQLITE3_ASSOC);
    return is_array($res) ? $res : [];
  }

  public function getRowsByCondition(string $table, string $condition = '', array $conditionData = [
    ], int $offset = 0, int $limit = 20, array $columns = [], string $order = ''): array{

    $limitSql   = $limit > 0 ? ' limit ' . $limit . ' offset ' . $offset . ' ' : '';
    $columnsSql = count($columns) > 0 ? implode(',', $columns) : '*';
    $orderSql   = $order == '' ? '' : ' order by ' . $order . ' ';
    $sql        = "select $columnsSql from $table " . ($condition != '' ? " where " : " ") . $condition . $orderSql . $limitSql;

    $stmt = $this->db->prepare($sql);
    foreach($conditionData as $k => $v){
      $stmt->bindValue(':' . $k, $v);
    }
    $results = $stmt->execute();

    $res = [];
    while($row = $results->fetchArray(SQLITE3_ASSOC)){
      $res[$row['id']] = ($row);
    }
    return $res;
  }

  public function getRowsCount($table, $condition = '', $data = []){
    $condition = $condition == '' ? '' : ' where ' . $condition;
    $count     = $this->getRows("SELECT COUNT(*) as count FROM $table $condition", $data);
    return $count[0]['count'];
  }

  public function getRows($sql, $data = []){

    $stmt = $this->db->prepare($sql);
    foreach($data as $k => $v){
      $stmt->bindValue(':' . $k, $v);
    }
    $results = $stmt->execute();

    $res = [];
    while($row = $results->fetchArray(SQLITE3_ASSOC)){
      if(isset($row['id'])){
        $res[$row['id']] = ($row);
      }else{
        $res[] = ($row);
      }
    }
    return $res;
  }

  public function getRow($sql, $data = []){

    $stmt = $this->db->prepare($sql);
    foreach($data as $k => $v){
      $stmt->bindValue(':' . $k, $v);
    }
    $results = $stmt->execute();

    return $results->fetchArray(SQLITE3_ASSOC);
  }

// </editor-fold>

  private $file  = '';
  private $db;
  private $isNew = false;

  public function isNew(): bool{
    return $this->isNew; //schnapsidee??
  }

  public function __construct($path){
    $this->file = $path;
    if(!is_file($path)){
      \waleri\repository\repoPlain\files\FilesOs::getInstance()->setFileContent($path, '');
      $this->isNew = true;
    }
    $this->db = new \SQLite3($path);
  }

  public function getFile(){
    return $this->file;
  }

  private function doExecute($sql, $params = []){
    //var_dump($sql); exit;
    $stmt = $this->db->prepare($sql);
    foreach($params as $k => $v){
      $stmt->bindValue(':' . $k, $v);
    }
    $stmt->execute();
  }

  private function beautifyAttributes(&$attributes){
    foreach($attributes as &$attr){
      if(is_array($attr)){
        $attr = json_encode($attr);
      }
    }
  }

  public function getNextId($table){
    $sql    = "select max(id) as id from " . $table;
    $nextId = intval($this->getRows($sql)['id']);
    return $nextId + 1;
  }

  private function getSelectSql(
    string $table,
    array $columns = [],
    string $condition = '',
    int $limit = 0,
    int $offset = 0
  ){
    $columnsStr = count($columns) > 0 ? implode(',', $columns) : '*';
    $limitStr   = $limit > 0 ? " limit $limit" : '';
    $offsetStr  = $offset > 0 ? " limit $offset" : '';
    return "select $columnsStr from $table $condition $limitStr $offsetStr";
  }

}
