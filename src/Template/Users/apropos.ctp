<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

  <?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Features'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li class="nav-item"><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>


<h1 class="display-4">À propos!</h1>


<p>Mon nom est Jean-François Sergerie et je suis un étudiant au Cégep Montmorency de 5ième session.</p>

<br/>
<p>Durant la création de ce programme. J'ai rencontré un petit bug bien bizarre. Mon site ne semble pas vouloir accepter dez nouveaux produits<br/>
 quand je change la langue pour le Francais ou l'Allemand.</p>

<br/>

<p>Pour utiliser le compte admin, le nom d'utilisateur est : admin@admin.com</p>
<p>Le mot de passe est: admin</p>
<p> Voici des photos de ma base de données:</p>
<br/>
<p>Pour les listes liées, celles-ci ne semblent pas fonctionner, si vous voulez, vous pouvez consulter mon code afin d'y trouver les morceaux de code que j'ai implémenté<br/>
 pour tenter de faire fonctionner le tout.</p>

 <p>L'interface avec les jetons JWT est sur mon interface monopage de produits et sont liés à ma page index.js dans le dossier Products de webroot/js</p>
 
  <p>Mon interface monopage en entier se sert des jetons JWT maintenant. Elle requiert que l'utilisateur se connecte afin de pouvoir effectivement utiliser les fonctionnalités CRUD
  <br/> de mon application web.</p>

<img src="/Tp1_JeanFrancoisSergerie/img/BD.png"/>
<br/>
<img src="/Tp1_JeanFrancoisSergerie/img/bddCourante.png"/>