<?php

namespace app\models;

use Yii;

class Product extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'description', 'label'], 'required'],
            [['is_active','parent_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Sub-Produto',
            'label' => 'Título da Categoria',
            'name' => 'Produto',
            'description' => 'Descrição',
            'is_active' => 'Ativo',
        ];
    }
    public static function getHierarchy() {
        $options = [];
         
        $parents = self::find()->where(['parent_id' => null])->all();
        foreach($parents as $id => $p) {
            $children = self::find()->where("parent_id=:parent_id", [":parent_id"=>$p->id])->all();
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }
        return $options;
    }    
         
}
