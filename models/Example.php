<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "example".
 *
 * @property integer $Id
 * @property string $Entry
 * @property string $EntryZht
 * @property string $EntryZhs
 * @property string $EntryJap
 * @property string $Source
 * @property string $RemarkZht
 * @property string $RemarkZhs
 * @property string $RemarkJap
 * @property integer $CollocationId
 * @property string $RowVersion
 *
 * @property Collocation $collocation
 */
class Example extends WcBase
{
	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_SEARCH = 'search';
	const SCENARIO_VIEW = 'view';

	public function scenarios() {
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_CREATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap','CollocationId','Source','Remark'];
		$scenarios[self::SCENARIO_UPDATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CollocationId','Source','Remark'];
		$scenarios[self::SCENARIO_SEARCH] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CollocationId','Source','Remark'];
		$scenarios[self::SCENARIO_VIEW] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CollocationId','Source','Remark','RowVersion'];
		return $scenarios;
	}

	public function transactions()
	{
		return [
			$this->scenarios()[self::SCENARIO_CREATE] = self::OP_ALL,
			$this->scenarios()[self::SCENARIO_UPDATE] = self::OP_ALL,
		];
	}

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'example';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Entry', 'CollocationId'], 'required'],
            [['CollocationId', 'Source'], 'integer'],
            [['RowVersion','Source','Remark'], 'safe'],
            [['Entry', 'EntryZht', 'EntryZhs', 'EntryJap'], 'string', 'max' => 1000],
            [['Remark'], 'string', 'max' => 200],
            [['CollocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Collocation::className(), 'targetAttribute' => ['CollocationId' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'Entry' => Yii::t('app', 'Entry'),
            'EntryZht' => Yii::t('app', 'EntryZht'),
            'EntryZhs' => Yii::t('app', 'EntryZhs'),
            'EntryJap' => Yii::t('app', 'EntryJap'),
            'Source' => Yii::t('app', 'Source'),
            'Remark' => Yii::t('app', 'Remark'),
            'CollocationId' => Yii::t('app', 'Collocation').Yii::t('app','ID'),
            'RowVersion' => Yii::t('app', 'RowVersion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollocation()
    {
        return $this->hasOne(Collocation::className(), ['Id' => 'CollocationId']);
    }

    /**
     * @inheritdoc
     * @return ExampleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExampleQuery(get_called_class());
    }

    public static function getCollocationIds(){
    	$sql = "Select CollocationId from ". self::tableName();
	    return static::findBySql($sql)->all();
    }

    public static function getSources(){
    	$sql="Select Source from ". self::tableName()." order by Source asc";
	    return static::findBySql($sql)->all();
    }

    public static function getAllCollocationIds(){
    	$sql = "Select Id from collocation order by Id asc";
	    return static::findBySql($sql)->all();
    }
}
