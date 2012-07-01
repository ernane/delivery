<?php

class Developer_Form_Produto extends Zend_Form 
{
	public function init()
	{  
		$this->setName('produto');

		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel( 'Nome:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-mg')
			->setAttrib('title', 'Informe o nome');
		$this->addElement($nome);

		$descricao = new Zend_Form_Element_Textarea('descricao');
		$descricao->setLabel( 'Descrição:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-m')
			->setAttrib('title', 'Informe a descrição');
		$this->addElement($descricao);

		$valor = new Zend_Form_Element_Text('valor');
		$valor->setLabel( 'Valor:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-m')
			->setAttrib('title', 'Informe o valor');
		$this->addElement($valor);

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel( 'Salvar' )
			->setAttrib('type', 'submit');
		$this->addElement($submit);

	}
}