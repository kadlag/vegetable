<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{private $user;
	private $session;
	/**
	 * constructor
	 */
	public function __construct()
	{
		helper(['form', 'url', 'session']);
		$this->user = new User();
		$this->session = session();
	}

	/**
	 * register
	 */
	public function register()
	{
		return view('register');
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
			return view('register', [
				'validation' => $this->validator
			]);
		}

		$this->user->save([
			'name' => $this->request->getVar('name'),
			'email'  => $this->request->getVar('email'),
			'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
		]);
		session()->setFlashdata('success', 'Success! registration completed.');
		return redirect()->to(site_url('/register'));
	}

	/**
	 * login form
	 */
	public function login()
	{
		return view('login');
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
			return view('login', [
				'validation' => $this->validator
			]);
		}

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$user = $this->user->where('email', $email)->first();

		if ($user) {

			$pass = $user['password'];
			$authPassword = password_verify($password, $pass);

			if ($authPassword) {
				$sessionData = [
					'id' => $user['id'],
					'name' => $user['name'],
					'email' => $user['email'],
					'loggedIn' => true,
				];

				$this->session->set($sessionData);
				return redirect()->to('dashboard');
			}

			session()->setFlashdata('failed', 'Failed! incorrect password');
			return redirect()->to(site_url('/login'));
		}

		session()->setFlashdata('failed', 'Failed! incorrect email');
		return redirect()->to(site_url('/login'));
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
		return redirect()->to('login');
	}
}
  

