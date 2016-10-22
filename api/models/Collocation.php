<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "collocation".
 *
 * @property integer $Id
 * @property integer $wordId
 * @property integer $colWordId
 * @property integer $CollocationPattern
 * @property string $RowVersion
 *
 * @property Word $word
 * @property Word $colWord
 * @property Example[] $examples
 */
class Collocation extends WcBase
{
	public $posId;
	public $colPosId;

	public $ExSource;
	public $ExRemark;

	public $ExEntry;
	public $ExEntryZht;
	public $ExEntryZhs;
	public $ExEntryJap;
	public $Word;
	public $WordEntry;
	public $WordEntryZht;
	public $WordEntryZhs;
	public $WordEntryJap;
	public $ColWord;
	public $ColWordEntry;
	public $ColWordEntryZht;
	public $ColWordEntryZhs;
	public $ColWordEntryJap;

	public $Examples;

	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_SEARCH = 'search';
	const SCENARIO_VIEW = 'view';

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_CREATE] = ['wordId', 'colWordId', 'CollocationPattern'];
		$scenarios[self::SCENARIO_UPDATE] = ['Id', 'wordId', 'colWordId', 'CollocationPattern'];
		$scenarios[self::SCENARIO_SEARCH] = ['wordId', 'colWordId', 'CollocationPattern'];
		$scenarios[self::SCENARIO_VIEW] = ['wordId', 'colWordId', 'CollocationPattern'];
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
		return 'collocation';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['wordId', 'colWordId', 'CollocationPattern'], 'required'],
			[['wordId', 'colWordId', 'CollocationPattern'], 'integer'],
			[['RowVersion'], 'safe'],
			[['wordId'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['wordId' => 'Id']],
			[['colWordId'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['colWordId' => 'Id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'Id' => Yii::t('app', 'ID'),
			'wordId' => Yii::t('app', 'Word'),
			'colWordId' => Yii::t('app', 'Colword'),
			'CollocationPattern' => Yii::t('app', 'CollocationPattern'),
			'RowVersion' => Yii::t('app', 'RowVersion'),
			'Examples'=>Yii::t('app', 'Example'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getWord()
	{
		return $this->hasOne(Word::className(), ['Id' => 'wordId']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getColWord()
	{
		return $this->hasOne(Word::className(), ['Id' => 'colWordId']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getExamples()
	{
		return $this->hasMany(Example::className(), ['CollocationId' => 'Id']);
	}

	/**
	 * @inheritdoc
	 * @return CollocationQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new CollocationQuery(get_called_class());
	}

	public static function getAllWord()
	{
		/*$sql = "SELECT Id as wordId, Entry as WordEntry, EntryZht as WordEntryZht, EntryZhs as WordEntryZhs, EntryJap as WordEntryJap FROM word";*/
		$sql = "SELECT Id as wordId, Entry as WordEntry, EntryZht as WordEntryZht, EntryZhs as WordEntryZhs, EntryJap as WordEntryJap FROM word";
		return static::findBySql($sql)->all();
	}

	/*public static function getAllColWord()
	{
		$sql = "SELECT Id as colWordId, Entry, EntryZht, EntryZhs, EntryJap FROM word";
		return static::findBySql($sql)->all();
	}*/

	public static function getPatterns()
	{
		$sql = "SELECT CollocationPattern FROM " . self::tableName();
		return static::findBySql($sql)->all();
	}

	public static function getAllPattern()
	{
		return [
			['id' => (CollocationPattern::NOUN_VERB), 'name' => (Yii::t('app', 'Noun') . ' + ' . Yii::t('app', 'Verb'))],
			['id' => (CollocationPattern::VERB_NOUN), 'name' => (Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Noun'))],
			['id' => (CollocationPattern::ADJECTIVE_NOUN), 'name' => (Yii::t('app', 'Adjective') . ' + ' . Yii::t('app', 'Noun'))],
			['id' => (CollocationPattern::VERB_PREPOSITION), 'name' => (Yii::t('app', 'Verb') . ' + ' . Yii::t('app', 'Preposition'))],
			['id' => (CollocationPattern::PREPOSITION_VERB), 'name' => (Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Verb'))],
			['id' => (CollocationPattern::ADVERB_VERB), 'name' => (Yii::t('app', 'Adverb') . ' + ' . Yii::t('app', 'Verb'))],
			['id' => (CollocationPattern::PHRASE_NOUN), 'name' => (Yii::t('app', 'Phrase') . ' + ' . Yii::t('app', 'Noun'))],
			['id' => (CollocationPattern::PREPOSITION_NOUN), 'name' => (Yii::t('app', 'Preposition') . ' + ' . Yii::t('app', 'Noun'))],
		];
	}

	public static function getPoss()
	{
		$sql = "Select c.posId, p.Entry as PosEntry, p.EntryZht as PosEntryZht, p.EntryZhs as PosEntryZhs, p.EntryJap as PosEntryJap from collocation c inner join pos p on c.posId = p.Id";
		return static::findBySql($sql)->all();
	}

	public static function getWords()
	{
		$sql = "Select c.wordId, w.Entry as WordEntry, w.EntryZht as WordEntryZht, w.EntryZhs as WordEntryZhs, w.EntryJap as WordEntryJap from collocation c inner join word w on c.wordId = w.Id";
		return static::findBySql($sql)->all();
	}

	public static function getColWords()
	{
		$sql = "Select c.colWordId, w.Entry as ColWordEntry, w.EntryZht as ColWordEntryZht, w.EntryZhs as ColWordEntryZhs, w.EntryJap as ColWordEntryJap from collocation c inner join word w on c.colWordId = w.Id";
		return static::findBySql($sql)->all();
	}
}
