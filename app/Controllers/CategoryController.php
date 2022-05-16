<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{

   public function index(){
      $category = new Category();

      ## Fetch all records
      $data['category'] = $category->findAll();
      return view('category/index',$data);
   }

   public function create(){
      return view('category/create');
   }

   public function store(){
      $request = service('request');
      $postData = $request->getPost();

      if(isset($postData['submit'])){

         ## Validation
         $input = $this->validate([
            'title' => 'required|min_length[3]',
            'image_name' => 'required',
            'featured' => 'required',
            'active' => 'required'


         ]);

         if (!$input) {
            return redirect()->route('category/create')->withInput()->with('validation',$this->validator); 
         } else {

            $category = new Category();

            $data = [
               'title' => $postData['title'],
               'image_name' => $postData['image_name'],
               'featured' => $postData['featured'],
               'active' => $postData['active']
            ];

            ## Insert Record
            if($subjects->insert($data)){
               session()->setFlashdata('message', 'Added Successfully!');
               session()->setFlashdata('alert-class', 'alert-success');

               return redirect()->route('category/create'); 
            }else{
               session()->setFlashdata('message', 'Data not saved!');
               session()->setFlashdata('alert-class', 'alert-danger');

               return redirect()->route('category/create')->withInput(); 
            }

         }
      }

   }

   public function edit($id = 0){

      ## Select record by id
      $category = new Category();
      $category = $category->find($id);

      $data['category'] = $category;
      return view('category/edit',$data);

   }

   public function update($id = 0){
      $request = service('request');
      $postData = $request->getPost();

      if(isset($postData['submit'])){

        ## Validation
        $input = $this->validate([
            'title' => 'required|min_length[3]',
            'image_name' => 'required',
            'featured' => 'required',
            'active' => 'required'
        ]);

        if (!$input) {
           return redirect()->route('category/edit/'.$id)->withInput()->with('validation',$this->validator); 
        } else {

           $category = new Category();

           $data = [
            'title' => 'required|min_length[3]',
            'image_name' => 'required',
            'featured' => 'required',
            'active' => 'required'
           ];

           ## Update record
           if($category->update($id,$data)){
              session()->setFlashdata('message', 'Updated Successfully!');
              session()->setFlashdata('alert-class', 'alert-success');

              return redirect()->route('/'); 
           }else{
              session()->setFlashdata('message', 'Data not saved!');
              session()->setFlashdata('alert-class', 'alert-danger');

              return redirect()->route('category/edit/'.$id)->withInput(); 
           }

        }
      }

   }

   public function delete($id=0){

      $category = new Category();

      ## Check record
      if($category->find($id)){

         ## Delete record
         $category->delete($id);

         session()->setFlashdata('message', 'Deleted Successfully!');
         session()->setFlashdata('alert-class', 'alert-success');
      }else{
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }

      return redirect()->route('/');

   }
}