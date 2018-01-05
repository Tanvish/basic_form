<?php

namespace Drupal\basic_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an basic form.
 */
class BasicForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'basic_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
    ];
    $form['age'] = [
      '#type' => 'number',
      '#title' => t('Age:'),
    ];
    $form['gender'] = [
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => [
        'male' => t('Male'),
        'female' => t('Female'),
        'other' => t('Other'),
      ],
    ];
    $form['birthdate'] = [
      '#type' => 'date',
      '#title' => t('Birthdate'),
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('name')) < 2) {
      $form_state->setErrorByName('name', $this->t('Length should be greater than 2'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('You are: ' . $form_state->getValue('name'));
    drupal_set_message(' Your age is : ' . $form_state->getValue('age'));
    drupal_set_message('Gender: ' . $form_state->getValue('gender'));
    drupal_set_message('You were born on: ' . date("d-m-Y", strtotime($form_state->getValue('birthdate'))));
  }

}
