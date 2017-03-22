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
class Usuario extends \yii\db\ActiveRecord
{
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
            [['nombre', 'password', 'email'], 'required'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 255],
            [['token', 'activacion'], 'string', 'max' => 32],
            [['nombre'], 'unique'],
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
