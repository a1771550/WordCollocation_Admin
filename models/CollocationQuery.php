<?php

namespace app\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Collocation]].
 *
 * @see Collocation
 */
class CollocationQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Collocation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Collocation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
