<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(
        private function $useCase,
        private function $presenter,
    )
    {}

public function __invoke()
}
