<?php

namespace Shop\Model;

use John\Frame\Config\Config;
use John\Frame\Model\BaseModel;

class MainModel extends BaseModel
{

    /**
     * name searching characteristic
     */
    const NAME = 'name';

    /**
     * field to search
     */
    const FIELD = 'field';

    /**
     * parameters of result array
     */
    const PARAMETERS = 'parameters';

    protected $pdo;
    protected $table;
    protected $pk = 'id';

    protected $goods;
    protected $categories;

    protected static $knownFilters = ['test'=>[1,3]];

    public function __construct(Config $config)
    {
        parent::__construct($config);
        $this->getSidebar('categories', 'category_id', 'id', '=', 'id');
    }

    /**
     * Function get filter data for product
     * @param array $search
     * @param array|null $unixCharacteristics
     * @return array of filters
     */
    public function getFilters(array $search, array $unixCharacteristics = null): array
    {
        $searchCharacteristics = $search;
        $filters = [];
        if($unixCharacteristics)
            $filters[] = $unixCharacteristics;
        foreach ($searchCharacteristics as $key => $value) {
            $filters[] = $this->getCharacteristics($key, $value);
        }
        return $filters;
    }

    /**
     *
     * @param string $searchField
     * @param string $characteristicName
     * @return array
     */
    private function getCharacteristics(string $searchField, string $characteristicName):array
    {
        $knownCharacteristics = $this->getAll($this->table, [$searchField], true);
        return $this->combineCharacteristics($knownCharacteristics, $characteristicName, $searchField);
    }


    /**
     * help function to combine result data
     * @param array $knownCharacteristics
     * @param string $characteristicName
     * @param string $field
     * @return array
     */
    public function combineCharacteristics(array $knownCharacteristics, string $characteristicName, string $field): array {
        $array[self::NAME] = $characteristicName;
        $array[self::FIELD] = $field;
        foreach ($knownCharacteristics as $row) {
            foreach ($row as $key => $value) {
                $array[self::PARAMETERS][]['parameter'] = $value;
            }
        }
        return $array;
    }

    /**
     * function for getting max and min price
     * @return array
     */
    public function boundaryPrice()
    {
        $field = 'price';
        $maxPrice = $this->findBorder($field, false);
        $minPrice = $this->findBorder($field);
        $price = [];
        $price['price1'] = $minPrice[$field];
        $price['price2'] = $maxPrice[$field];
        return $price;
    }

    /**
     * Get all products to show
     * @return array
     */
    public function getProducts():array
    {
        $good['products'] = $this->getLimit();
        $good['number'] = $this->getCount('name');
        return $good;
    }


    /**
     * @param int $from
     * @param string $tableName
     * @param array $fields
     * @return array
     */
    public function getLimit(int $from = 0,
                             string $tableName = '',
                             array $fields = ['*']):array
    {
        $table = $this->table;
        if (!empty($tableName))
            $table = $tableName ?: $tableName;
        $selectStatement = $this->pdo->select()
            ->from($table)
            ->where('sum', '>', 0)
            ->orderBy('id')
            ->offset($from);
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();

    }

    /**
     * Get count of find product
     * @param string $field
     * @return int
     */
    public function getCount(string $field = 'id'):int
    {
        $selectStatement = $this->pdo->select([$field])
            ->from($this->table)
            ->groupBy($field)
            ->distinct();
        $stmt = $selectStatement->execute();
        return count($stmt->fetchAll());
    }

    /**
     * Return product with rewrite array key
     * @param int $id
     * @param array $additionalRewriteKey
     * @return array
     */
    public function getOneProduct(int $id, array $additionalRewriteKey = []): array
    {
        $rewriteBaseKey = [
            'name' => 'название',
            'type' => 'тип',
            'brand' => 'производитель',
            'price' => 'цена'
            ];
        $rewriteKey = array_merge($rewriteBaseKey, $additionalRewriteKey);
        $result = $this->findOne($id);
        $result = array_shift($result);
        foreach ($rewriteKey as $key => $value){
            $rewriteKey[$value] = $result[$key];
            unset($result[$key]);
            unset($rewriteKey[$key]);
        }
        return array_merge($rewriteKey, $result);
    }


