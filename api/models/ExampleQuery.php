<?php

namespace api\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Example]].
 *
 * @see Example
 */
class ExampleQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Example[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Example|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
