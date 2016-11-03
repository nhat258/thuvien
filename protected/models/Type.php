<?php

    /**
     * This is the model class for table "category".
     *
     * The followings are the available columns in table 'category':
     * @property integer    $id
     * @property string     $name

     *
     * The followings are the available model relations:
     * @property Type[] $types
     * @property Volume[]  $volumes
     */
    class Type extends CActiveRecord
    {
    	public $avatarUpload;
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return Category the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return 'type';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name', 'required'),
              //  array('rank', 'numerical', 'min' => 0, 'max' => 10, 'integerOnly' => TRUE),
                array('name', 'length', 'max' => 255),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
               // array('parentId', 'safe'),
            	array('avatarUpload', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => TRUE),
                array('id, name', 'safe', 'on' => 'search'),
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
              //  'parent'     => array(self::BELONGS_TO, 'Category', 'parentId'),
              //  'categories' => array(self::HAS_MANY, 'Category', 'parentId', 'order' => 'rank DESC', 'condition' => 'status=1'),
                'volumes'   => array(self::HAS_MANY, 'Volume', 'voltypeId'),
            	
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'       => 'ID',
                'parentId' => 'Chuyên mục cha',
                'name'     => 'Tên',
                'rank'     => 'Thứ tự',
                'status'   => 'Hiển thị',
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
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
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);
            $criteria->compare('parentId', $this->parentId);
            $criteria->compare('name', $this->name, TRUE);
            $criteria->compare('rank', $this->rank);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'pagination' => FALSE,
                'sort'       => array(
                    'defaultOrder' => 'parentId ASC,rank DESC'
                ),
            ));
        }
    }