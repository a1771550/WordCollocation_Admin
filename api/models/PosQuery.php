<?php

namespace api\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Pos]].
 *
 * @see Pos
 */
class PosQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Pos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Pos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
