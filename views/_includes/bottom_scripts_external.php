<div class="toast-container" id="toast_container"></div>


<? $this->inject('/js/app.js', 'js');  ?>
<? $this->inject('/js/external.js', 'js');  ?>
<? $this->inject('/dist/js/tabler.min.js', 'js', ['script_opts' =>'defer']);  ?>
<? $this->inject('/dist/js/demo-theme.min.js', 'js');  ?>
