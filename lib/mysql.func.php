<?php
/**
 * 连接数据库
 * @return resource
 */
error_reporting(0);

class DbOperat
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pwd = "liwei";
    private $db_name = "stuSystem";
    private $db_charset = "utf8";
    private $link = null;

    function __construct()
    {
        $this->connect();
    }

    /**
     * 连接数据库
     */
    function connect()
    {
        $this->link = new mysqli();
        $this->link->connect($this->db_host, $this->db_user, $this->db_pwd, $this->db_name);
        $this->link->set_charset($this->db_charset);
        if (!mysqli_select_db($this->link, $this->db_name)) {
            $this->link = null;
        } else {
            mysqli_error();
        }
    }

    /**
     * 插入操作
     * @param $table
     * @param $array
     * @return int|string
     */
    function insert($table, $array)
    {
        $keys = join(",", array_keys($array));
        $vals = "'" . join("','", array_values($array)) . "'";
        $sql = "insert {$table}($keys) values({$vals})";
        $this->link->query($sql);
        return mysqli_insert_id($this->link);
    }

    /**
     * 更新操作
     * @param $table
     * @param $array
     * @param null $where
     * @return bool|int
     */
    function update($table, $array, $where = null)
    {
        foreach ($array as $key => $val) {
            if ($str == null) {
                $sep = "";
            } else {
                $sep = ",";
            }
            $str .= $sep . $key . "='" . $val . "'";
        }
        $sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);
        $result = $this->link->query($sql);
        if ($result) {
            return mysqli_affected_rows($this->link);
        } else {
            return false;
        }
    }

    /**
     * 删除操作
     * @param $table
     * @param null $where
     * @return int
     */
    function delete($table, $where = null)
    {
        $where = $where == null ? null : " where " . $where;
        $sql = "delete from {$table} {$where}";
        $this->link->query($sql);
        return mysqli_affected_rows($this->link);
    }


    /**
     * 匹配单条
     * @param $sql
     * @param int $result_type
     * @return array|null
     */
    function fetchOne($sql, $result_type = MYSQLI_ASSOC)
    {
        $result = $this->link->query($sql);
        $row = mysqli_fetch_array($result, $result_type);
        return $row;
    }

    /**
     * 匹配多条
     * @param $sql
     * @param int $result_type
     * @return array
     */
    function fetchAll($sql, $result_type = MYSQLI_ASSOC)
    {
        $result = $this->link->query($sql);
        while (@$row = mysqli_fetch_array($result, $result_type)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     *
     * @param $sql
     * @return mixed
     */
    function getResultNum($sql)
    {
        $result = $this->link->query($sql);
        return mysqli_num_rows($result);
    }

    /**
     * @return int|string
     */
    function getInsertId()
    {
        return mysqli_insert_id($this->link);
    }

}


