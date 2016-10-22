<?php

namespace api\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Word]].
 *
 * @see Word
 */
class WordQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Word[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Word|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
