<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="actionbutton mt-2">
   <a class="btn btn-info float-right mb20" href="<?=site_url('category/create')?>">Add Subject</a>
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

<!-- Subject List -->
<table width="100%" border="1" style="border-collapse: collapse;">
  <thead>
    <tr>
      <th width="10%">ID</th>
      <th width="30%">Title</th>
      <th width="30%">image_name</th>
      <th width="30%">Featured</th>
      <th width="30%">Active</th>


      <th width="15%">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(count($category) > 0){

    foreach($category as $categorys){
  ?>
     <tr>
       <td><?= $category['id'] ?></td>
       <td><?= $category['title'] ?></td>
       <td><?= $category['image_name'] ?></td>
       <td><?= $category['featured'] ?></td>
       <td><?= $category['active'] ?></td>
       <td align="center">
         <a class="btn btn-sm btn-info" href="<?= site_url('category/edit/'.$category['id']) ?>">Edit</a>
         <a class="btn btn-sm btn-danger" href="<?= site_url('category/delete/'.$category['id']) ?>">Delete</a>
       </td>
     </tr>
  <?php
    }

  }else{
  ?>
    <tr>
      <td colspan="4">No data found.</td>
    </tr>
  <?php
  }
  ?>
  </tbody>
</table>
<?= $this->endSection() ?>