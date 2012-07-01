<?php

class Developer_Form_Profile extends Zend_Form
{

	public function init()
	{  
		$this->setName('profile');


		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel( 'Nome:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-g')
			->setAttrib('title', 'Informe o seu nome');
		$this->addElement($nome);

		$sobrenome = new Zend_Form_Element_Text('sobrenome');
		$sobrenome->setLabel( 'Sobrenome:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-g')
			->setAttrib('title', 'Informe o seu sobrenome');
		$this->addElement($sobrenome);

		$email = new Zend_Form_Element_Text('email');
		$email->setLabel( 'E-mail:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addValidator('EmailAddress')
			->setAttrib('class', 'input-g')
			->setAttrib('title', 'Informe o e-mail');
		$this->addElement($email);

		$password = new Zend_Form_Element_Password('password');
		$password->setLabel( 'Senha:' )
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-m')
			->setAttrib('title', 'Informe a senha');
		$this->addElement($password);


		$cep = new Zend_Form_Element_Text('cep');
		$cep->setLabel( 'CEP:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-p cep')
			->setAttrib('title', 'Informe o CEP');
		$this->addElement($cep);

		$rua = new Zend_Form_Element_Text('rua');
		$rua->setLabel( 'Endereço:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-g')
			->setAttrib('title', 'Informe o seu endereço');
		$this->addElement($rua);

		$numero = new Zend_Form_Element_Text('numero');
		$numero->setLabel( 'Número:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-p')
			->setAttrib('title', 'Informe o número da residência');
		$this->addElement($numero);

		$complemento = new Zend_Form_Element_Text('complemento');
		$complemento->setLabel( 'Complemento:' )
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-g')
			->setAttrib('title', 'Informe o complemento, caso exista');
		$this->addElement($complemento);

		$bairro = new Zend_Form_Element_Text('bairro');
		$bairro->setLabel( 'Bairro:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-m')
			->setAttrib('title', 'Informe o bairro');
		$this->addElement($bairro);

		$cidade = new Zend_Form_Element_Text('cidade');
		$cidade->setLabel( 'Cidade:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-m')
			->setAttrib('title', 'Informe a cidade');
		$this->addElement($cidade);

		$estado = $this->createElement('select', 'estado', array('label' => '* Estado', 'class' => 'combo', 'style' => 'width: 150px;height: 25px;'))->setRequired(true);
		$arEstados = array('AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazônas', 'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins');

		$estado = new Zend_Form_Element_Select('estado');
		$estado->setLabel( 'Estado:' )
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addMultiOptions($arEstados);
		$this->addElement($estado);

		$ddd = new Zend_Form_Element_Text('ddd');
		$ddd->setLabel( 'DDD:' )
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-mi ddd')
			->setAttrib('title', 'Informe o DDD do telefone');
		$this->addElement($ddd);

		$telefone = new Zend_Form_Element_Text('telefone');
		$telefone->setLabel( 'Telefone:' )
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setAttrib('class', 'input-p telefone')
			->setAttrib('title', 'Informe o número do telefone');
		$this->addElement($telefone);
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel( 'Atualizar' )
			->setAttrib('type', 'submit');
		$this->addElement($submit);
	}

	public function isValid($data)
	{
		if( isset( $data[ 'email' ] )
			&& !empty( $data[ 'email' ] ) )
		{
			if( $data['current_email'] != $data['email'] )
			{
				$emailValidator = new Zend_Validate_Db_NoRecordExists('users', 'email');
				$this->getElement('email')
					->addValidator( $emailValidator );
			}
		}

		return parent::isValid($data);
	}
}