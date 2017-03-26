<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "usuarios".
*
* @property integer $id
* @property string $nombre
* @property string $password
* @property string $email
* @property string $token
* @property string $activacion
* @property string $created_at
*
* @property Amigos[] $amigos
* @property Amigos[] $amigos0
* @property Conectados $conectados
* @property Privados[] $privados
* @property Privados[] $privados0
* @property Publicos[] $publicos
*/
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public $passwordConfirm;

    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['nombre', 'password', 'passwordConfirm'], 'required'],
            [['email'], 'required'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 255],
            [['token', 'activacion'], 'string', 'max' => 32],
            [['nombre'], 'unique'],
            [['passwordConfirm'], 'confirmarPassword'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Password',
            'email' => 'Email',
            'token' => 'Token',
            'activacion' => 'Activacion',
            'created_at' => 'Created At',
        ];
    }

    /**
    * [find    Identity description]
    * @param  [type]  $id [description]
    * @return {[type]     [description]
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
    * [findIdentityByAccessToken description]
    * @param  [type]  $token [description]
    * @param  [type]  $type  [description]
    * @return {[type]        [description]
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    /**
    * Busca un usuario por su nombre.
    *
    * @param string $nombre
    * @return static|null
    */
    public static function buscarPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }
    /**
    * @inheritdoc
    */
    public function getId()
    {
        return $this->id;
    }
    /**
    * @inheritdoc
    */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
    * [validateAuthKey description]
    * @param  [type]  $authKey [description]
    * @return {[type]          [description]
    */
    public function validateAuthKey($authKey)
    {
        return $this->token === $authKey;
    }
    /**
    * Validar contraseña.
    *
    * @param string $password contraseña a validar
    * @return bool si la contraseña es válida para el usuario actual
    */
    public function validarPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * [confirmarPassword description]
     * @param  [type]  $attribute [description]
     * @param  [type]  $params    [description]
     * @return {[type]            [description]
     */
    public function confirmarPassword($attribute, $params)
    {
        if ($this->password !== $this->passwordConfirm) {
            $this->addError($attribute, 'Las contraseñas no coinciden');
        }
    }

    /**
    * Comprueba si el usuario es administrador.
    * @return bool si el usuario es administrador
    */
    public function esAdmin()
    {

        return $this->nombre === 'admin';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            $this->token = Yii::$app->security->generateRandomString();
            return true;
        } else {
            return false;
        }
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuarios()
    {
        return $this->hasMany(Amigo::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAmigos()
    {
        return $this->hasMany(Amigo::className(), ['id_amigo' => 'id'])->inverseOf('Amigo');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getConectado()
    {
        return $this->hasOne(Conectado::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEnviados()
    {
        return $this->hasMany(Privado::className(), ['id_emisor' => 'id'])->inverseOf('emisor');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRecibidos()
    {
        return $this->hasMany(Privado::className(), ['id_receptor' => 'id'])->inverseOf('receptor');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPublicos()
    {
        return $this->hasMany(Publico::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }
}
