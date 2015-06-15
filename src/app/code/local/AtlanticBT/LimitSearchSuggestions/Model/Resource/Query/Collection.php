<?php
class AtlanticBT_LimitSearchSuggestions_Model_Resource_Query_Collection
    extends Mage_CatalogSearch_Model_Resource_Query_Collection
{

    /**
     * Set search query text to filter
     *
     * @param string $query
     * @param bool|int $limit
     * @return Mage_CatalogSearch_Model_Resource_Query_Collection
     */
    public function setQueryFilter($query, $limit = false) // ABT added the limit argument
    {
        $ifSynonymFor = $this->getConnection()
            ->getIfNullSql('synonym_for', 'query_text');
        $this->getSelect()->reset(Zend_Db_Select::FROM)->distinct(true)
            ->from(
                array('main_table' => $this->getTable('catalogsearch/search_query')),
                array('query'      => $ifSynonymFor, 'num_results')
            )
            ->where('num_results > 0 AND display_in_terms = 1 AND query_text LIKE ?',
                Mage::getResourceHelper('core')->addLikeEscape($query, array('position' => 'start')))
            ->order('popularity ' . Varien_Db_Select::SQL_DESC);
        if ($this->getStoreId()) {
            $this->getSelect()
                ->where('store_id = ?', (int)$this->getStoreId());
        }

        /* BEGIN ABT CHANGES */
        if ($limit) {
            $this->getSelect()->limit($limit);
        }
        /* END ABT CHANGES */
        return $this;
    }

} 