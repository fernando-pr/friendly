<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "privados".
 *
 * @property integer $id
 * @property integer $id_emisor
 * @property integer $id_receptor
 * @property string $mensaje
 * @property string $fecha
 *
 * @property Usuarios $idEmisor
 * @property Usuarios $idReceptor
 */
class Privado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_emisor', 'id_receptor', 'mensaje'], 'required'],
            [['id_emisor', 'id_receptor'], 'integer'],
            [['mensaje'], 'string'],
            [['fecha'], 'safe'],
            [['id_emisor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_emisor' => 'id']],
            [['id_receptor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_receptor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_emisor' => 'Id Emisor',
            'id_receptor' => 'Id Receptor',
            'mensaje' => 'Mensaje',
            'fecha' => 'Fecha',
        ];
    }

    public function getMensajesUsuario($id_amigo)
    {
        $id_mio = Yii::$app->user->id;
        $mensajes = Privado::findBySql('SELECT * FROM privados where (id_emisor = ' . $id_mio . 'and id_receptor = ' . $id_amigo . ') or (id_emisor = ' . $id_amigo . 'and id_receptor = ' . $id_mio . ')')->all();


        return $mensajes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmisor()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_emisor'])->inverseOf('enviados');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_receptor'])->inverseOf('recibidos');
    }
}
