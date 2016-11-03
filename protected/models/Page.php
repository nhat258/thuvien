<?php

    /**
     * This is the model class for table "page".
     *
     * The followings are the available columns in table 'page':
     * @property integer $id
     * @property string  $url
     * @property string  $title
     * @property string  $content
     * @property string  $date_modified
     */
    class Page extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return Page the static model class
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
            return 'page';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('url, title, content', 'required'),
                array('url', 'length', 'max' => 500),
                array('title', 'length', 'max' => 250),
                array('date_modified', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, url, title, content, date_modified', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array();
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'            => 'ID',
                'url'           => 'Url',
                'title'         => 'Tên trang',
                'content'       => 'Nội dung',
                'date_modified' => 'Ngày chỉnh sửa',
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);
            $criteria->compare('url', $this->url, TRUE);
            $criteria->compare('title', $this->title, TRUE);
            $criteria->compare('content', $this->content, TRUE);
            $criteria->compare('date_modified', $this->date_modified, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        protected function beforeSave(){
            return parent::beforeSave();
        }

        public function findByUrl($url)
        {
            return $this->find('url=:url', array(':url' => $url));
        }
    }