<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MyConfigForm extends ConfigFormBase {

    public function getFormId()
    {
        return 'my_module_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'my_module.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('my_module.settings');

        $form['reviews'] = [
            '#type' => 'text_format',
            '#title' => 'Редактиране на страницата',
            '#default_value' => $config->get('reviews')['value'],
            '#required' => TRUE,

        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Изпрати',
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config('my_module.settings');
        $config->set('reviews', $form_state->getValue('reviews'));
        $config->save();


        //Invalidate cache
        \Drupal\Core\Cache\Cache::invalidateTags(array('MY_CUSTOM_UNIQUE_TAG'));

        return parent::submitForm($form, $form_state);
    }
}