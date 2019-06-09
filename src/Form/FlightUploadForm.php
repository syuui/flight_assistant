<?php
// src/Form/ContactForm.php の中で
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;


class FlightUploadForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('uploadFile', [
            'type' => 'file'
        ]);
        
        return $schema;
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->add('uploadFile', 'custom', [
            'rule' => function ($value, $context)
            {
                if (!$value) return false;
                return ('.csv' === substr($value['name'], -4));
            },
            'message' => __('Extention must be csv')
        ]);
        
        return $validator;
    }

    protected function _execute(array $data)
    {
        // メールを送信する
        return true;
    }
}