<?php

/**
 * This is the model class for table "volume".
 *
 * The followings are the available columns in table 'volume':
 * @property integer $id
 * @property string  $name
 * @property string  $time
 * @property integer $voltypeId
 * @property string  $avatar
 * @property string  $avatarUpload
 * @property integer $status
 * @property integer $home
 * @property integer $feature
 * The followings are the available model relations:
 * @property Volume[] $volumes
 */
class Volume extends CActiveRecord
{
	public $avatarUpload;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'volume';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, time', 'required'),
			array('home, status, feature, voltypeId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('time', 'length', 'max'=>500),
			array('avatarUpload', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => TRUE),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, time, voltypeId, date1, date2', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'patents' => array(self::HAS_MANY, 'Patent', 'volumeId'),
			'type' => array(self::BELONGS_TO, 'Type', 'voltypeId'),
				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Kí hiệu đĩa',
			'time' => 'Thời gian',
			'voltypeId' => 'Loại đĩa',
			'home' => 'Trang chủ',
			'status' => 'Hiển thị',
			'feature' => 'Nổi bật',
			'date1' => 'Ngày cập nhật',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	
	protected function beforeSave()
	{
		$this->avatarUpload = CUploadedFile::getInstance($this, 'avatar');
		if (isset($this->avatarUpload)) {
			$fileName     = $this->avatarUpload->name;
			$uploadFolder = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . date('Y-m-d');
			if (!is_dir($uploadFolder)) {
				mkdir($uploadFolder, 0755, TRUE);
			}
			$uploadFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
			$this->avatarUpload->saveAs($uploadFile); //Upload file thong qua object CUploadedFile
			$this->avatar = '/upload/' . date('Y-m-d') . '/' . $fileName; //Lưu path vào csdl
		}
		return parent::beforeSave();
	}
	
	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		if($this->date1 != null && $this->date2 == null){
            $criteria->condition = 'DATE(date1) >=:date1';
            $criteria->params = array(':date1'=>$this->date1);
        }
        elseif($this->date1 == null && $this->date2 != null ){
            $criteria->condition = 'DATE(date2) <=:date2';
            $criteria->params = array(':date2'=>$this->date2);
        }
        elseif($this->date1 != null && $this->date2 != null){
            $criteria->condition = 'DATE(date1) >=:date1 AND DATE(date2) <=:date2 ';
            $criteria->params = array(':date1'=>$this->date1,':date2'=>$this->date2);
        }
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('voltypeId',$this->voltypeId,true);

		return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'sort'       => array(
                'defaultOrder' => 'id DESC, date1 DESC'
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Volume the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
