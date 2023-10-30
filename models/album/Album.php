<?php

namespace app\models\album;

use Yii;
use Vimeo\Vimeo;

/**
 * This is the model class for table "album".
 *
 * @property int $id
 * @property string $name
 * @property string $showcase_id
 * @property string|null $description
 * @property int|null $duration
 * @property string|null $author_name
 * @property string|null $author_url
 * @property string|null $cover_link
 */
class Album extends \yii\db\ActiveRecord
{
    public $link;

    const STATUS_OK = 200;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration'], 'integer'],
            [['name', 'showcase_id', 'description', 'author_name', 'author_url', 'cover_link'], 'string', 'max' => 255],
            ['link', 'validateLink','skipOnEmpty' => false],
        ];
    }

    public function validateLink($attribute)
    {
        if(!preg_match("/^https:\/\/vimeo\.com\/showcase\/\d+$/", $this->$attribute)) {
            $this->addError($attribute, Yii::t('app', 'Invalid link.'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'showcase_id' => 'Showcase ID',
            'description' => 'Description',
            'duration' => 'Duration',
            'author_name' => 'Author Name',
            'author_url' => 'Author Url',
            'cover_link' => 'Cover Link',
        ];
    }

    public function beforeSave($insert)
    {
        $matches = [];
        preg_match("/\d+$/", $this->link, $matches);

        $response = self::requestVimeo("/albums/{$matches[0]}");
        if($response['status'] == self::STATUS_OK) {
            $body = $response['body'];
            $this->name = $body['name'];
            $this->showcase_id = $matches[0];
            if(empty($this->name) || empty($this->showcase_id)) {return false;}
            $this->description = $body['description'];
            $this->duration = $body['duration'];
            $this->author_name = $body['user']['name'];
            $this->author_url = $body['user']['link'];
            $this->cover_link = $body['pictures']['base_link'];
        }

        return parent::beforeSave($insert);
    }

    public static function requestVimeo($url, $method = 'GET'): array
    {
        $clientId = Yii::$app->params['clientId'];
        $clientSecret = Yii::$app->params['clientSecret'];
        $token = Yii::$app->params['token'];
        $client = new Vimeo($clientId, $clientSecret, $token);

        return $client->request($url, array(), $method);
    }
}
