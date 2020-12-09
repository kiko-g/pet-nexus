<?php

  class FormCreator {
    
    private $id = NULL;
    private $ajax = NULL;
    private $action = NULL;
    private $error_zone = false;
    private $elements = array();

    function __construct($id, $action, $error_zone = false, $ajax=true) {
	    $this->id = $id;
	    $this->action = $action;
	    $this->error_zone = $error_zone;
	    $this->ajax = $ajax;
    }



    function add_input($name, $label = "Label", $type = "text", $placeholder="", $required = true, $value = NULL, $pattern = NULL){
	    array_push($this->elements, new FormInput($name, $label, $type, $placeholder, $required, $value, $pattern));
    }


    function inline(){
?>

	<div id="<?= $this->id ?>" class="overlayLogin">
  <form class="overlayLogin-content animate" action="<?= $this->action ?>" method="post">


      <div class="container top round">
	<?php
		if($this->error_zone) {
	?>
	<div id="<?= $this->id ?>-errors" style="background-color:red">
        </div>
	<?php } ?>

        <span onclick="document.getElementById('<?= $this->id ?>').style.display='none'" class="close"
          title="close overlayLogin">&#10006;</span>
      </div>

      <div class="container">
	
	<?php
	
	    foreach($this->elements as $index => $entry){
		    echo $entry->to_str();
	    }



	?>
	<input name="csrf" type="hidden" style="display:none" value="<?= $_SESSION['csrf'] ?>">
        <button type="submit" class="login">Submit</button>
      </div>
      <div class="container bottom">
        <button type="button" onclick="document.getElementById('<?= $this->id ?>').style.display='none'"
          class="cancel-button">Back</button>
      </div>
    </form>
  </div>

<?php

	    if($this->ajax){
	    $handler_function = 'handler_'.bin2hex($this->id);
?>

	
	<script>
	
	    function <?= $handler_function ?>(event){
			event.preventDefault();


			let form = document.querySelector('#<?= $this->id ?> form');

			let correctDiv = form.children[1];
			let body = {};
			for(let i = 0; i<correctDiv.children.length; i++){

				let child = correctDiv.children[i];

				if(child.name == "")
					continue;

				switch(child.nodeName.toLowerCase()){
					case 'input':
						if(child.type == "checkbox")
							body[child.name] = child.checked;
						else
							body[child.name] = child.value;
						break;
					case 'label':
						break;
					default:
						console.log('need to implement ' + child.nodeName);
						break;
				}

			}

			let errorzone = document.getElementById('<?= $this->id ?>-errors');
			errorzone.innerHTML = '';


			fetch('<?= $this->action ?>', {
				method:'POST',
				headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json',
				},
					body: JSON.stringify(body)
			}).then((text) => {
				return text.json();
				
			}).then( (json) => {

				if('errors' in json){
					errorzone.innerHTML = json['errors'];
					return;
				}

				location.reload();

				
			});
		}
	    document.getElementById('<?=$this->id ?>').children[0].addEventListener('submit',  <?= $handler_function ?>);
		



	</script>

<?php
    }



    }

  }


	
  abstract class FormElement {
	  abstract function to_str();
  }

  class FormInput extends FormElement{
    
    private $name = NULL;
    private $label = NULL;
    private $type = NULL;
    private $placeholder = NULL;
    private $required = NULL;
    private $pattern = NULL;
    private $value = NULL;

    function __construct($name, $label, $type, $placeholder, $required, $value, $pattern) {
	    $this->name = $name;
	    $this->label = $label;
	    $this->type = $type;
	    $this->placeholder = $placeholder;
	    $this->required = $required;
	    $this->pattern = $pattern;
	    $this->value = $value;
	    error_log($value);
	    error_log($this->value);
    }



    function to_str(){
	    if($this->type !== "checkbox"){

?>
	<label for="<?= $this->name ?>"><b><?= $this->label ?></b></label>
	<?php } ?>
	<input type="<?= $this->type ?>" placeholder="<?= $this->placeholder ?>" name="<?= $this->name ?>" 
	<?php echo (!is_null($this->value) ? 'value="'.$this->value.'" ' : ''); ?> <?php echo ($this->required ? 'required' : ''); ?> >

	<?php
	    if($this->type == "checkbox"){
?>
		<label for="<?= $this->name ?>"><b><?= $this->label ?></b></label>

		

		<?php
	    }


    }


  }




?>
