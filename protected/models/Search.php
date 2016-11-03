<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 * @property string $spc
 * @property string $country
 * @property string $dockind
 * @property string $filename
 * @property string $authorname
 * @property string $quote
 * @property string $totalpage
 * @property string $filesize
 * @property string $filepath
 * @property string $fileext
 * @property string $topic
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class Search extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}	
	
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            array('title, content, status', 'required'),
            array('status', 'in', 'range'=>array(1,2,3)),
            array('spc, country, dockind, filename, authorname, totalpage, filesize, filepath, fileext, topic', 'length', 'max'=>255),
            //    array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
            array('tags', 'normalizeTags'),
            array('title, categoryId, status', 'safe', 'on'=>'search'),
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
            'category' => array(self::BELONGS_TO, 'Category', 'categoryId'),
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition'=>'comments.status='.Comment::STATUS_APPROVED, 'order'=>'comments.create_time DESC'),
            'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition'=>'status='.Comment::STATUS_APPROVED),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'id' => 'ID',
            'title' => 'Tên tài liệu',
            'content' => 'Mô tả',
            'tags' => 'Tags',
            'status' => 'Status',
            'create_time' => 'Ngày tạo',
            'update_time' => 'Ngày cập nhật',
            'author_id' => 'Người cập nhật',
            'spc' => 'SPC',
            'country' => 'Nước',
            'dockind' => 'Dạng tài liệu',
            'filename' => 'File đính kèm',
            'authorname' => 'Tên tác giả',
            'quote' => 'Trích dẫn',
            'totalpage' => 'Số trang',
            'filesize' => 'Số MB',
            'filepath' => 'Đường dẫn',
            'categoryId' => 'Thể loại',
            'topic' => 'Chủ đề',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria->compare('title',$this->title,true);
		$criteria->compare('categoryId',$this->categoryId);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('fillingdate',$this->fillingdate,true);
		$criteria->compare('inventor',$this->inventor,true);
		$criteria->compare('abstract',$this->abstract,true);
		$criteria->compare('home',$this->home);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'sort'=>array(
                'defaultOrder'=>'status, id, update_time DESC',
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
	 * @return Patent the static model class
	 */
}
