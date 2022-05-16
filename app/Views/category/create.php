<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="actionbutton mt-2">
  <a class="btn btn-info float-right mb20" href="<?=site_url('/')?>">List</a>
</div>

<div class="row">
  <h2>Add Subject</h2>
</div>

<?php 
// Display Response
if(session()->has('message')){
?>
   <div class="alert <?= session()->getFlashdata('alert-class') ?>">
     <?= session()->getFlashdata('message') ?>
   </div>
<?php
}
?>

<?php $validation = \Config\Services::validation(); ?>
<div class="row">
  <div class="col-md-12">
    <form action="<?=site_url('subjects/store')?>" method="post">
      <div class="form-group">
        <label for="email">Title:</label>
        <input type="text" class="form-control" name="name" required value="<?= old('name') ?>">

        <!-- Error -->
        <?php if( $validation->getError('name') ) {?>
           <div class='alert alert-danger mt-2'>
             <?= $error = $validation->getError('name'); ?>
           </div>
        <?php }?>
      </div>
      <div class="form-group">
        <label for="pwd">Image:</label>
        <input type="file" class="form-control" name="image" required value="<?= old('image') ?>">

        <!-- Error -->
        <?php if($validation->getError('description')) {?>
          <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('description'); ?>
          </div>
        <?php }?>

      </div>

      <button type="submit" class="btn btn-success" name="submit">Submit</button>
    </form>
  </div>

</div>

<?= $this->endSection() ?>