<?php

namespace Source\Repository;

use PDOException;
use Source\Database\Database;

abstract class AbstractRepository
{
    /** @var Database|null  */
    protected ?Database $connection = null;

    protected $table = '';

    protected $class = '';

    protected function __construct(string $table, string $class)
    {
        $this->table = $table;
        $this->class = $class;

        $this->connection = Database::getInstance();
    }

    protected function __destruct()
    {
    }

    public function delete(int $id)
    {
        try {
            $statement = $this->connection->prepare("delete from {$this->table} where id=?");
            $statement->bindValue(1, $id, Database::PARAM_INT);

            return $statement->execute();
        } catch (PDOException $error) {
            return false;
        }
    }

    public function filters(array $queryParams = [])
    {
        try {
            $returnSql = false;
            $where = [];
            $join = [];
            $limit = '';

            if (! empty($queryParams)) {
                foreach ($queryParams as $option => $optionValue) {
                    switch (strtolower($option)) {
                        case 'where':
                            if (is_array($optionValue)) {
                                foreach ($optionValue as $index => $value) {
                                    $where[$index] = $value;
                                }
                            } else {
                                $where[] = $optionValue;
                            }
                            break;
                        case 'join':
                            if (is_array($optionValue)) {
                                foreach ($optionValue as $table => $on) {
                                    $join[$table] = $on;
                                }
                            } else {
                                $join[] = $optionValue;
                            }
                            break;
                        case 'limit':
                            if (!empty($optionValue)) {
                                $limit = " LIMIT {$optionValue}";
                            }
                            break;
                        case 'table':
                            $this->table = $optionValue;
                            break;
                        case 'sql':
                            $returnSql = $optionValue;
                            break;
                    }
                }
            }

            $queryJoin = '';
            if ($join) {
                foreach ($join as $table => $on) {
                    $queryJoin .= " inner join `{$table}` on";

                    foreach ($on as $index => $value) {
                        $queryJoin .= " {$index} = {$value}";
                    }
                }
            }

            $queryWhere = '';
            if ($where) {
                $queryWhere = ' WHERE';
                foreach ($where as $index => $value) {
                    if (is_numeric($index)) {
                        $queryWhere .= " {$value}";
                    } else {
                        preg_match("/\[[a-zA-Z0-9-_()\.]+\]/", $value, $regex);

                        if (! empty($regex)) {
                            $value = str_replace(['[', ']'], '', $value);
                        }

                        $queryWhere .= " {$index} = " . (! empty($regex) ? $value : "'{$value}'");
                    }
                }
            }

            $query = "SELECT {$this->table}.* FROM {$this->table}{$queryJoin}{$queryWhere}{$limit}";

            if ($returnSql == true) {
                return $query;
            }

            $statement = $this->connection->query($query);

            return $statement->fetchAll(
                Database::FETCH_CLASS,
                $this->class
            );
        } catch (PDOException $error) {
            return [];
        }
    }

    public function findAll(array $queryParams = [])
    {
        return $this->filters($queryParams);
    }

    public function findFirst(array $queryParams = [])
    {
        try {
            $queryParams['limit'] = 1;
            $return = $this->filters($queryParams);

            if (! empty($queryParams['sql']) && $queryParams['sql'] == true) {
                return $return;
            }

            if (! empty($return[0])) {
                return $return[0];
            }

            return [];
        } catch (PDOException $error) {
            return [];
        }
    }
}
