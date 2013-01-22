<?php

class opHostingBetaLimit
{

  const USER_LIMIT = 100;

  public function isOverUserLimit()
  {
    return ($this->countRegistUser() > self::USER_LIMIT);
  }

  public function countRegistUser()
  {
    static $queryCacheHash;

    if (!$queryCacheHash)
    {
      $q = opDoctrineQuery::create();
      $q->from('Member m');
      $q->select('COUNT(*)');
      $q->where('is_active = ?', true);
      $searchResult = $q->fetchArray();
      $queryCacheHash = $q->calculateQueryCacheHash();
    }
    else
    {
      $q->setCachedQueryCacheHash($queryCacheHash);
      $searchResult = $q->fetchArray();
    }

    return (int)$searchResult[0]['COUNT'];

  }

}
