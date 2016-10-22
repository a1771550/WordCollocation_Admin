<?php

namespace app\models;

use Yii;
//use yii\db\ActiveRecord;

/**
 * This is the model class for table "pos".
 *
 * @property integer $Id
 * @property string $Entry
 * @property string $EntryZht
 * @property string $EntryZhs
 * @property string $EntryJap
 * @property string $RowVersion
 * @property integer $CanDel
 *
 * @property Word[] $words
 */
class Pos extends WcBase
{
	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_SEARCH = 'search';
	const SCENARIO_VIEW = 'view';

	public function scenarios() {
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_CREATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap'];
		$scenarios[self::SCENARIO_UPDATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CanDel'];
		//$scenarios[self::SCENARIO_DELETE] = ['Id'];
		$scenarios[self::SCENARIO_SEARCH] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CanDel'];
		$scenarios[self::SCENARIO_VIEW] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'CanDel'];
		return $scenarios;
	}

	public function transactions(){
		return [
			$this->scenarios()[self::SCENARIO_CREATE]=self::OP_ALL,
			$this->scenarios()[self::SCENARIO_UPDATE]=self::OP_ALL,
		];
	}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Entry', 'EntryZht', 'EntryZhs', 'EntryJap'], 'required'],
            [['RowVersion'], 'safe'],
            [['CanDel'], 'integer'],
            [['Entry'], 'string', 'max' => 20],
            [['EntryZht', 'EntryZhs', 'EntryJap'], 'string', 'max' => 30],
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
	        'RowVersion' => Yii::t('app', 'RowVersion'),
	        'CanDel' => Yii::t('app', 'CanDel'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasMany(Word::className(), ['posId' => 'Id']);
    }

    /**
     * @inheritdoc
     * @return PosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PosQuery(get_called_class());
    }

	public function beforeSave($insert) {
		if (parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->CanDel = true;
			}
			return true;
		}
		return false;
	}

	public static function getCanDel(){
		$sql = "SELECT CanDel FROM " . self::tableName();
		return static::findBySql($sql)->all();
	}

	public static function getEntry(){
		$sql = "SELECT Entry FROM " . self::tableName() . " order by Id";
		return static::findBySql($sql)->all();
	}

	public static function getEntryZht(){
		$sql = "SELECT EntryZht FROM " . self::tableName();
		return static::findBySql($sql)->all();
	}

	public static function getEntryZhs(){
		$sql = "SELECT EntryZhs FROM " . self::tableName();
		return static::findBySql($sql)->all();
	}


	/**
	 * @param $posId
	 * @return array
	 */
	public static function getColpossByPos($posId){
		$sql=null;
		$entry=null;
		switch($posId){
			case 1: //pos = noun
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (2,3,5)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (2,3,5)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (2,3,5)";
						break;
				}
				break;
			case 2: //pos = verb
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (4)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (4)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (4)";
						break;
				}
				break;
			case 3: //pos = adjective
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6)";
						break;
				}
				break;
			case 4: //pos = adverb
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (2)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (2)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (2)";
						break;
				}
				break;
			case 5: //pos = preposition
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6)";
						break;
				}
				break;
			case 6: //pos = pronoun
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6)";
						break;
				}
				break;
			case 7: //pos = conjunction
				/*switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6)";
						break;
				}*/
				break;
			case 8: //pos = interjection
				switch(Yii::$app->language){
					case 'zh-TW':
						//$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6)";
						break;
					case 'zh-CN':
						//$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6)";
						break;
					case 'ja':
						//$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6)";
						break;
				}
				break;
			case 9: //pos = phrase
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from pos where Id in (1,6,3)";
						break;
					case 'zh-CN':
						$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from pos where Id in (1,6,3)";
						break;
					case 'ja':
						$sql = "Select Id as id, concat(Entry, ' ', EntryJap) as name from pos where Id in (1,6,3)";
						break;
				}
				break;

		}

		return Yii::$app->db->createCommand($sql)->queryAll();
	}
}
