<?php

  class FormCreator {
    
    private $id = NULL;
    private $error_zone = false;
    private $elements = array();

    private function __construct($id, $error_zone = false) {
	    $this->id = $id;
	    $this->error_zone = $error_zone;
    }



    function add_text_input(){

    }


  }


	
  abstract class FormElement {
	  abstract function to_str();
  }

  class FormTextInput extends FormElement{
    
    private $name = NULL;
    private $label = NULL;
    private $type = NULL;
    private $placeholder = NULL;
    private $required = NULL;
    private $pattern = NULL;

    function __construct($name, $label = "Label", $type = "text", $placeholder="", $required = true, $pattern = NULL) {
	    $this->name = $name;
	    $this->label = $label;
	    $this->type = $type;
	    $this->placeholder = $placeholder;
	    $this->required = $required;
	    $this->pattern = $pattern;
    }



    function to_str(){
?>
	<label for="<?= $this->name ?>"><b><?= $this->label ?></b></label>
	<input type="<?= $this->type ?>" placeholder="<?= $this->placeholder ?>" name="<?= $this->name ?>" 
		<?php echo ($this->required ? 'required' : ''); ?> >
<?php
    }


  }




?>
