<?php


/**
 * Base class that represents a query for the 'Player' table.
 *
 *
 *
 * @method PlayerQuery orderByIdplayer($order = Criteria::ASC) Order by the idPlayer column
 * @method PlayerQuery orderByNameplayer($order = Criteria::ASC) Order by the namePlayer column
 * @method PlayerQuery orderByMailplayer($order = Criteria::ASC) Order by the mailPlayer column
 *
 * @method PlayerQuery groupByIdplayer() Group by the idPlayer column
 * @method PlayerQuery groupByNameplayer() Group by the namePlayer column
 * @method PlayerQuery groupByMailplayer() Group by the mailPlayer column
 *
 * @method PlayerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PlayerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PlayerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PlayerQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method PlayerQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method PlayerQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method PlayerQuery leftJoinGameList($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameList relation
 * @method PlayerQuery rightJoinGameList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameList relation
 * @method PlayerQuery innerJoinGameList($relationAlias = null) Adds a INNER JOIN clause to the query using the GameList relation
 *
 * @method Player findOne(PropelPDO $con = null) Return the first Player matching the query
 * @method Player findOneOrCreate(PropelPDO $con = null) Return the first Player matching the query, or a new Player object populated from the query conditions when no match is found
 *
 * @method Player findOneByNameplayer(string $namePlayer) Return the first Player filtered by the namePlayer column
 * @method Player findOneByMailplayer(string $mailPlayer) Return the first Player filtered by the mailPlayer column
 *
 * @method array findByIdplayer(int $idPlayer) Return Player objects filtered by the idPlayer column
 * @method array findByNameplayer(string $namePlayer) Return Player objects filtered by the namePlayer column
 * @method array findByMailplayer(string $mailPlayer) Return Player objects filtered by the mailPlayer column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BasePlayerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePlayerQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'Player', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PlayerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PlayerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PlayerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PlayerQuery) {
            return $criteria;
        }
        $query = new PlayerQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Player|Player[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlayerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PlayerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Player A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdplayer($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Player A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idPlayer`, `namePlayer`, `mailPlayer` FROM `Player` WHERE `idPlayer` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Player();
            $obj->hydrate($row);
            PlayerPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Player|Player[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Player[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlayerPeer::IDPLAYER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlayerPeer::IDPLAYER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idPlayer column
     *
     * Example usage:
     * <code>
     * $query->filterByIdplayer(1234); // WHERE idPlayer = 1234
     * $query->filterByIdplayer(array(12, 34)); // WHERE idPlayer IN (12, 34)
     * $query->filterByIdplayer(array('min' => 12)); // WHERE idPlayer >= 12
     * $query->filterByIdplayer(array('max' => 12)); // WHERE idPlayer <= 12
     * </code>
     *
     * @param     mixed $idplayer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByIdplayer($idplayer = null, $comparison = null)
    {
        if (is_array($idplayer)) {
            $useMinMax = false;
            if (isset($idplayer['min'])) {
                $this->addUsingAlias(PlayerPeer::IDPLAYER, $idplayer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idplayer['max'])) {
                $this->addUsingAlias(PlayerPeer::IDPLAYER, $idplayer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerPeer::IDPLAYER, $idplayer, $comparison);
    }

    /**
     * Filter the query on the namePlayer column
     *
     * Example usage:
     * <code>
     * $query->filterByNameplayer('fooValue');   // WHERE namePlayer = 'fooValue'
     * $query->filterByNameplayer('%fooValue%'); // WHERE namePlayer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameplayer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByNameplayer($nameplayer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameplayer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nameplayer)) {
                $nameplayer = str_replace('*', '%', $nameplayer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlayerPeer::NAMEPLAYER, $nameplayer, $comparison);
    }

    /**
     * Filter the query on the mailPlayer column
     *
     * Example usage:
     * <code>
     * $query->filterByMailplayer('fooValue');   // WHERE mailPlayer = 'fooValue'
     * $query->filterByMailplayer('%fooValue%'); // WHERE mailPlayer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mailplayer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByMailplayer($mailplayer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mailplayer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mailplayer)) {
                $mailplayer = str_replace('*', '%', $mailplayer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlayerPeer::MAILPLAYER, $mailplayer, $comparison);
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(PlayerPeer::IDPLAYER, $game->getIdcalled(), $comparison);
        } else {
            throw new PropelException('filterByGame() only accepts arguments of type Game');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Game relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function joinGame($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Game');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Game');
        }

        return $this;
    }

    /**
     * Use the Game relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', 'GameQuery');
    }

    /**
     * Filter the query by a related GameList object
     *
     * @param   GameList|PropelObjectCollection $gameList  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameList($gameList, $comparison = null)
    {
        if ($gameList instanceof GameList) {
            return $this
                ->addUsingAlias(PlayerPeer::IDPLAYER, $gameList->getIdplayer(), $comparison);
        } elseif ($gameList instanceof PropelObjectCollection) {
            return $this
                ->useGameListQuery()
                ->filterByPrimaryKeys($gameList->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameList() only accepts arguments of type GameList or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function joinGameList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameList');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'GameList');
        }

        return $this;
    }

    /**
     * Use the GameList relation GameList object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameListQuery A secondary query class using the current class as primary query
     */
    public function useGameListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameList', 'GameListQuery');
    }

    /**
     * Filter the query by a related GameList object
     * using the Game table as cross reference
     *
     * @param   GameList $gameList the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByGameListRelatedByIdgame($gameList, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameQuery()
            ->filterByGameListRelatedByIdgame($gameList, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Bonus object
     * using the Game_List table as cross reference
     *
     * @param   Bonus $bonus the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListQuery()
            ->filterByBonus($bonus, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Game object
     * using the Game_List table as cross reference
     *
     * @param   Game $game the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByGameRelatedByIdgame($game, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListQuery()
            ->filterByGameRelatedByIdgame($game, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Player $player Object to remove from the list of results
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function prune($player = null)
    {
        if ($player) {
            $this->addUsingAlias(PlayerPeer::IDPLAYER, $player->getIdplayer(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}