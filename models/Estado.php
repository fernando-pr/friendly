<?php

namespace app\models;


/**
 * Modelo de la tabla "estados".
 *
 * @property integer $id
 * @property string $estado
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'estados';
    }

    /**
    * Reglas de validación para el modelo Estado.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'string', 'max' => 30],
            [['estado'], 'unique'],
        ];
    }

    /**
    * Son los nombres de los atributos del modelo.
    * @return array
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmigos()
    {
        return $this->hasMany(Amigo::className(), ['estado' => 'estado'])->inverseOf('estado');
    }
}
