<?php
class AtlanticBT_LimitSearchSuggestions_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CONFIG_PATH_ACTIVE = 'atlanticbt_limitsearchsuggestions/config/active';
    const CONFIG_PATH_LIMIT  = 'atlanticbt_limitsearchsuggestions/config/limit';

    /**
     * @return bool
     */
    public function isActive()
    {
        return Mage::getStoreConfigFlag(self::CONFIG_PATH_ACTIVE);
    }

    /**
     * @return number
     */
    public function getLimit()
    {
        return Mage::getStoreConfig(self::CONFIG_PATH_LIMIT);
    }
} 