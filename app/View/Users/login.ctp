<h2>Login Landing Page</h2>
<?php
echo $this->Form->create('User', array('url'=>'view'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Login');
?>