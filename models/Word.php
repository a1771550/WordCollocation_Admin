<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property integer $Id
 * @property string $Entry
 * @property string $EntryZht
 * @property string $EntryZhs
 * @property string $EntryJap
 * @property string $RowVersion
 * @property integer $CanDel
 * @property integer $posId
 *
 * @property Collocation[] $collocations
 * @property Collocation[] $collocations0
 * @property Pos $pos
 */
class Word extends WcBase
{
	public $Pos;
	public $PosEntry;
	public $PosEntryZht;
	public $PosEntryZhs;
	public $PosEntryJap;
	public $ColPos;
	public $ColPosEntry;
	public $ColPosEntryZht;
	public $ColPosEntryZhs;
	public $ColPosEntryJap;

	public $colPosId;

	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_SEARCH = 'search';
	const SCENARIO_VIEW = 'view';

	public function scenarios() {
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_CREATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap','posId'];
		$scenarios[self::SCENARIO_UPDATE] = ['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'posId', 'CanDel'];
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
        return 'word';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'posId'], 'required'],
            [['RowVersion'], 'safe'],
            [['CanDel', 'posId'], 'integer'],
            [['Entry'], 'string', 'max' => 50],
            [['EntryZht', 'EntryZhs', 'EntryJap'], 'string', 'max' => 200],
            [['posId'], 'exist', 'skipOnError' => true, 'targetClass' => Pos::className(), 'targetAttribute' => ['posId' => 'Id']],
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
            'posId' => Yii::t('app', 'Pos'),
	        'colPosId'=>Yii::t('app','Colpos'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollocations()
    {
        return $this->hasMany(Collocation::className(), ['wordId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollocations0()
    {
        return $this->hasMany(Collocation::className(), ['colWordId' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPos()
    {
        return $this->hasOne(Pos::className(), ['Id' => 'posId']);
    }

    /**
     * @inheritdoc
     * @return WordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordQuery(get_called_class());
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
		$sql = "SELECT Entry FROM word order by Entry";
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

	public static function getEntryJap(){
		$sql = "SELECT EntryJap FROM " . self::tableName();
		return static::findBySql($sql)->all();
	}

	public static function getAllPos(){
		$sql = "SELECT Id as posId, Entry as PosEntry, EntryZht as PosEntryZht, EntryZhs as PosEntryZhs, EntryJap as PosEntryJap FROM pos";
		return static::findBySql($sql)->all();
	}

	public static function getWordsByPos($posId){
		$sql=null;
		$entry=null;
		switch(Yii::$app->language){
			case 'zh-TW':
				$sql = "Select Id as id, concat(Entry, ' ', EntryZht) as name from word where posId=:posId";
				break;
			case 'zh-CN':
				$sql = "Select Id as id, concat(Entry, ' ', EntryZhs) as name from word where posId=:posId";
				break;
			case 'ja':
				$sql="Select Id as id, concat(Entry, ' ', EntryJap) as name from word where posId=:posId";
				break;
		}
		return Yii::$app->db->createCommand($sql)->bindValue(':posId', $posId)->queryAll();
	}

	/**
	 * @objective get colwords without duplication in collocation
	 * @param $wordId
	 * @param $colPosId
	 * @return array
	 * @internal param $posId
	 */
	public static function getColwordsByWordColPos($wordId, $colPosId){
		$sql=null;
		$entry=null;
		/* get colwords without duplication in collocation */
				switch(Yii::$app->language){
					case 'zh-TW':
						$sql = "Select w.Id as id, concat(w.Entry, ' ', w.EntryZht) as name from word w where w.posId=:colPosId and w.Id not in (select colWordId from collocation where wordId=:wordId)";
						break;
					case 'zh-CN':
						$sql = "Select w.Id as id, concat(w.Entry, ' ', w.EntryZhs) as name from word w where w.posId=:colPosId and w.Id not in (select colWordId from collocation where wordId=:wordId)";
						break;
					case 'ja':
						$sql = "Select w.Id as id, concat(w.Entry, ' ', w.EntryJap) as name from word w where w.posId=:colPosId and w.Id not in (select colWordId from collocation where wordId=:wordId)";
						break;
				}

		$params = [':colPosId'=>$colPosId, ':wordId'=>$wordId];
		return Yii::$app->db->createCommand($sql)->bindValues($params)->queryAll();
	}
}
