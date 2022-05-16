<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Authback implements FilterInterface {

    // before function
    public function before(RequestInterface $request, $arguments = null) {
        if(!session()->get('loggedIn')){
            return redirect()->to('/loginback'); 
        }
    }
     
    // after function
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        
    }
}
