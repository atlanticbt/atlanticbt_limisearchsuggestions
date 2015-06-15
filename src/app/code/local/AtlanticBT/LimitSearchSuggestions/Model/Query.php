<?php
class AtlanticBT_LimitSearchSuggestions_Model_Query extends Mage_CatalogSearch_Model_Query
{

    /**
     * Retrieve collection of suggest queries
     *
     * @return Mage_CatalogSearch_Model_Resource_Query_Collection
     */
    public function getSuggestCollection()
    {
        $collection = $this->getData('suggest_collection');
        if (is_null($collection)) {
            /* BEGIN ABT CHANGES */
            /** @var AtlanticBT_LimitSearchSuggestions_Helper_Data $helper */
            $helper = Mage::helper('atlanticbt_limitsearchsuggestions');
            $limit = $helper->isActive() ? $helper->getLimit() : false;
            /* END ABT CHANGES */
            $collection = Mage::getResourceModel('catalogsearch/query_collection')
                ->setStoreId($this->getStoreId())
                ->setQueryFilter($this->getQueryText(), $limit); // ABT added $limit argument
            $this->setData('suggest_collection', $collection);
        }
        return $collection;
    }
} 