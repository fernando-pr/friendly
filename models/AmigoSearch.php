<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Amigo;

/**
* AmigoSearch representa el modelo de búsqueda para `app\models\Amigo`.
*/
class AmigoSearch extends Amigo
{
    /**
    * @var string nombre
    */
    public $nombre;
    
    /**
    * Reglas de validación para el modelo Amigo.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'id_amigo'], 'integer'],
            [['estado', 'nombre'], 'safe'],
        ];
    }

    /**
    * devuelve los Escenarios relacionados a este modelo.
    * @return mixed.
    */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
    * Crea una instancia de ActiveDataProvider con los
    * parámetros de búsqueda aplicados.
    *
    * @param array $params parámetros de búsqueda.
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = Amigo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['usuario']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'id_amigo' => $this->id_amigo,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
