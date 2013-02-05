<?php

class Iati_Aidstream_Form_Activity_Transaction_Value extends Iati_Core_BaseForm
{
    public function getFormDefination()
    {
        $model = new Model_Wep();
        
        $this->setAttrib('class' , 'first-child')
            ->setMethod('post')
            ->setIsArray(true);

        $form = array();

        $form['id'] = new Zend_Form_Element_Hidden('id');
        $form['id']->setValue($this->data['id']);

        $form['text'] = new Zend_Form_Element_Text('text');
        $form['text']->setLabel('Amount')
            ->setValue($this->data['text'])
            ->setRequired()
            ->setAttrib('class' , 'form-text')
            ->setAttribs(array('class' => 'currency'))
            ->addFilter(new Iati_Filter_Currency())            
           // ->addValidator(new App_Validate_Numeric())
            //->setAttribs(array('rows'=>'2' , 'cols'=> '20'))
            ->addDecorators(array(array('HtmlTag' , array('tag' => 'div' , 'class' => 'help transaction-value-text' , 'placement' => 'PREPEND'))));

        $currency = $model->getCodeArray('Currency', null, '1' , true);
        $form['currency'] = new Zend_Form_Element_Select('currency');
        $form['currency']->setLabel('Currency')
            ->setValue($this->data['@currency'])
            ->setAttrib('class' , 'form-select')
            ->setMultioptions($currency)
            ->addDecorators(array(array('HtmlTag' , array('tag' => 'div' , 'class' => 'help transaction-value-currency' , 'placement' => 'PREPEND'))));

        $form['value_date'] = new Zend_Form_Element_Text('value_date');
        $form['value_date']->setLabel('Value Date')
            ->setValue($this->data['@value_date'])
            ->setRequired()
            ->setAttrib('class' , 'datepicker' )
            ->addDecorators(array(array('HtmlTag' , array('tag' => 'div' , 'class' => 'help transaction-value-value_date' , 'placement' => 'PREPEND'))));

        $this->addElements($form);
        return $this;
    }
}