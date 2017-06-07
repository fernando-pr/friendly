<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estado;

/**
 * EstadoSearch representa el modelo de búsqueda para `app\models\Estado`.
 */
class EstadoSearch extends Estado
{
    /**
    * Reglas de validación para el modelo Estado.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['estado'], 'safe'],
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
        $query = Estado::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
