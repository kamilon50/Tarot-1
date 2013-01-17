<?php



/**
 * This class defines the structure of the 'Score_Tournament' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.tarot.map
 */
class ScoreTournamentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.ScoreTournamentTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Score_Tournament');
        $this->setPhpName('ScoreTournament');
        $this->setClassname('ScoreTournament');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('idTournament', 'Idtournament', 'INTEGER' , 'Tournament', 'id', true, null, null);
        $this->addForeignPrimaryKey('idPlayer', 'Idplayer', 'INTEGER' , 'Player', 'id', true, null, null);
        $this->addColumn('score', 'Score', 'INTEGER', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_ONE, array('idTournament' => 'id', ), 'CASCADE', null);
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_ONE, array('idPlayer' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // ScoreTournamentTableMap