    /**
     * Get one product
     * @param $id
     * @param string $field
     * @return array
     */
    public function findOne($id, $field = ''): array
    {
        $field = $field ?: $this->pk;
        $selectStatement = $this->pdo->select()
            ->from($this->table)
            ->where($field, '=', $id);
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();

    }

    /**
     * Get products between
     * @param $findElements
     * @param $field
     * @param array $search
     * @return mixed
     */
    public function getBetween($findElements, $field, array $search = ['id']):array
    {
        $selectStatement = $this->pdo->select($search)
            ->from($this->table)
            ->whereBetween($field, $findElements)
            ->orderBy('id');
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();
    }

    /** Get products in
     * @param string $inField
     * @param array $findElements
     * @param array $search
     * @return mixed
     */
    public function getIn(string $inField, array $findElements, array $search = ['id']):array
    {
        $selectStatement = $this->pdo->select($search)
            ->from($this->table)
            ->whereIn($inField, $findElements)
            ->orderBy('id');
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all categories in db
     * @param $firstTable
     * @return mixed
     */
    private function getSidebar($firstTable)
    {
        $this->categories = $this->getAll($firstTable);
        return $this->categories;
    }

    /**
     * find border of price for product type
     * @param string $field
     * @param bool $param
     * @return mixed
     */
    public function findBorder(string $field, bool $param = true)
    {
        $order = $param ? 'ASC' : 'DESC';
        $selectStatement = $this->pdo->select([$field])
            ->from($this->table)
            ->orderBy($field, $order);
        $stmt = $selectStatement->execute();
        return $stmt->fetch();
    }

    /**
     * Get all in the table
     * @param string $tableName
     * @param array $fields
     * @param bool $distinct
     * @return mixed
     */
    public function getAll(string $tableName = '', array $fields = ['*'], $distinct = false)
    {
        $table = $this->table;
        if (!empty($tableName))
            $table = $tableName ?: $tableName;
        $selectStatement = $distinct ?
            $this->pdo->select($fields)
                ->from($table)->distinct()->orderBy($fields[0]) :
            $this->pdo->select($fields)
                ->from($table);
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();

    }

    /**
     * get all by input array id
     * @param array $id
     * @param string $table
     * @return mixed
     */
    public function getAllById(array $id, string $table = ''):array
    {
        if($table){
            $this->table = $table;
        }
        $selectStatement = $this->pdo->select()
            ->from($this->table)
            ->whereIn('id', $id)
            ->orderBy('id');
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();
    }





    public function findAllMinus(string $field, string $value)
    {
        $selectStatement = $this->pdo->select()
            //where пока ограничиваю
            ->from($this->table)
            ->whereNotLike($field, $value);
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();

    }

    public function insertUser($name, $family, $email, $password) {
        $insertStatement = $this->pdo->insert(array('name', 'family', 'email', 'password'))
            ->into($this->table)
            ->values(array($name, $family, $email, $password));
        $insertId = $insertStatement->execute(true);
    }

    public function findEmail($email){
        $selectStatement = $this->pdo->select()
            ->from($this->table)
            ->whereIn('email', [$email]);
        $stmt = $selectStatement->execute();
        return $stmt->fetchAll();
    }

    public function findUser(array $data){
        $selectStatement = $this->pdo->select()
            ->from('users')
            ->whereMany(['email' => $data['email'], 'password' => crypt($data['password'],'salt')], '=');
        $stmt = $selectStatement->execute();
        return $stmt->fetch();
    }

    public function getUser($id){
        $selectStatement = $this->pdo->select()
            ->from('users')
            ->where('id', '=', $id);
        $stmt = $selectStatement->execute();
        return $stmt->fetch();
    }
    public function getGoods()
    {
        return $this->goods;
    }

    public function getCategories()
    {
        return $this->categories;
    }
}