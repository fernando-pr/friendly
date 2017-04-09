<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "amigos".
*
* @property integer $id
* @property integer $id_usuario
* @property integer $id_amigo
*
* @property Usuarios $idUsuario
* @property Usuarios $idAmigo
*/
class Amigo extends \yii\db\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'amigos';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id_usuario', 'id_amigo', 'estado'], 'required'],
            [['id_usuario', 'id_amigo'], 'integer'],
            [['estado'], 'string', 'max' => 30],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado' => 'estado']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_amigo'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_amigo' => 'id']],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_amigo' => 'Id Amigo',
            'estado' => 'Estado',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['estado' => 'estado'])->inverseOf('amigos');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('usuarios');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAmigo()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_amigo'])->inverseOf('amigos');
    }
}
