<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Farmer;

class FarmerController extends BaseController
{private $farmer;
	private $session;
	/**
	 * constructor
	 */
	public function __construct()
	{
		helper(['form', 'url', 'session']);
		$this->farmer = new farmer();
		$this->session = session();
	}

	/**
	 * register
	 */
	public function registerback()
	{
		return view('registerback');
	}

	/**
	 * register
	 */
	public function create()
	{
		$inputs = $this->validate([
			'name' => 'required|min_length[5]',
			'email' => 'required|valid_email|is_unique[users.email]',
			'password' => 'required|min_length[5]'
		]);

		if (!$inputs) {
			return view('registerback', [
				'validation' => $this->validator
			]);
		}

		$this->farmer->save([
			'name' => $this->request->getVar('name'),
			'email'  => $this->request->getVar('email'),
			'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
		]);
		session()->setFlashdata('success', 'Success! registration completed.');
		return redirect()->to(site_url('/registerback'));
	}

	/**
	 * login form
	 */
	public function loginback()
	{
		return view('loginback');
	}

	/**
	 * login validate
	 */
	public function loginValidate()
	{
		$inputs = $this->validate([
			'email' => 'required|valid_email',
			'password' => 'required|min_length[5]'
		]);

		if (!$inputs) {
			return view('loginback', [
				'validation' => $this->validator
			]);
		}

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$farmer = $this->farmer->where('email', $email)->first();

		if ($farmer) {

			$pass = $farmer['password'];
			$authPassword = password_verify($password, $pass);

			if ($authPassword) {
				$sessionData = [
					'id' => $farmer['id'],
					'name' => $farmer['name'],
					'email' => $farmer['email'],
					'loggedIn' => true,
				];

				$this->session->set($sessionData);
				return redirect()->to('dashboard');
			}

			session()->setFlashdata('failed', 'Failed! incorrect password');
			return redirect()->to(site_url('/loginback'));
		}

		session()->setFlashdata('failed', 'Failed! incorrect email');
		return redirect()->to(site_url('/loginback'));
	}

	/**
	 * Dashboard
	 * @param NA
	 */
	public function dashboard()
	{
		return view('dashboard');
	}

	/**
	 * User logout
	 * @param NA
	 */
	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('loginback');
	}
}
  